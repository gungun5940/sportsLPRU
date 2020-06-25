<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

$title = ' สร้าง MATCH';
$action = URL."admin/match/save.php?page=sport&sub=match";

$sql->table = "tournament_sport";
$sql->condition = "WHERE ts_id={$_GET["ts"]}";
$tsQuery = $sql->select();
$ts = mysqli_fetch_assoc($tsQuery);
$arr['hiddenInput'][] = ['name'=>'ts_id', 'value'=>$_GET['ts']];
$arr['hiddenInput'][] = ['name'=>'tournament_id', 'value'=>$ts['tournament_id']];
$arr['hiddenInput'][] = ['name'=>'sport_id', 'value'=>$ts['sport_id']];

$sql->table = "team";
$sql->condition = "WHERE ts_id={$_GET["ts"]} AND team_status=0";
$query = $sql->select();
$query2 = $sql->select();

if (!empty($_GET["id"])) {
  $title = "แก้ไข MATCH";
  $sql->table = "matchs";
  $sql->field = "*";
  $sql->condition = "WHERE match_id={$_GET["id"]}";
  $mQuery = $sql->select();
  $result = mysqli_fetch_assoc($mQuery);

  $action = URL."admin/match/update.php?page=sport&sub=match";
  $arr['hiddenInput'][] = ['name'=>'match_id', 'value'=>$_GET["id"]];
}

$options = '';
$options2 = '';

if( !empty($result['team_a']) ){
        $sql->table = "team";
        $sql->condition = "WHERE team_id={$result['team_a']}";
        $qTeamA = $sql->select();
        $teamA = mysqli_fetch_assoc($qTeamA);
        
        $options .= '<option value="'.$teamA['team_id'].'" selected>'.$teamA['team_name'].'</option>';
        $options2 .= '<option value="'.$teamA['team_id'].'">'.$teamA['team_name'].'</option>';
}

if( !empty($result['team_b']) ){
        $sql->table = "team";
        $sql->condition = "WHERE team_id={$result['team_b']}";
        $qTeamB = $sql->select();
        $teamB = mysqli_fetch_assoc($qTeamB);

        $options .= '<option value="'.$teamB['team_id'].'">'.$teamB['team_name'].'</option>';
        $options2 .= '<option value="'.$teamB['team_id'].'" selected>'.$teamB['team_name'].'</option>';
}

while($team = mysqli_fetch_assoc($query)){
        $options .= '<option value="'.$team['team_id'].'">'.$team['team_name'].'</option>';
}
while($team = mysqli_fetch_assoc($query2)){
        $options2 .= '<option value="'.$team['team_id'].'">'.$team['team_name'].'</option>';
}

$arr['title'] = $title;
$arr['headClose'] = true;

$arr['form'] = '<form class="form-submit" action="' . $action . '" method="POST">';

$datetime = '';
if( !empty($result["match_date"]) ){
        $date = date("Y-m-d", strtotime($result["match_date"]));
        $time = date("H:i", strtotime($result["match_date"]));
        $datetime = "{$date}T{$time}";
}

$arr['body'] = '    <div class="form-group">
                          <label for="match_date">วันที่และเวลาแข่ง</label>
                            <input type="datetime-local" class="form-control" id="match_date" name="match_date" value="' . (!empty($result["match_date"]) ? $datetime : "") . '">
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
