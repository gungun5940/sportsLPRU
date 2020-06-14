<?php
$_title = "ทีม";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL . "admin/layouts/navbar.php");

//MENU
include($_pathURL . "admin/layouts/menu.php");
// SET TABLE //
$sql->table = "team";

$title = "เพิ่ม" . $_title;
$action = URL . "admin/team/save.php?page=team";
if (!empty($_GET["id"])) {
    $title = "แก้ไข" . $_title;
    $sql->field = "*";
    $sql->condition = "WHERE team_id={$_GET["id"]}";
    $res = mysqli_fetch_assoc($sql->select());

    $action = URL . "admin/team/update.php?page=team";
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
                            <label for="team_name">ทีม</label>
                            <input type="text" class="form-control" id="team_name" name="team_name" placeholder="ชื่อทีม" value="<?= !empty($res["team_name"]) ? $res["team_name"] : "" ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <?php
                            $sql->table = "sport";
                            $sql->field = "*";
                            $sql->condition = "";
                            $query = $sql->select();
                            while ($row = mysqli_fetch_assoc($query)) {
                                if( !empty($res["sport_id"]) ){
                                    $sql->table = "sport";
                                    $sql->condition = "WHERE sport_id={$row["sport_id"]}";
                                }
                                
                                // for($i = 0; $i < count($_POST["sport_player"]); $i++){
                                //     $sql->table = "sport";
                                //     $sql->field = "sport_player";
                                //     $sql->condition = "";
                                // }
                            ?>
                                <div class="form-group">
                                    <label for="player">สมาชิกทีม</label>
                                    <input type="text" class="form-control" id="player_name" name="player_name" placeholder="ชื่อสมาชิกทีม" value="<?= !empty($row["player_name"]) ? $row["player_name"] : "" ?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>

                        <?php
                        if (!empty($res["team_id"])) echo '<input type="hidden" name="team_id" value="' . $res["team_id"] . '">';
                        ?>
                    </div>
                    <div class="card-footer">
                        <div class="clearfix">
                            <a href="<?= URL ?>admin/team/?page=team" class="btn btn-danger float-left">
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