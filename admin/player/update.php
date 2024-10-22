<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

/* OLD DATA FOR CHECK */
$sql->table = "player";
$sql->condition = "WHERE player_id={$_POST["player_id"]}";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
	$arr = [
		"title" => "เกิดข้อผิดพลาด",
		"text" => "ไม่สามารถเข้าถึงข้อมูลที่ต้องการแก้ไข หรือไม่พบข้อมูล",
		"type" => "error",
		"url" => URL."admin/tournament/?page=sport&sub=tournament"
	];
	echo json_encode($arr);
	exit;
}
$old = mysqli_fetch_assoc($query);
/* END OLD DATA */

foreach ($_POST as $key => $value) {
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

//Check

if( !empty($_POST["player_name"]) ){
    $has = true;
    if( $old["player_name"] == $_POST["player_name"] ) $has = false;
    

    if( checkStr($_POST["player_name"]) < 5 ) $arr["error"]["player_name"] = "กรุณากรอกข้อมูล 5 ตัวอักษรขึ้นไป";
    $sql->table = "player";
	$sql->condition = "WHERE player_name='{$_POST["player_name"]}'";
	$query = $sql->select();
	if( mysqli_num_rows($query) > 0 && $has ){
		$arr["error"]["player_name"] = "ตรวจสอบพบข้อมูลชนิดกีฬาซ้ำกันในฐานข้อมูล";
	}
}
/* END CHECK ZONE */
if( empty($arr["error"]) ){
	// $value = '';
	// foreach ($_POST as $key => $val) {
	// 	if( $key == "player_id" ) continue;

	// 	$value .= !empty($value) ? "," : "";
	// 	$value .= "{$key}='{$val}'";
	// }

	$sql->table = "player";
	$sql->value = "player_name='{$_POST["player_name"]}'";
	$sql->condition = "WHERE player_id={$_POST["player_id"]}";
	if( $sql->update() ){
	$arr = [
			"type" => "success",
			"title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
            "url" => URL."admin/tournament/?page=sport&sub=tournament",
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