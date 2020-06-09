<?php 
include("../config.php");
ob_start();
session_start();

if( !empty($_SESSION["admin"]) ){
	header("location:".URL."admin");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LOGIN TO MANAGEMENT SYSTEM</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=PLUGINS?>fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?=PLUGINS?>datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- SWEETALERT -->
	<link rel="stylesheet" href="<?=CSS?>sweetalert2.css">
	<!-- Theme style -->
  	<link rel="stylesheet" href="<?=CSS?>/adminlte.min.css">
</head>
<body>
	<div class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href="<?=URL?>">Admin Management System</a>
			</div>
			<!-- /.login-logo -->
			<div class="card">
				<div class="card-body login-card-body">
					<!-- <p class="login-box-msg">เข้าสู่ระบบ</p> -->

					<form action="checkLogin.php" method="post" class="form-submit">
						<div class="input-group mb-3">
							<input type="text" class="form-control" name="username" placeholder="Username">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-user"></span>
								</div>
							</div>
							<div class="invalid-feedback"></div>
						</div>
						<div class="input-group mb-3">
							<input type="password" class="form-control" name="password" placeholder="Password">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
							<div class="invalid-feedback"></div>
						</div>
						<div class="row">
							<!-- /.col -->
							<div class="col-12">
								<button type="submit" class="btn btn-primary btn-block btn-submit">เข้าสู่ระบบ</button>
							</div>
							<!-- /.col -->
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- jQuery -->
	<script src="<?=PLUGINS?>jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?=PLUGINS?>jquery-ui/jquery-ui.min.js"></script>
	<script src="<?=JS?>main.js"></script>
	<script src="<?=JS?>sweetalert2.js"></script>
</body>
</html>