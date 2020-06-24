<?php
$_title = "จัดการ MATCH";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL . "admin/layouts/navbar.php");

//MENU
include($_pathURL . "admin/layouts/menu.php");
if(!empty($_GET["id"])){
    $sql->table = "matchs m 
                            LEFT JOIN team t1 ON m.team_a = t1.team_id
                            LEFT JOIN team t2 ON m.team_b = t2.team_id";
    $sql->field = "m.*, t1.team_name AS team_a_name, t2.team_name AS team_b_name";
    $sql->condition = "WHERE m.ts_id={$_GET["id"]} ORDER BY match_date DESC";
    $query = $sql->select();

    $data = [];
    while($result = mysqli_fetch_assoc($query)){
        $date = date("Y-m-d", strtotime($result["match_date"]));
        $time = date("H:m", strtotime($result["match_date"]));
        $result["match_time"] = $time;

        $data[$date][] = $result;
    }

    $sql->table = "matchs m LEFT JOIN tournament t ON m.tournament_id = t.tournament_id";
    $sql->field = "m.*, t.tournament_name";
    $sql->condition = "WHERE ts_id={$_GET["id"]}";
    $res = mysqli_fetch_assoc($sql->select());
}
?>
<!-- Content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">จัดการ MATCH</h1>
                </div>
                <div class="col-sm-6">
                    <a data-plugins="modal" href="<?= URL ?>admin/match/formModal.php?page=match&sub=<?= $_GET["sub"] ?>&ts=<?= $_GET["id"] ?>" class="btn btn-primary text-white float-right">สร้าง MATCH</a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="card ">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-2 text-dark"><?=$res['tournament_name']?></h4>
                </div>
            </div>
            <div class="container-fluid">
                <?php
                foreach($data AS $date => $value){
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td colspan="7" style="background-color: #87CEFA;">
                                <label style="margin: auto;"><?=DateTH($date)?></label>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($value AS $round){
                        ?>
                        <tr>
                            <td width = "20%"><?=$round['match_time']?></td>
                            <td width = "20%" class="text_right"><span class="">ทีม <?=$round['team_a_name']?></span></td>
                            <td width = "10%" class="text_center"><a class="btn btn-sm btn-success text-white"> <?=$round['score_a']?> : <?= $round['score_b']?> </a></td>
                            <td width = "20%" class="text_left"> ทีม <?=$round['team_b_name']?></span></a></td>
                            <td width = "30%" class="text-right">
                                <a data-plugins="modal" href="<?= URL ?>admin/match/formModal.php?page=<?= $_GET["page"] ?>&sub=<?= $_GET["sub"] ?>&id=<?= $round["match_id"]; ?>" class="btn btn-warning"><i class="fa fa-pen"></i>แก้ไข</a>
                                <a data-plugins="modal" href="<?= URL ?>admin/match/formScoreModal.php?page=<?= $_GET["page"] ?>&sub=<?= $_GET["sub"] ?>&id=<?= $round["match_id"]; ?>" class="btn btn-primary"><i class="fas fa-edit"></i>คะแนน</a>
                                <?php
                                $ops = [
                                    "title" => "ยืนยันการลบข้อมูล",
                                    "text" => "คุณต้องการลบข้อมูลคู่" . $round['team_a_name'] ."กับ". $round['team_b_name'] . "หรือไม่ ?",
                                    "btnconfirm" => "btn btn-danger m-1",
                                    "textconfirm" => "ลบข้อมูล"
                                ];
                                ?>
                                <a href="<?= URL ?>admin/match/delete.php?page=<?= $_GET["page"] ?>&sub=<?= $_GET["sub"] ?>&id=<?= $res["ts_id"] ?>" class="btn btn-danger btn-confirm" data-options="<?= stringify($ops) ?>">
                                    <i class="fa fa-trash"></i> ลบ
                                </a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                }
                ?>

            </div>
        </div>

    </section>
</div>
<!-- End Content -->
<?php
//FOOTER
include($_pathURL . "admin/layouts/footer.php");
?>