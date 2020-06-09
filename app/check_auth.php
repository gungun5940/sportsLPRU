<?php
ob_start();
session_start();

$sql = new SQLiManager(); //ONLY AUTH
if( !empty($_SESSION["admin"]) ){
	$sql->table = "user";
	$sql->field = "user_name, username";
	$sql->condition = "WHERE user_id={$_SESSION["admin"]}";
	$rsAuth = $sql->select();
}

if( !empty($rsAuth) ){
	if( mysqli_num_rows($rsAuth) <= 0 ){
		session_destroy();
		ob_clean();

		header("location:".URL);
	}
	else{
		$auth = mysqli_fetch_assoc($rsAuth);
	}
}