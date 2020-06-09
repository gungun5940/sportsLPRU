<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

/* OLD DATA FOR CHECK */
$sql->table = "customers";
$sql->condition = "WHERE id={$_POST["id"]}";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
	$arr = [
		"title" => "เกิดข้อผิดพลาด",
		"text" => "ไม่สามารถเข้าถึงข้อมูลที่ต้องการแก้ไข หรือไม่พบข้อมูล",
		"type" => "error",
		"url" => URL."admin/customers/?page=customers"
	];
	echo json_encode($arr);
	exit;
}
$old = mysqli_fetch_assoc($query);
/* END OLD DATA */

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

	$has = true;
	if( $old["idcard"] == $_POST["idcard"] ) $has = false;

	$sql->table = "customers";
	$sql->condition = "WHERE idcard='{$_POST["idcard"]}'";
	$query = $sql->select();
	if( mysqli_num_rows($query) > 0 && $has ){
		$arr["error"]["idcard"] = "ตรวจสอบพบข้อมูลเลขบัตรประชาชนซ้ำในระบบ";
	}
}
/* END CHECK ZONE */
if( empty($arr["error"]) ){
	$value = '';
	foreach ($_POST as $key => $val) {
		if( $key == "id" ) continue;

		$value .= !empty($value) ? "," : "";
		if( $key == "birthday" ) $val = DateJQToPHP($val);
		$value .= "{$key}='{$val}'";
	}

	$sql->table = "customers";
	$sql->value = $value;
	$sql->condition = "WHERE id={$_POST["id"]}";
	if( $sql->update() ){
	$arr = [
			"type" => "success",
			"title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
			"url" => URL.'admin/customers/?page=customers',
			"status" => 200
		];
	}
	else{
		$arr = [
			"type" => "error",
			"title" => "ไม่สามารถบันทึกข้อมูลได้",
			"status" => 404
		];
	}
}
echo json_encode($arr);