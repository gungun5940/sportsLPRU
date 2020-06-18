<?php
$_title = "ผลการแข่งขัน";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL . "admin/layouts/navbar.php");

//MENU
include($_pathURL . "admin/layouts/menu.php");
// SET TABLE //
$sql->table = "tournament_sport ts LEFT JOIN tournament t ON ts.tournament_id=t.tournament_id LEFT JOIN sport sp ON ts.sport_id=sp.sport_id";

$title = "แก้ไข" . $_title;
$sql->field = "ts.*, t.tournament_name,sp.sport_name";
$sql->condition = "WHERE ts_id={$_GET["id"]}";
$res = mysqli_fetch_assoc($sql->select());

$action = URL . "admin/result/update.php?page=sport&sub=result";

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
				<form class="form-submit" action="<?= $action ?>" method="POST">
					<div class="card-body">
						<div class="form-group">
							<label for="ts_startdate">วันที่เริ่ม</label>
							<input type="text" readonly class="form-control" id="ts_startdate" name="ts_startdate" value="<?= !empty($res["ts_startdate"]) ? $res["ts_startdate"] : "" ?>">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="ts_enddate">วันที่สิ้นสุด</label>
							<input type="text" readonly class="form-control" id="ts_enddate" name="ts_enddate" value="<?= !empty($res["ts_enddate"]) ? $res["ts_enddate"] : "" ?>">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="tournament_name">ชื่อ Tournament</label>
							<input type="text" readonly class="form-control" id="tournament_name" name="tournament_name" placeholder="ชื่อ Tournament" value="<?= !empty($res["tournament_name"]) ? $res["tournament_name"] : "" ?>">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="sport_name">ชนิดกีฬา</label>
							<input type="text" readonly class="form-control" id="sport_name" name="sport_name" placeholder="ชนิดกีฬา" value="<?= !empty($res["sport_name"]) ? $res["sport_name"] : "" ?>">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="ts_status">สถานะการแข่ง</label>
							<select class="form-control" id="ts_status" name="ts_status">
								<option value="">- เลือกสถานะ -</option>
								<?php
								foreach (status() as $key => $value) {
									$sel = "";
									if (!empty($res["ts_status"])) {
										if ($res["ts_status"] == $value["id"])
											$sel = 'selected';
									}
								?>
									<option <?= $sel ?> value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
									<!-- echo '<option value="' . $value["id"] . '">' . $value["name"] . '</option>'; -->
									<?php
								}
								?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="ts_file">ผลการแข่งขัน</label><br><b>Upload File : </b>
							<input type="file" id="ts_file" name="ts_file" placeholder="ไฟล์ผลการแข่งขัน" value="<?= !empty($res["ts_file"]) ? $res["ts_file"] : "" ?>">
							<div class="invalid-feedback"></div>
						</div>
						<?php
						if (!empty($res["ts_id"])) echo '<input type="hidden" name="ts_id" value="' . $res["ts_id"] . '">';
						?>
					</div>
					<div class="card-footer">
						<div class="clearfix">
							<a href="<?= URL ?>admin/result/?page=<?= $_GET["page"] ?>&id=<?= $res["ts_id"]; ?>" class="btn btn-danger float-left">
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
include($_pathURL . "admin/layouts/footer.php");
?>