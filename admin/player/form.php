<?php 
$_title = "สมาชิก";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");
// SET TABLE //
$sql->table = "player";

// $title = "เพิ่ม".$_title;
// $action = URL."admin/sports/save.php?page=sport&sub=sports";
if (!empty($_GET["id"])) {
  $title = "แก้ไข".$_title;
  $sql->field = "*";
  $sql->condition = "WHERE player_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());

  $action = URL."admin/player/update.php?page=sport&sub=player";
}

/* SUBMIT */
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo $title; ?>ในทีม</h1>
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
							<label for="player_name">ชื่อสมาชิก</label>
							<input type="text" class="form-control" id="player_name" name="player_name" placeholder="ชื่อสมาชิก" value="<?= !empty($res["player_name"]) ? $res["player_name"] : "" ?>">
							<div class="invalid-feedback"></div>
						</div>
						<?php 
						if( !empty($res["player_id"]) ) echo '<input type="hidden" name="player_id" value="'.$res["player_id"].'">';
						?>
					</div>
					<div class="card-footer">
						<div class="clearfix">
							<a href="<?=URL?>admin/player/?page=<?=$_GET["page"]?>&id=<?= $res["team_id"]; ?>" class="btn btn-danger float-left">
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