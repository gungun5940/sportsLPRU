<?php 
$_title = "เปลี่ยนรหัสผ่าน";

// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");

//EDIT DATA
$sql->table = "user";
$sql->condition = "WHERE user_id='{$_SESSION["admin"]}' LIMIT 1";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
	header('location:'.URL.'admin/users/?page='.$_GET['page']);
	exit;
}
$result = mysqli_fetch_assoc($query);
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
				<label class="ml-3 mt-3"><i class="fa fa-user"></i> ข้อมูลผู้ใช้งาน</label>
				<ul>
					<li><span style="font-weight: bold;">Username :</span> <?=$result["username"]?></li>
					<li><span style="font-weight: bold;">ชื่อ-นามสกุล :</span> <?=$result["user_name"]?></li>
				</ul>
			</div>
			<div class="card">
				<form class="form-submit" action="<?=URL?>admin/profile/save.php?" method="POST">
					<div class="card-body">
						<div class="form-group">
							<label for="old_password">รหัสผ่านเดิม (Old Password)</label>
							<input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="password">รหัสผ่านใหม่ (New Password)</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="New Password">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="password2">ยืนยันรหัสผ่านใหม่ (Confirm Password)</label>
							<input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="card-footer">
						<div class="clearfix">
							<button class="btn btn-warning float-left text-white" type="reset"><i class="fas fa-eraser"></i> ยกเลิก</button>
							<button type="submit" class="btn btn-primary btn-submit float-right">
								<i class="fa fa-save"></i> เปลี่ยนรหัสผ่าน
							</button>
						</div>
					</div>
					<input type="hidden" name="user_id" value="<?=$result["user_id"]?>">
					<input type="hidden" name="action" value="password">
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