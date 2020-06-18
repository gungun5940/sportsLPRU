<?php
include("../../config.php");
include(WWW_PATH."app/SQLiManager.php");
include(WWW_PATH."app/fn.php");

$sql = new SQLiManager();

/* OLD DATA FOR CHECK */
$sql->table = "tournament_sport";
$sql->condition = "WHERE ts_id={$_POST["ts_id"]}";
$query = $sql->select();
if (mysqli_num_rows($query) <= 0) {
    $arr = [
        "title" => "เกิดข้อผิดพลาด",
        "text" => "ไม่สามารถเข้าถึงข้อมูลที่ต้องการแก้ไข หรือไม่พบข้อมูล",
        "type" => "error",
        "url" => URL . "admin/result/?page=sport&sub=result"
    ];
    echo json_encode($arr);
    exit;
}
$old = mysqli_fetch_assoc($query);
/* END OLD DATA */

foreach ($_POST as $key => $value) {
    if (empty($value)) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

/* END CHECK ZONE */
if (empty($arr["error"])) {
    $value = '';
    foreach ($_POST as $key => $val) {
        if ($key == "ts_id") continue;

        $value .= !empty($value) ? "," : "";
        $value .= "{$key}='{$val}'";
    }

    $sql->table = "tournament_sport ts LEFT JOIN tournament t ON ts.tournament_id=t.tournament_id LEFT JOIN sport sp ON ts.sport_id=sp.sport_id";
    // $sql->value = "ts_startdate='{$_POST["ts_startdate"]}',ts_enddate='{$_POST["ts_enddate"]}',tournament_name='{$_POST["tournament_name"]}',sport_name='{$_POST["sport_name"]}',ts_status='{$_POST["ts_status"]}'";
    $sql->value = $value;
    $sql->condition = "WHERE ts_id={$_POST["ts_id"]}";
    if ($sql->update()) {

        $sql->table = "file";
        $sql->condition = "WHERE ts_id={$_POST["ts_id"]}";
        $sql->delete();
       
        $typeFile = strtolower(strrchr($_FILES["ts_file"]["name"], "."));
        if( $typeFile = ".pdf" )
    
        $newNameFile = "ts_file".date("Y_m_d")."_".rand(100000,999999)."_".$_POST["ts_id"].$typeFile;
        if( move_uploaded_file($_FILES["ts_file"]["tmp_name"], "../filePDF/".$newNameFile) ){
          $sql->table = "file";
          $sql->field = "ts_id,ts_file";
          $sql->value = "'{$_POST["ts_id"]}', '{$newNameFile}'";
          $query = $sql->insert();
        }
        
        $arr = [
            "type" => "success",
            "title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
            "url" => URL . "admin/result/?page=sport&sub=result",
            "status" => 200
        ];
    } else {
        $arr = [
            "type" => "error",
            "title" => "ไม่สามารถบันทึกข้อมูลได้",
            "status" => 404
        ];
    }
}



echo json_encode($arr);
