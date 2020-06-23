<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

$title = '<i class="fa fa-check"></i> เพิ่มชนิดกีฬา';
$action = URL."admin/sports/save.php?page=sport&sub=sports";
if (!empty($_GET["id"])) {
  $title = "แก้ไขชนิดกีฬา";
  $sql->table = "sport";
  $sql->field = "*";
  $sql->condition = "WHERE sport_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());

  $action = URL."admin/sports/update.php?page=sport&sub=sports";

  if( !empty($res["sport_id"]) ) {
      $arr['hiddenInput'][] = ['name'=>'sport_id', 'value'=>$res["sport_id"]];
  }
}

$arr['headClose'] = true;
$arr['title'] = $title;

$arr['form'] = '<form class="form-submit" action="'.$action.'" method="POST">';

$arr['body'] = '
<div class="form-group">
    <label for="sport_name">ชนิดกีฬา</label>
    <input type="text" class="form-control" id="sport_name" name="sport_name" placeholder="ชนิดกีฬา" value="'.(!empty($res["sport_name"]) ? $res["sport_name"] : "").'">
    <div class="invalid-feedback"></div>
</div>
<div class="form-group">
    <label for="sport_player">จำนวนผู้เล่นต่อทีม</label>
    <input type="text" class="form-control" id="sport_player" name="sport_player" placeholder="จำนวนผู้เล่นต่อทีม" value="'.(!empty($res["sport_player"]) ? $res["sport_player"] : "").'">
    <div class="invalid-feedback"></div>
</div>';

$arr['btnsubmit'] = '<button type="submit" class="btn btn-primary btn-submit">บันทึก</button>';
$arr['btnclose'] = '<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';

echo json_encode($arr);