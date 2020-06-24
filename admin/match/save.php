<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

foreach ($_POST as $key => $value) {
    // if( $key == "sport_name" ) continue;
    if (empty($value)) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

if( !empty($_POST["team_a"]) && !empty($_POST["team_b"]) ){
    if( $_POST["team_a"] == $_POST["team_b"] ){
        $arr['error']['team_a'] = 'กรุณาเลือกทีมที่แตกต่างกัน';
        $arr['error']['team_b'] = 'กรุณาเลือกทีมที่แตกต่างกัน';
    }
}

// if (!empty($_POST["team_name"])) {
    // if (checkStr($_POST["team_name"]) < 5) $arr["error"]["team_name"] = "กรุณากรอกข้อมูล 5 ตัวอักษรขึ้นไป";
    // $sql->table = "team";
    // $sql->condition = "WHERE team_name='{$_POST["team_name"]}'";
    // $query = $sql->select();
    // if (mysqli_num_rows($query) > 0) {
    //     $arr["error"]["tournament_name"] = "ตรวจสอบพบข้อมูลทีมซ้ำกันในฐานข้อมูล";
    // }
// }

if (empty($arr["error"])) {
    $sql->table = "matchs";
    $sql->field = "tournament_id,sport_id,ts_id,team_a,team_b,match_date";
    $sql->value = "'{$_POST["tournament_id"]}','{$_POST["sport_id"]}','{$_POST["ts_id"]}','{$_POST["team_a"]}','{$_POST["team_b"]}','{$_POST["match_date"]}'";
    if ($sql->insert()) {

        $sql->table = "team";
        $sql->value = "team_status=1";
        $sql->condition = "WHERE team_id={$_POST["team_a"]}";
        $sql->update();

        $sql->table = "team";
        $sql->value = "team_status=1";
        $sql->condition = "WHERE team_id={$_POST["team_b"]}";
        $sql->update();

        $arr = [
            "type" => "success",
            "title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
            "url" => URL . 'admin/match/index.php?page=sport&sub=tournament&id='.$_POST['ts_id'],
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
