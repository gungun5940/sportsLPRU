<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

/* OLD DATA FOR CHECK */
$sql->table = "tournament_sport";
$sql->condition = "WHERE ts_id={$_POST["ts_id"]}";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
	$arr = [
		"title" => "เกิดข้อผิดพลาด",
		"text" => "ไม่สามารถเข้าถึงข้อมูลที่ต้องการแก้ไข หรือไม่พบข้อมูล",
		"type" => "error",
		"url" => URL."admin/tournamentSport/?page=tournamentSport"
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

if( !empty($_POST["tournament_name"]) ){
    $has = true;
    if( $old["tournament_name"] == $_POST["tournament_name"] ) $has = false;
    

	if( checkStr($_POST["ts_place"]) < 5 ) $arr["error"]["ts_place"] = "กรุณากรอกข้อมูล 5 ตัวอักษรขึ้นไป";
	if( !checkEngThai($_POST["ts_place"]) ){
        $arr["error"]["ts_place"] = "กรุณากรอกภาษาไทยหรือภาษาอังกฤษ";
    }
    // $sql->table = "tournament";
	// $sql->condition = "WHERE tournament_name='{$_POST["tournament_name"]}'";
	// $query = $sql->select();
	// if( mysqli_num_rows($query) > 0 && $has ){
	// 	$arr["error"]["tournament_name"] = "ตรวจสอบพบข้อมูลทีมซ้ำกันในฐานข้อมูล";
	// }
}
/* END CHECK ZONE */
if( empty($arr["error"]) ){
	$sql->table = "tournament_sport";
	$sql->value = "ts_startdate='{$_POST["ts_startdate"]}',ts_enddate='{$_POST["ts_enddate"]}',ts_place='{$_POST["ts_place"]}'";
	$sql->condition = "WHERE ts_id={$_POST["ts_id"]}";
	if( $sql->update() ){
	$arr = [
			"type" => "success",
			"title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
			"url" => URL.'admin/tournamentSport/index.php?page=sport&sub=tournament&id='.$_POST["tournament_id"],
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