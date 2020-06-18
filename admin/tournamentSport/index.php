<?php
$_title = "จัดการกีฬา/ทีม";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL . "admin/layouts/navbar.php");

//MENU
include($_pathURL . "admin/layouts/menu.php");

if( !empty($_GET["id"]) ){
    $sql->table = "tournament_sport ts LEFT JOIN sport sp ON ts.sport_id=sp.sport_id";
    $sql->field = "ts.*, sp.sport_name";
    $sql->condition="WHERE tournament_id={$_GET["id"]}";
    $query = $sql->select();
} else {
    header("location:" . URL . "admin/tournamentSport/index.php?page=sport&sub=tournamentSport");
}
?>
<!-- Content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">จัดการกีฬา/ทีม</h1>
                </div>
                <div class="col-sm-6">
                    <!-- <a href="<?= URL ?>admin/tournamentSport/form.php?page=sport&sub=tournamentSport" class="btn btn-primary text-white float-right">เพิ่มทีม</a> -->
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="card p-3">
            <div class="container-fluid">
                <table class="table table-bordered DataTable">
                    <thead>
                        <tr class="text-center table-info">
                            <th width="5%">ลำดับ</th>
                            <th width="15%">วันที่เริ่ม</th>
                            <th width="15%">วันที่สิ้นสุด</th>
                            <th width="15%">ชนิดกีฬา</th>
                            <th width="15%">สถานที่แข่ง</th>
                            <th width="35%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $num = 0;
                        while ($res = mysqli_fetch_assoc($query)) {
                            $num++;
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $num; ?></td>
                                <td><?php echo dateTH($res["ts_startdate"]); ?></td>
                                <td><?php echo dateTH($res["ts_enddate"]); ?></td>
                                <td><?php echo $res["sport_name"]; ?></td>
                                <td><?php echo $res["ts_place"]; ?></td>
                                <td class="text-center">
                                    <a href="<?= URL ?>admin/team/index.php?page=<?= $_GET["page"] ?>&sub=<?=$_GET["sub"]?>&id=<?= $res["ts_id"]; ?>" class="btn btn-success"><i class="fa fa-users mr-1"></i>จัดการทีม</a>
                                    <a href="<?= URL ?>admin/tournamentSport/form.php?page=<?= $_GET["page"] ?>&sub=<?=$_GET["sub"]?>&id=<?= $res["ts_id"]; ?>" class="btn btn-warning"><i class="fa fa-pen mr-1"></i>แก้ไข</a>
                                    <a href="<?= URL ?>admin/match/index.php?page=<?= $_GET["page"] ?>&sub=<?=$_GET["sub"]?>&id=<?= $res["ts_id"]; ?>" class="btn btn-info"><i class="far fa-edit mr-1"></i>MATCH</a>
                                    <?php
                                    $ops = [
                                        "title" => "ยืนยันการลบข้อมูล",
                                        "text" => "คุณต้องการลบข้อมูล " . $res["sport_name"] . "หรือไม่ ?",
                                        "btnconfirm" => "btn btn-danger m-1",
                                        "textconfirm" => "ลบข้อมูล"
                                    ];
                                    ?>
                                    <a href="<?= URL ?>admin/tournamentSport/delete.php?page=<?= $_GET["page"] ?>&id=<?= $res["ts_id"] ?>" class="btn btn-danger btn-confirm" data-options="<?= stringify($ops) ?>">
                                        <i class="fa fa-trash"></i> ลบ
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- End Content -->
<?php
//FOOTER
include($_pathURL . "admin/layouts/footer.php");
?>