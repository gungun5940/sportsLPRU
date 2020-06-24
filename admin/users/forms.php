<?php 
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");

$_title = "เพิ่มข้อมูลผู้ใช้งาน";
$_action = URL."admin/users/save.php?page={$_GET["page"]}";
//EDIT DATA
if( !empty($_GET["id"]) ){
	$sql->table = "user";
	$sql->condition = "WHERE user_id={$_GET["id"]} LIMIT 1";
	$query = $sql->select();
	if( mysqli_num_rows($query) <= 0 ){
		header('location:'.URL.'admin/users/?page='.$_GET['page']);
		exit;
	}
	$result = mysqli_fetch_assoc($query);

	//SET FORM
	$_title = "แก้ไขข้อมูลผู้ใช้งาน";
	$_action = URL."admin/users/update.php?page={$_GET["page"]}";
}
?>
<!-- Content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="clearfix">
						<h4 class="m-0 text-dark float-left"><?= !empty($_title) ? $_title : "" ?></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<form class="form-submit" action="<?=$_action?>" method="POST">
					<div class="card-body">
						<div class="form-group">
							<label for="name">ชื่อ-นามสกุล</label>
							<input type="name" class="form-control" id="name" name="name" placeholder="กรอกชื่อ-นามสกุล" value="<?= !empty($result["name"]) ? $result["name"] : "" ?>">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="username">ชื่อผู้ใช้ (Username)</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= !empty($result["username"]) ? $result["username"] : "" ?>">
							<div class="invalid-feedback"></div>
						</div>
						<?php if( empty($result) ) { ?>
							<div class="form-group">
								<label for="password">รหัสผ่าน (Password)</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group">
								<label for="password2">ยืนยันรหัสผ่าน (Confirm Password)</label>
								<input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
								<div class="invalid-feedback"></div>
							</div>
						<?php }else{
							echo '<input type="hidden" name="id" value="'.$result["id"].'">';
							echo '<div class="clearfix">
									<a href='.URL.'admin/users/password.php?id='.$result["id"].'&page='.$_GET["page"].' class="btn btn-sm btn-warning float-right">เปลี่ยนรหัสผ่าน</a>
								  </div>';
						} ?>
					</div>
					<div class="card-footer">
						<div class="clearfix">
							<a href="<?=URL?>admin/users/?page=<?=$_GET["page"]?>" class="btn btn-danger float-left">
								<i class="fa fa-arrow-left"></i> กลับหน้าหลัก
							</a>
							<button type="submit" class="btn btn-primary btn-submit float-right">
								<i class="fa fa-save"></i> บันทึกข้อมูล
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
<!-- End Content -->
<?php
//FOOTER
include($_pathURL."admin/layouts/footer.php");
?>