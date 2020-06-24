<?php 
$_title = "เปลี่ยนรหัสผ่าน";

// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");

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
				<label class="ml-3 mt-3"><i class="fa fa-user"></i> ข้อมูลผู้ใช้งาน</label>
				<ul>
					<li><span style="font-weight: bold;">Username :</span> <?=$result["username"]?></li>
					<li><span style="font-weight: bold;">ชื่อ-นามสกุล :</span> <?=$result["name"]?></li>
				</ul>
			</div>
			<div class="card">
				<form class="form-submit" action="<?=URL?>admin/users/change_password.php?page=<?=$_GET["page"]?>" method="POST">
					<div class="card-body">
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
					<input type="hidden" name="id" value="<?=$result["id"]?>">
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