<?php
include("../config.php");
include("../app/SQLiManager.php");

foreach ($_POST as $key => $value) {
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูล ".strtoupper($key);
}

if( empty($arr["error"]) ){
	$sql = new SQLiManager();

	$sql->table = "user";
	$sql->condition = "WHERE username='{$_POST["username"]}' AND password ='{$_POST["password"]}' LIMIT 1";
	$query = $sql->select();

	if( mysqli_num_rows($query) > 0 ){
		$result = mysqli_fetch_assoc($query);

			session_start();
			$_SESSION["admin"] = $result["user_id"];

			$arr["type"] = "success";
			$arr["title"] = "เข้าสู่ระบบเรียบร้อย";
			$arr["text"] = "ยินดีต้อนรับ {$result["user_name"]} เข้าสู่ระบบ";
			$arr["url"] = URL."admin/";
			$arr["status"] = 200;

	}
	else{
		$arr["error"]["username"] = "กรุณาตรวจสอบชื่อผู้ใช้อีกครั้ง";
		$arr["error"]["password"] = "กรุณาตรวจสอบรหัสผ่านอีกครั้ง";
	}
}

echo json_encode($arr);