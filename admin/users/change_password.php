<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

/* OLD DATA FOR CHECK */
$sql->table = "user";
$sql->condition = "WHERE user_id={$_POST["id"]}";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
	$arr = [
		"title" => "เกิดข้อผิดพลาด",
		"text" => "ไม่สามารถเข้าถึงข้อมูลที่ต้องการแก้ไข หรือไม่พบข้อมูล",
		"type" => "error",
		"url" => URL."admin/users/?page=users"
	];
	echo json_encode($arr);
	exit;
}

foreach ($_POST as $key => $value) {
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

if( !empty($_POST["password"]) && !empty($_POST["password2"]) ){
	if( checkStr($_POST["password"]) < 5 ) $arr["error"]["password"] = "ความยาวของ Password ต้องมีตั้งแต่ 5 ตัวอักษรขึ้นไป";
	// if( checkStr($_POST["password2"]) < 5 ) $arr["error"]["password2"] = "ความยาวของ Confim Password ต้องมีตั้งแต่ 5 ตัวอักษรขึ้นไป";

	// if( $_POST["password"] != $_POST["password2"] ){
	// 	$arr["error"]["password"] = "รหัสผ่านที่กรอกไม่ตรงกัน";
	// 	$arr["error"]["password2"] = "รหัสผ่านที่กรอกไม่ตรงกัน";
	// }
}

if( empty($arr["error"]) ){
	$value = '';
	foreach ($_POST as $key => $val) {
		if( $key == "id" || $key == "password" ) continue;

		$value .= !empty($value) ? "," : "";
		$value .= "{$key}='".hashPassword($val)."'";
	}

	$sql->table = "user";
	$sql->value = $value;
	$sql->condition = "WHERE user_id={$_POST["id"]}";
	if( $sql->update() ){
	$arr = [
			"type" => "success",
			"title" => "เปลี่ยนรหัสผ่านเรียบร้อยแล้ว",
			"url" => URL.'admin/users/?page=users',
			"status" => 200
		];
	}
	else{
		$arr = [
			"type" => "error",
			"title" => "ไม่สามารถเปลี่ยนรหัสผ่านได้ กรุณาลองใหม่อีกครั้ง",
			"status" => 404
		];
	}
}

echo json_encode($arr);