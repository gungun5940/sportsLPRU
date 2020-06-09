<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

/* OLD DATA FOR CHECK */
$sql->table = "tournament";
$sql->condition = "WHERE tournament_id={$_POST["tournament_id"]}";
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

if( !empty($_POST["tournament_name"]) ){
    $has = true;
    if( $old["tournament_name"] == $_POST["tournament_name"] ) $has = false;
    

    if( checkStr($_POST["tournament_name"]) < 5 ) $arr["error"]["tournament_name"] = "กรุณากรอกข้อมูล 5 ตัวอักษรขึ้นไป";
    $sql->table = "tournament";
	$sql->condition = "WHERE tournament_name='{$_POST["tournament_name"]}'";
	$query = $sql->select();
	if( mysqli_num_rows($query) > 0 && $has ){
		$arr["error"]["tournament_name"] = "ตรวจสอบพบข้อมูลทีมซ้ำกันในฐานข้อมูล";
	}
}
/* END CHECK ZONE */
if( empty($arr["error"]) ){
	$sql->table = "tournament";
	$sql->value = "tournament_name='{$_POST["tournament_name"]}',startdate='{$_POST["startdate"]}',enddate='{$_POST["enddate"]}'";
	$sql->condition = "WHERE tournament_id={$_POST["tournament_id"]}";
	if( $sql->update() ){

        $sql->table = "tournament_sport";
        $sql->condition = "WHERE tournament_id={$_POST["tournament_id"]}";
        $sql->delete();

        //INSERT ประเภทกีฬา
        for($i = 0; $i < count($_POST["sport_id"]); $i++){
            $sql->table = "tournament_sport";
            $sql->field = "tournament_id,sport_id";
            $sql->value = "'{$_POST["tournament_id"]}','{$_POST["sport_id"][$i]}'";
            $query = $sql->insert();
        }
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