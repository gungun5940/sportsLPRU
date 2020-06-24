<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

/* OLD DATA FOR CHECK */
$sql->table = "sport";
$sql->condition = "WHERE sport_id={$_POST["sport_id"]}";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
	$arr = [
		"title" => "เกิดข้อผิดพลาด",
		"text" => "ไม่สามารถเข้าถึงข้อมูลที่ต้องการแก้ไข หรือไม่พบข้อมูล",
		"type" => "error",
		"url" => URL."admin/sports/?page=sport&sub=sports"
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

if( !empty($_POST["sport_name"]) ){
    $has = true;
    if( $old["sport_name"] == $_POST["sport_name"] ) $has = false;
    

    if( checkStr($_POST["sport_name"]) < 2 ) $arr["error"]["sport_name"] = "กรุณากรอกข้อมูล 2 ตัวอักษรขึ้นไป";

    if( !checkEngThai($_POST["sport_name"]) ){
        $arr["error"]["sport_name"] = "กรุณากรอกภาษาไทยหรือภาษาอังกฤษ";
    }
    
    if( checkStr($_POST["sport_player"]) > 2 ) $arr["error"]["sport_player"] = "กรุณากรอกข้อมูล 1-2 ตัวเลขเท่านั้น";

    if( !checkNum($_POST["sport_player"]) ){
        $arr["error"]["sport_player"] = "กรุณากรอกจำนวนผู้เล่นต่อทีม";
    }
    $sql->table = "sport";
	$sql->condition = "WHERE sport_name='{$_POST["sport_name"]}'";
	$query = $sql->select();
	if( mysqli_num_rows($query) > 0 && $has ){
		$arr["error"]["sport_name"] = "ตรวจสอบพบข้อมูลชนิดกีฬาซ้ำกันในฐานข้อมูล";
	}
}
/* END CHECK ZONE */
if( empty($arr["error"]) ){
	$value = '';
	foreach ($_POST as $key => $val) {
		if( $key == "sport_id" ) continue;

		$value .= !empty($value) ? "," : "";
		$value .= "{$key}='{$val}'";
	}

	$sql->table = "sport";
	$sql->value = $value;
	$sql->condition = "WHERE sport_id={$_POST["sport_id"]}";
	if( $sql->update() ){
	$arr = [
			"type" => "success",
			"title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
            "url" => URL."admin/sports/?page=sport&sub=sports",
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