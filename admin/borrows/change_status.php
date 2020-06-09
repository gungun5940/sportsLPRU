<?php
include("../../config.php");
include("../../app/SQLiManager.php");

$sql = new SQLiManager();

$sql->table = "borrows";
$sql->value = "status='{$_POST["status"]}'";
$sql->condition = "WHERE id={$_POST["id"]}";
if( $sql->update() ){
	$arr["type"] = "success";
	$arr["title"] = "ปรับสถานะเรียบร้อยแล้ว";
	$arr["status"] = 200;
}
else{
	$arr["type"] = "error";
	$arr["title"] = "ไม่สามารถปรับสถานะได้ กรุณาลองใหม่อีกครั้ง";
	$arr["status"] = 422;
}
echo json_encode($arr);