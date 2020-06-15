<?php
include("../../config.php");
include("../../app/SQLiManager.php");

$sql = new SQLiManager();

//CHECK DATA BEFORE DELETE
$sql->table = "player";
$sql->condition = "WHERE player_id={$_GET["id"]}";
$query = $sql->select();
if (mysqli_num_rows($query) < 0) {
    $arr["type"] = "error";
    $arr["title"] = "ไม่พบข้อมูลที่ต้องการลบ";
    $arr["status"] = 422;
} else {
    if ($sql->delete()) {
        $arr["type"] = "success";
        $arr["title"] = "ลบข้อมูลเรียบร้อยแล้ว";
        $arr["url"] = "refresh";
        $arr["status"] = 200;
    } else {
        $arr["type"] = "error";
        $arr["title"] = "ไม่สามารถลบข้อมูลได้ เนื่องจากข้อมูลมีการใช้งานอยู่";
        $arr["status"] = 422;
    }
}
echo json_encode($arr);
