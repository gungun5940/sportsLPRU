<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<!-- Notifications Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-user"></i> บัญชีผู้ใช้งาน (<?=strtoupper($auth["username"])?>)
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="<?=URL?>admin/profile/index.php"><i class="fas fa-users-cog"></i> ตั้งค่าข้อมูลผู้ใช้</a>
				<a class="dropdown-item" href="<?=URL?>admin/profile/password.php"><i class="fas fa-key"></i> เปลี่ยนรหัสผ่าน</a>
				<div class="dropdown-divider"></div>
				<?php 
				$ops = [
					"title" => "ยืนยันการออกจากระบบ",
					"text" => "คุณต้องการออกจากระบบใช่หรือไม่ ?"
				];
				?>
				<a class="dropdown-item btn-confirm bg-danger" href="<?=URL?>logout.php" data-options="<?=stringify($ops)?>"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
			</div>
		</li>
		<!-- <li class="nav-item">
			<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
				<i class="fas fa-th-large"></i>
			</a>
		</li> -->
	</ul>
</nav>