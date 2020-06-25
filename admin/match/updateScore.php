<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

$sql = new SQLiManager();

/* OLD DATA FOR CHECK */
$sql->table = "matchs";
$sql->condition = "WHERE match_id={$_POST["match_id"]}";
$query = $sql->select();
if (mysqli_num_rows($query) <= 0) {
	$arr = [
		"title" => "เกิดข้อผิดพลาด",
		"text" => "ไม่สามารถเข้าถึงข้อมูลที่ต้องการแก้ไข หรือไม่พบข้อมูล",
		"type" => "error",
		"url" => URL . "admin/match/?page=sport&sub=match"
	];
	echo json_encode($arr);
	exit;
}
$old = mysqli_fetch_assoc($query);
/* END OLD DATA */

if (empty($arr['error'])) {

	$match_cutout = !empty($_POST["match_cutout"]) ? $_POST["match_cutout"] : 0;

	$sql->table = "matchs";
	$sql->value = "score_a='{$_POST["score_a"]}', score_b='{$_POST["score_b"]}', match_cutout='{$match_cutout}'";
	$sql->condition = "WHERE match_id={$old["match_id"]}";
	if ($sql->update()) {
		if ($_POST["score_a"] > $_POST["score_b"]) {
			$teamwin = $old["team_a"];

			$sql->table = "team";
			$sql->condition = "WHERE team_id={$old["team_a"]}";
			$query = $sql->select();
			$team = mysqli_fetch_assoc($query);

			$point = $team['team_point'] + 1;

			$sql->value = "team_status=0, team_point='{$point}'";
			$sql->update();

			if (!empty($_POST["match_cutout"])) {
				$sql->table = "team";
				$sql->value = "team_status=2";
				$sql->condition = "WHERE team_id={$old["team_b"]}";
				$sql->update();
			}
		}

		if ($_POST["score_b"] > $_POST["score_a"]) {
			$teamwin = $old["team_b"];

			$sql->table = "team";
			$sql->condition = "WHERE team_id={$old["team_b"]}";
			$query = $sql->select();
			$team = mysqli_fetch_assoc($query);

			$point = $team['team_point'] + 1;

			$sql->value = "team_status=0, team_point='{$point}'";
			$sql->update();

			if (!empty($_POST["cutout"])) {
				$sql->table = "team";
				$sql->value = "team_status=2";
				$sql->condition = "WHERE team_id={$old["team_a"]}";
				$sql->update();
				
			}
		}

		$sql->table = "matchs";
		$sql->value = "team_win='{$teamwin}'";
		$sql->condition = "WHERE match_id={$old["match_id"]}";
		$sql->update();
		$arr = [
			"type" => "success",
			"title" => "บันทึกข้อมูลเรียบร้อย",
			"url" => "refresh",
			"status" => 200
		];
	} else {
		$arr = [
			"type" => "error",
			"title" => "ไม่สามารถบันทึกข้อมูลได้",
			"status" => 422
		];
	}
}
echo json_encode($arr);
