<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

$title = ' เพิ่มสถานะ';
$action = URL . "admin/result/save.php?page=sport&sub=result";

if (!empty($_GET["id"])) {
    $title = "แก้ไขสถานะ";
    //   $sql->table = "match";
    //   $sql->field = "*";
    //   $sql->condition = "WHERE match_id={$_GET["id"]}";
    //   $res = mysqli_fetch_assoc($sql->select());

    $action = URL . "admin/result/update.php?page=sport&sub=result";
}

$arr['title'] = $title;
$arr['headClose'] = true;

$arr['form'] = '<form class="form-submit" action="' . $action . '" method="POST">';

$arr['body'] = ' ';

$arr['btnsubmit'] = '<button type="submit" class="btn btn-primary btn-submit">บันทึก</button>';
$arr['btnclose'] = '<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';

// $arr['bgClose'] = true;

echo json_encode($arr);
