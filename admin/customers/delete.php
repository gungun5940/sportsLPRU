<?php
include("../../config.php");
include("../../app/SQLiManager.php");

$sql = new SQLiManager();

//CHECK DATA BEFORE DELETE
$sql->table = "customers";
$sql->condition = "WHERE id={$_GET["id"]}";
$query = $sql->select();
if( mysqli_num_rows($query) < 0 ){
	$arr["type"] = "error";
	$arr["title"] = "ไม่พบข้อมูลที่ต้องการลบ";
	$arr["status"] = 422;
}
else{
	$sql->table = "borrows";
	$sql->condition = "WHERE customer_id={$_GET["id"]}";
	$query = $sql->select();
	if( mysqli_num_rows($query) <= 0 ){
		$sql->table = "customers";
		$sql->condition = "WHERE id={$_GET["id"]}";
		if( $sql->delete() ){
			$arr["type"] = "success";
			$arr["title"] = "ลบข้อมูลเรียบร้อยแล้ว";
			$arr["url"] = "refresh";
			$arr["status"] = 200;
		}
		else{
			$arr["type"] = "error";
			$arr["title"] = "ไม่สามารถลบข้อมูลได้";
			$arr["status"] = 422;
		}
	}
	else{
		$arr["type"] = "error";
		$arr["title"] = "ไม่สามารถลบข้อมูลได้";
		$arr["text"] = "เนื่องจากมีข้อมูลใบสมัครสินเชื่ออยู่ในระบบ";
		$arr["status"] = 422;
	}
}
echo json_encode($arr);