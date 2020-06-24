<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

$title = ' สร้าง MATCH';
$action = URL."admin/match/save.php?page=sport&sub=match";

$sql->table = "team";
$sql->condition = "WHERE ts_id={$_GET["ts"]} AND team_status=0";
$query = $sql->select();
$query2 = $sql->select();

$options = '';
while($team = mysqli_fetch_assoc($query)){
        $options .= '<option value="'.$team['team_id'].'">'.$team['team_name'].'</option>';
}

$options2 = '';
while($team = mysqli_fetch_assoc($query2)){
        $options2 .= '<option value="'.$team['team_id'].'">'.$team['team_name'].'</option>';
}

if (!empty($_GET["id"])) {
  $title = "แก้ไข MATCH";
  $sql->table = "matchs";
  $sql->field = "*";
  $sql->condition = "WHERE ts_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());

  $action = URL."admin/match/update.php?page=sport&sub=match";
  $arr['hiddenInput'][] = ['name'=>'match_id', 'value'=>$_GET["id"]];
}

$arr['title'] = $title;
$arr['headClose'] = true;

$arr['form'] = '<form class="form-submit" action="' . $action . '" method="POST">';

$arr['body'] = '    <div class="form-group">
                            <label for="match_date">วันที่และเวลาแข่ง</label>
                            <input type="datetime-local" class="form-control" id="match_date" name="match_date" value="' . (!empty($res["match_date"]) ? $res["match_date"] : "") . '">
                    <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                            <label for="team_a">ทีมที่ 1</label>
                            <select class="form-control" id="team_a" name="team_a">
                                <option value="">- เลือกทีมที่ 1 -</option>
                                '.$options.'
                            </select>
                    <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                            <label for="team_b">ทีมที่ 2</label>
                            <select class="form-control" id="team_b" name="team_b">
                                <option value="">- เลือกทีมที่ 2 -</option>
                                '.$options2.'
                            </select>
                        <div class="invalid-feedback"></div>
                    </div>';

$arr['btnsubmit'] = '<button type="submit" class="btn btn-primary btn-submit">บันทึก</button>';
$arr['btnclose'] = '<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';

// $arr['bgClose'] = true;

echo json_encode($arr);
