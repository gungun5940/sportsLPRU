<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

/* CHECK VALIDATE ZONE */
foreach ($_POST as $key => $value) {
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

if( !empty($_POST["name"]) ){
	if( checkStr($_POST["name"]) < 5 ) $arr["error"]["name"] = "ความยาวของ ชื่อ-นามสกุล ต้องมีตั้งแต่ 5 ตัวอักษรขึ้นไป";
	if( !checkEngThai($_POST["name"]) ) $arr["error"]["name"] = "ชื่อ-นามสกุล ต้องเป็นตัวอักษรภาษาไทย หรือ ภาษาอังกฤษ เท่านั้น";
}

if( !empty($_POST["username"]) ){
	if( checkStr($_POST["username"]) < 5 ) $arr["error"]["username"] = "ความยาวของ Username ต้องมีตั้งแต่ 5 ตัวอักษรขึ้นไป";
	if( !checkEngNum($_POST["username"]) ) $arr["error"]["username"] = "ต้องเป็นตัวเลข 0-9 หรือ A-Z หรือ a-z เท่านั้น";
}

if( !empty($_POST["password"]) && !empty($_POST["password2"]) ){
	if( checkStr($_POST["password"]) < 5 ) $arr["error"]["password"] = "ความยาวของ Password ต้องมีตั้งแต่ 5 ตัวอักษรขึ้นไป";
	if( checkStr($_POST["password2"]) < 5 ) $arr["error"]["password2"] = "ความยาวของ Confim Password ต้องมีตั้งแต่ 5 ตัวอักษรขึ้นไป";

	if( $_POST["password"] != $_POST["password2"] ){
		$arr["error"]["password"] = "รหัสผ่านที่กรอกไม่ตรงกัน";
		$arr["error"]["password2"] = "รหัสผ่านที่กรอกไม่ตรงกัน";
	}
}

$sql->table = "user";
$sql->condition = "WHERE username='{$_POST['username']}'";
$query = $sql->select();
if( mysqli_num_rows($query) > 0 ){
	$arr["error"]["username"] = "ตรวจสอบพบ Username ซ้ำในระบบ";
}
/* END CHECK */

//PROCESS ZONE (WITH OUT ERROR)
if( empty($arr["error"]) ){

	/* BUILD SQL COMMAND */
	$field = '';
	$value = '';
	foreach ($_POST as $key => $post) {
		if( $key == "password2" ) continue;

		$field .= !empty($field) ? "," : "";
		$field .= $key;

		$value .= !empty($value) ? "," : "";
		if( $key == "password" ) $post = hashPassword($post);
		$value .= "'{$post}'";
	}
	/* END BUILD */

	$sql->table = "user";
	$sql->field = $field;
	$sql->value = $value;
	if( $sql->insert() ){
		$arr = [
			"type" => "success",
			"title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
			"url" => URL.'admin/users/?page=users',
			"status" => 200
		];
	}
	else{
		$arr = [
			"type" => "error",
			"title" => "ไม่สามารถบันทึกข้อมูลได้",
			"status" => 422
		];
	}
}
echo json_encode($arr);