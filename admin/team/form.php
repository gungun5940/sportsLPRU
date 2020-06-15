<?php
$_title = "ทีม";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL . "admin/layouts/navbar.php");

//MENU
include($_pathURL . "admin/layouts/menu.php");

if( empty($_GET["ts"]) ){
    header("location:" . URL . "admin/tournament/?page=sport&sub=tournament");
}

$sql->table = "tournament_sport";
$sql->condition = "WHERE ts_id={$_GET["ts"]}";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
    header("location:" . URL . "admin/tournament/?page=sport&sub=tournament");
}
$tsResult = mysqli_fetch_assoc($query);

$sql->table = "sport";
$sql->condition = "WHERE sport_id={$tsResult["sport_id"]}";
$sQuery = $sql->select();
$sResult = mysqli_fetch_assoc($sQuery);

//CLEAR DATA ON CLASS
$sql = new SQLiManager();

// SET TABLE //
$sql->table = "team";
$title = "เพิ่ม" . $_title;
$action = URL . "admin/team/save.php?page=team";
if (!empty($_GET["id"])) {
    $title = "แก้ไข" . $_title;
    $sql->field = "*";
    $sql->condition = "WHERE team_id={$_GET["id"]}";
    $res = mysqli_fetch_assoc($sql->select());

    $action = URL . "admin/team/update.php?page=sport&sub=team";
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
                                for($i = 1; $i <= $sResult["sport_player"]; $i++){
                                    //SQL get PLAYER
                                    if( !empty($_GET["id"]) ){
                                        $sql->table = "player";
                                        $sql->condition = "WHERE team_id={$_GET["id"]} AND seq={$i}";
                                        $playQuery = $sql->select();
                                        $player = mysqli_fetch_assoc($playQuery);
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label for="player">สมาชิกคนที่ <?=$i?></label>
                                        <input type="text" class="form-control" id="player_name<?=$i?>" name="player_name[<?=$i?>]" placeholder="ชื่อสมาชิกทีม" value="<?= !empty($player["player_name"]) ? $player["player_name"] : "" ?>">
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
                            <a href="<?= URL ?>admin/team/?page=team<?=$_GET["page"]?>&id=<?= $res["ts_id"]; ?>" class="btn btn-danger float-left">
                                <i class="fa fa-arrow-left"></i> กลับหน้าหลัก
                            </a>
                            <button type="submit" class="btn btn-primary btn-submit float-right">
                                <i class="fa fa-save"></i> บันทึกข้อมูล
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="ts_id" value="<?=$tsResult["ts_id"]?>">
                    <input type="hidden" name="tournament_id" value="<?=$tsResult["tournament_id"]?>">
                    <input type="hidden" name="sport_id" value="<?=$tsResult["sport_id"]?>">
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