<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

/* OLD DATA FOR CHECK */
$sql->table = "team";
$sql->condition = "WHERE team_id={$_POST["team_id"]}";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
	$arr = [
		"title" => "เกิดข้อผิดพลาด",
		"text" => "ไม่สามารถเข้าถึงข้อมูลที่ต้องการแก้ไข หรือไม่พบข้อมูล",
		"type" => "error",
		"url" => URL."admin/team/?page=team"
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

if( !empty($_POST["team_name"]) ){
    $has = true;
    if( $old["team_name"] == $_POST["team_name"] ) $has = false;
    

    if( checkStr($_POST["team_name"]) < 5 ) $arr["error"]["team_name"] = "กรุณากรอกข้อมูล 5 ตัวอักษรขึ้นไป";
    $sql->table = "team";
	$sql->condition = "WHERE team_name='{$_POST["team_name"]}'";
	$query = $sql->select();
	if( mysqli_num_rows($query) > 0 && $has ){
		$arr["error"]["team_name"] = "ตรวจสอบพบข้อมูลทีมซ้ำกันในฐานข้อมูล";
	}
}
/* END CHECK ZONE */
if( empty($arr["error"]) ){
	// $value = '';
	// foreach ($_POST as $key => $val) {
	// 	if( $key == "team_id" ) continue;

	// 	$value .= !empty($value) ? "," : "";
	// 	$value .= "{$key}='{$val}'";
	// }

	$sql->table = "team";
	// $sql->value = $value;
	$sql->value = "team_name='{$_POST["team_name"]}',sport_id='{$_POST["sport_id"]}'";
	$sql->condition = "WHERE team_id={$_POST["team_id"]}";
	if( $sql->update() ){
	$arr = [
			"type" => "success",
			"title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
            "url" => URL."admin/team/?page=team",
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