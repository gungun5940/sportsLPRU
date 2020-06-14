<?php
$_title = "กีฬาใน Tournament";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL . "admin/layouts/navbar.php");

//MENU
include($_pathURL . "admin/layouts/menu.php");
// SET TABLE //
$sql->table = "tournament_sport ts LEFT JOIN sport sp ON ts.sport_id=sp.sport_id";

// $title = "เพิ่ม" . $_title;
// $action = URL . "admin/tournament/save.php?page=sport&sub=tournament";
if (!empty($_GET["id"])) {
    $title = "แก้ไข" . $_title;
    $sql->field = "ts.*, sp.sport_name";
    $sql->condition="WHERE ts_id={$_GET["id"]}";
    $res = mysqli_fetch_assoc($sql->select());

    $action = URL . "admin/tournamentSport/update.php?page=sport&sub=tournamentSport";
}

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
                            <input type="date" class="form-control" id="ts_startdate" name="ts_startdate" value="<?= !empty($res["ts_startdate"]) ? $res["ts_startdate"] : "" ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="ts_enddate">วันที่สิ้นสุด</label>
                            <input type="date" class="form-control" id="ts_enddate" name="ts_enddate" value="<?= !empty($res["ts_enddate"]) ? $res["ts_enddate"] : "" ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="sport">ชื่อกีฬา</label>
                                <div class="form-group">
                                    <input type="text" readonly class="form-control" id="sport_name" name="sport_name" value="<?= !empty($res["sport_name"]) ? $res["sport_name"] : "" ?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="ts_place">สถานที่แข่ง</label>
                            <input type="text" class="form-control" id="ts_place" name="ts_place" placeholder="ชื่อสถานที่แข่ง" value="<?= !empty($res["ts_place"]) ? $res["ts_place"] : "" ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <?php
                        if (!empty($res["ts_id"])) echo '<input type="hidden" name="ts_id" value="' . $res["ts_id"] . '">';
                        ?>
                    </div>
                    <div class="card-footer">
                        <div class="clearfix">
                            <a href="<?= URL ?>admin/tournamentSport/?page=<?=$_GET["page"]?>&id=<?= $res["tournament_id"]; ?>" class="btn btn-danger float-left">
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