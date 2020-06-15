<?php 
$_title = "ผลการแข่งขัน";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");
// SET TABLE //
// $sql->table = "tournament_sport";

$title = "เพิ่ม".$_title;
// $action = URL."admin/result/save.php?page=sport&sub=result";
//   $title = "แก้ไข".$_title;
//   $sql->field = "*";
//   $sql->condition = "WHERE ts_id={$_GET["id"]}";
//   $res = mysqli_fetch_assoc($sql->select());

//   $action = URL."admin/result/update.php?page=sport&sub=result";

/* SUBMIT */
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo $title; ?></h1>
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
							<label for="ts_status">สถานะการแข่ง</label>
							<select class="form-control" id="ts_status" name="ts_status">
                                <option value="">- เลือกสถานะ -</option>
                                <?php
                                foreach(status() as $key => $value){
                                    echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
                                }
                                ?>
                            </select>
							<div class="invalid-feedback"></div>
						</div>
						<?php 
						if( !empty($res["ts_id"]) ) echo '<input type="hidden" name="ts_id" value="'.$res["ts_id"].'">';
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