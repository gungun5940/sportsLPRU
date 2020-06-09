<?php
$_title = "Tournament";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL . "admin/layouts/navbar.php");

//MENU
include($_pathURL . "admin/layouts/menu.php");
// SET TABLE //
$sql->table = "tournament";

$title = "เพิ่ม" . $_title;
$action = URL . "admin/tournament/save.php?page=sport&sub=tournament";
if (!empty($_GET["id"])) {
    $title = "แก้ไข" . $_title;
    $sql->field = "*";
    $sql->condition = "WHERE tournament_id={$_GET["id"]}";
    $res = mysqli_fetch_assoc($sql->select());

    $action = URL . "admin/tournament/update.php?page=sport&sub=tournament";
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
                            <label for="tournament_name">ชื่อ Tournament</label>
                            <input type="text" class="form-control" id="tournament_name" name="tournament_name" placeholder="ชื่อ Tournament" value="<?= !empty($res["tournament_name"]) ? $res["tournament_name"] : "" ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="sport">Sport</label>
                            <?php
                            $sql->table = "sport";
                            $sql->field = "*";
                            $sql->condition = "";
                            $query = $sql->select();
                            while ($row = mysqli_fetch_assoc($query)) {
                                $check = '';
                                if( !empty($res["tournament_id"]) ){
                                    $sql->table = "tournament_sport";
                                    $sql->condition = "WHERE tournament_id={$res["tournament_id"]} AND sport_id={$row["sport_id"]}";
                                    if( mysqli_num_rows($sql->select()) > 0 ){
                                        $check = 'checked';
                                    }
                                }
                            ?>
                                <div class="form-check">
                                    <input class="form-check-input" <?=$check?> type="checkbox" value="<?= $row["sport_id"] ?>" name="sport_id[]" id="checkbox_<?= $row["sport_id"] ?>">
                                    <label class="form-check-label" for="checkbox_<?= $row["sport_id"] ?>">
                                    <?= $row["sport_name"] ?>
                                    </label>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="startdate">วันที่เริ่ม</label>
                            <input type="date" class="form-control" id="startdate" name="startdate" placeholder="วันที่เริ่ม" value="<?= !empty($res["startdate"]) ? $res["startdate"] : "" ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="enddate">วันที่สิ้นสุด</label>
                            <input type="date" class="form-control" id="enddate" name="enddate" placeholder="วันที่เริ่ม" value="<?= !empty($res["enddate"]) ? $res["enddate"] : "" ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <?php
                        if (!empty($res["tournament_id"])) echo '<input type="hidden" name="tournament_id" value="' . $res["tournament_id"] . '">';
                        ?>
                    </div>
                    <div class="card-footer">
                        <div class="clearfix">
                            <a href="<?= URL ?>admin/tournament/?page=sport&sub=tournament" class="btn btn-danger float-left">
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