<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$action = URL."admin/player/update.php?page=sport&sub=player";

$arr["title"] = "หัว Modal";

$arr['headClose'] = true;

$arr['form'] = '<form class="form-submit" action="'.$action.'" method="POST">';

$arr['body'] = '<div class="card-body">
                    <div class="form-group">
                            <label for="player_name">ชื่อสมาชิก</label>
                            <input type="text" class="form-control" id="player_name" name="player_name" placeholder="ชื่อสมาชิก" value="'.(!empty($res["player_name"]) ? $res["player_name"] : "").'">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                            <label for="player_name">ชื่อสมาชิก</label>
                            <input type="text" class="form-control" id="player_name" name="player_name" placeholder="ชื่อสมาชิก" value="'.(!empty($res["player_name"]) ? $res["player_name"] : "").'">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>';

$arr['btnsubmit'] = '<button type="submit" class="btn btn-primary btn-submit">บันทึก</button>';
$arr['btnclose'] = '<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';

// $arr['bgClose'] = true;

echo json_encode($arr);