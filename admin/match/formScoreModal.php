<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

if (!empty($_GET["id"])) {
  $title = "แก้ไขคะแนน";
  $sql->table = "matchs";
  $sql->field = "*";
  $sql->condition = "WHERE match_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());

  $action = URL."admin/match/updateScore.php?page=sport&sub=match";

  $arr['hiddenInput'][] = ['name'=>'match_id', 'value'=>$_GET["id"]];
  
}
 
                
$arr['title'] = $title;
$arr['headClose'] = true;

$arr['form'] = '<form class="form-submit" action="' . $action . '" method="POST">';

$cutoutChecked = '';
if( !empty($res['match_cutout']) ){
        $cutoutChecked = 'checked';
}

$arr['body'] = '    
                    <div class="form-group">
                            <label for="score_a">คะแนนทีมที่ 1</label>
                            <input type="text" class="form-control" id="score_a" name="score_a" placeholder="คะแนนทีมที่ 1" value="' . (!empty($res["score_a"]) ? $res["score_a"] : "") . '">
                    <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                            <label for="score_b">คะแนนทีมที่ 2</label>
                            <input type="text" class="form-control" id="score_b" name="score_b" placeholder="คะแนนทีมที่ 2" value="' . (!empty($res["score_b"]) ? $res["score_b"] : "") . '">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="cutout" name="cutout" value="1" '.$cutoutChecked.'>
                        <label class="form-check-label" for="cutout">แพ้คัดทีมออก</label>
                    </div>';
             

$arr['btnsubmit'] = '<button type="submit" class="btn btn-primary btn-submit">บันทึก</button>';
$arr['btnclose'] = '<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';

// $arr['bgClose'] = true;

echo json_encode($arr);
