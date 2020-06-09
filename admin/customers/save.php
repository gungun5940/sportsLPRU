<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

/* CHECK VALIDATE ZONE */
foreach ($_POST as $key => $value) {
	if( $key == "code" ) continue;
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

//Check
if( !empty($_POST["first_name"]) ){
	if( !checkThai($_POST["first_name"]) ) $arr["error"]["first_name"] = "กรุณากรอกชื่อเป็นภาษาไทยเท่านั้น";
}
if( !empty($_POST["last_name"]) ){
	if( !checkThai($_POST["last_name"]) ) $arr["error"]["last_name"] = "กรุณากรอกนามสกุลเป็นภาษาไทยเท่านั้น";
}
if( !empty($_POST["idcard"]) ){
	if( !is_numeric($_POST["idcard"]) ){
		$arr["error"]["idcard"] = "กรุณากรอกข้อมูลเป็นตัวเลข 0-9 และห้ามเว้นว่าง";
	}elseif( !checkPID($_POST["idcard"]) ){
		$arr["error"]["idcard"] = "เลขบัตรประชาชนไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง";
	}
	$sql->table = "customers";
	$sql->condition = "WHERE idcard='{$_POST["idcard"]}'";
	$query = $sql->select();
	if( mysqli_num_rows($query) > 0 ){
		$arr["error"]["idcard"] = "ตรวจสอบพบข้อมูลเลขบัตรประชาชนซ้ำในระบบ";
	}
}

if( empty($arr["error"]) ){
	/* BUILD SQL COMMAND */
	$field = '';
	$value = '';
	foreach ($_POST as $key => $post) {
		$field .= !empty($field) ? "," : "";
		$field .= $key;

		$value .= !empty($value) ? "," : "";
		if( $key == "birthday" ) $post = DateJQToPHP($post);
		$value .= "'{$post}'";
	}
	/* END BUILD */

	$sql->table = "customers";
	$sql->field = $field;
	$sql->value = $value;
	if( $sql->insert() ){
		$arr = [
			"type" => "success",
			"title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
			"url" => URL.'admin/customers/?page=users',
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