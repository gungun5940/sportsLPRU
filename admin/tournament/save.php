<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

foreach ($_POST as $key => $value) {
    // if( $key == "sport_name" ) continue;
    if (empty($value)) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

if( empty($_POST["sport_id"]) ){
    $arr["error"]["sport_id"] = "กรุณาเลือกประเภทกีฬา";

    $arr["alert"] = true;
    $arr["type"] = "error";
    $arr["title"] = "กรุณาเลือกประเภทกีฬา";
    $arr["status"] = 422;
}

if (!empty($_POST["tournament_name"])) {
    if (checkStr($_POST["tournament_name"]) < 5) $arr["error"]["tournament_name"] = "กรุณากรอกข้อมูล 5 ตัวอักษรขึ้นไป";
    $sql->table = "tournament";
    $sql->condition = "WHERE tournament_name='{$_POST["tournament_name"]}'";
    $query = $sql->select();
    if (mysqli_num_rows($query) > 0) {
        $arr["error"]["tournament_name"] = "ตรวจสอบพบข้อมูลทีมซ้ำกันในฐานข้อมูล";
    }
}

if (empty($arr["error"])) {
    $sql->table = "tournament";
    $sql->field = "tournament_name,startdate,enddate";
    $sql->value = "'{$_POST["tournament_name"]}','{$_POST["startdate"]}','{$_POST["enddate"]}'";
    if ($sql->insert()) {
        $tournament_id = mysqli_insert_id($sql->connect);
        //INSERT ประเภทกีฬา
        for($i = 0; $i < count($_POST["sport_id"]); $i++){
            $sql->table = "tournament_sport";
            $sql->field = "tournament_id,sport_id";
            $sql->value = "'{$tournament_id}','{$_POST["sport_id"][$i]}'";
            $query = $sql->insert();
        }

        $arr = [
            "type" => "success",
            "title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
            "url" => URL . 'admin/tournament/?page=sport&sub=tournament',
            "status" => 200
        ];
    } else {
        $arr = [
            "type" => "error",
            "title" => "ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
            "status" => 422
        ];
    }
}

echo json_encode($arr);
