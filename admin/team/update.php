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
    

	if( checkStr($_POST["team_name"]) < 2 ) $arr["error"]["team_name"] = "กรุณากรอกข้อมูล 2 ตัวอักษรขึ้นไป";
	
    $sql->table = "team";
	$sql->condition = "WHERE team_name='{$_POST["team_name"]}'";
	$query = $sql->select();
	if( mysqli_num_rows($query) > 0 && $has ){
		$arr["error"]["team_name"] = "ตรวจสอบพบข้อมูลทีมซ้ำกันในฐานข้อมูล";
	}
}
/* END CHECK ZONE */
if( empty($arr["error"]) ){
	$sql->table = "team";
	$sql->value = "team_name='{$_POST["team_name"]}'";
	$sql->condition = "WHERE team_id={$_POST["team_id"]}";
	if( $sql->update() ){

		//** **/
		$sql->table = "player";
		$sql->condition = "WHERE team_id={$_POST["team_id"]}";
		$sql->delete();

		foreach( $_POST["player_name"] as $seq => $name ){
            if( empty($name) ) continue;
            $sql->table = "player";
            $sql->field = "team_id, player_name, seq";
			$sql->value = "'{$_POST["team_id"]}', '{$name}', '{$seq}'";
			$sql->insert();
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