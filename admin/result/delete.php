<?php
include("../../config.php");
include("../../app/SQLiManager.php");

$sql = new SQLiManager();

//CHECK DATA BEFORE DELETE
$sql->table = "tournament_sport";
$sql->condition = "WHERE ts_id={$_GET["id"]}";
$query = $sql->select();
if (mysqli_num_rows($query) < 0) {
    $arr["type"] = "error";
    $arr["title"] = "ไม่พบข้อมูลที่ต้องการลบ";
    $arr["status"] = 422;
} else {
    if ($sql->delete()) {
        // $sql->table = "file";
        // $sql->condition = "WHERE ts_id={$_GET["id"]}";
        // $sql->delete();
        $ts_id = $_POST["id"];
        if (!empty($_POST["file_id"])) {
            foreach ($_POST["file_id"] as $key => $file_id) {
                $sql->table = "file";
                $sql->condition = "WHERE file_id={$file_id} AND ts_id={$ts_id}";
                $data = mysqli_fetch_assoc($sql->select());

                if (empty($data)) continue; //Check Data

                /* DELETE FILE */
                if (file_exists("../filePDF/{$data["ts_file"]}")) {
                    unlink("../filePDF/{$data["ts_file"]}");
                }

                /* DELETE DATABASE */
                $sql->delete();
            }
        }
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
