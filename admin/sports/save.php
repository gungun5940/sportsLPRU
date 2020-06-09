<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

foreach ($_POST as $key => $value) {
    // if( $key == "sport_name" ) continue;
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

if( !empty($_POST["sport_name"]) ){
    if( checkStr($_POST["sport_name"]) < 5 ) $arr["error"]["sport_name"] = "กรุณากรอกข้อมูล 5 ตัวอักษรขึ้นไป";
    $sql->table = "sport";
	$sql->condition = "WHERE sport_name='{$_POST["sport_name"]}'";
	$query = $sql->select();
	if( mysqli_num_rows($query) > 0 ){
		$arr["error"]["sport_name"] = "ตรวจสอบพบข้อมูลชนิดกีฬาซ้ำกันในฐานข้อมูล";
	}
}

if( empty($arr["error"]) ){
    $sql->table = "sport";
    $sql->field = "sport_name";
    $sql->value = "'{$_POST["sport_name"]}'";
    if ($sql->insert()) {
        $arr = [
			"type" => "success",
			"title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
			"url" => URL.'admin/sports/?page=sport&sub=sports',
			"status" => 200
        ];
    } 
    else {
        $arr = [
			"type" => "error",
			"title" => "ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
			"status" => 422
        ];
    }
}

echo json_encode($arr);