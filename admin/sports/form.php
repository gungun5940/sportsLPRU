<?php 
$_title = "จัดการชนิดกีฬา";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");
// SET TABLE //
$sql->table = "sport";

$title = "เพิ่ม".$_title;
$action = URL."admin/sports/save.php?page=sport&sub=sports";
if (!empty($_GET["id"])) {
  $title = "แก้ไข".$_title;
  $sql->field = "*";
  $sql->condition = "WHERE sport_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());

  $action = URL."admin/sports/update.php?page=sport&sub=sports";
}

/* SUBMIT */
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo $title; ?>ชนิดกีฬา</h1>
        </div>

      </div>
    </div>
  </div>

  <section class="content">
  <div class="container-fluid">
			<div class="card">
				<form class="form-submit" action="<?=$action?>" method="POST">
					<div class="card-body">
						<div class="form-group">
							<label for="sport_name">ชนิดกีฬา</label>
							<input type="text" class="form-control" id="sport_name" name="sport_name" placeholder="ชนิดกีฬา" value="<?= !empty($res["sport_name"]) ? $res["sport_name"] : "" ?>">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="sport_player">จำนวนผู้เล่นต่อทีม</label>
							<input type="text" class="form-control" id="sport_player" name="sport_player" placeholder="จำนวนผู้เล่นต่อทีม" value="<?= !empty($res["sport_player"]) ? $res["sport_player"] : "" ?>">
							<div class="invalid-feedback"></div>
						</div>
						<?php 
						if( !empty($res["sport_id"]) ) echo '<input type="hidden" name="sport_id" value="'.$res["sport_id"].'">';
						?>
					</div>
					<div class="card-footer">
						<div class="clearfix">
							<a href="<?=URL?>admin/sports/?page=team" class="btn btn-danger float-left">
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