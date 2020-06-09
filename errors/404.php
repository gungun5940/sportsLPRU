<?php 
include("../config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=PLUGINS?>fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<link rel="stylesheet" href="<?=PLUGINS?>bootstrap/css/bootstrap.css">
	<style type="text/css" media="screen">
		body {
			background: #dedede;
		}
		.page-wrap {
			min-height: 100vh;
		}
	</style>
</head>
<body>
	<div class="page-wrap d-flex flex-row align-items-center">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 text-center">
					<span class="display-1 d-block">404</span>
					<div class="mb-4 lead">ไม่มีเพจนี้ในระบบ หรือเพจนี้อาจถูกออกไปแล้ว</div>
					<a class="btn btn-primary btn-back text-white">กลับไปก่อนหน้านี้</a>
				</div>
			</div>
		</div>
	</div>
	<!-- jQuery -->
	<script src="<?=PLUGINS?>jquery/jquery.min.js"></script>
	<script src="<?=PLUGINS?>bootstrap/js/bootstrap.bundle.js"></script>
	<script type="text/javascript">
		$(".btn-back").click(function(event) {
			window.history.back();
		});
	</script>
</body>
</html>