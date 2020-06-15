<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

// foreach( $_POST["player_name"] as $seq => $name ){
//     $sql->table = "player";
//     $sql->field = "team_id, player_name, seq";
//     $sql->value = "'{$id}', '{$name}', '{$seq}'";
//     $sql->insert();
// }

foreach ($_POST as $key => $value) {
    if( $key == "player_name" ) continue;
    if (empty($value)) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

if (!empty($_POST["team_name"])) {
    if (checkStr($_POST["team_name"]) < 5) $arr["error"]["team_name"] = "กรุณากรอกข้อมูล 5 ตัวอักษรขึ้นไป";
    $sql->table = "team";
    $sql->condition = "WHERE team_name='{$_POST["team_name"]}'";
    $query = $sql->select();
    if (mysqli_num_rows($query) > 0) {
        $arr["error"]["team_name"] = "ตรวจสอบพบข้อมูลทีมซ้ำกันในฐานข้อมูล";
    }
}

if (empty($arr["error"])) {
    $sql->table = "team";
    $sql->field = "team_name, ts_id, tournament_id, sport_id";
    $sql->value = "'{$_POST["team_name"]}', '{$_POST["ts_id"]}', '{$_POST["tournament_id"]}', '{$_POST["sport_id"]}'";
    if ($sql->insert()) {
        $team_id = mysqli_insert_id($sql->connect);
        foreach( $_POST["player_name"] as $seq => $name ){
            if( empty($name) ) continue;
            $sql->table = "player";
            $sql->field = "team_id, player_name, seq";
            $sql->value = "'{$team_id}', '{$name}', '{$seq}'";
            $sql->insert();
        }
        $arr = [
            "type" => "success",
            "title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
            "url" => URL . 'admin/team/index.php?page=sport&sub=tournament&id='.$_POST["ts_id"],
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
