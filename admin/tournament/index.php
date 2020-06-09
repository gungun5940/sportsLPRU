<?php
$_title = "จัดการทีม";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL . "admin/layouts/navbar.php");

//MENU
include($_pathURL . "admin/layouts/menu.php");

$sql->table = "tournament";
$sql->field = "*";
$query = $sql->select();
?>
<!-- Content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">จัดการการแข่งขัน</h1>
                </div>
                <div class="col-sm-6">
                    <a href="<?= URL ?>admin/tournament/form.php?page=sport&sub=tournament" class="btn btn-primary text-white float-right">เพิ่ม tournament</a>
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
                            <th width="30%">รายการ tournament</th>
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
                                <td><?php echo $res["startdate"]; ?></td>
                                <td><?php echo $res["enddate"]; ?></td>
                                <td><?php echo $res["tournament_name"]; ?></td>
                                <td class="text-center">
                                    <a href="<?= URL ?>admin/tournamentSport/index.php?page=sport&sub=tournamentSport<?= $_GET["page"] ?>&sub=<?= $_GET["sub"] ?>&id=<?= $res["tournament_id"]; ?>" class="btn btn-success"><i class="fas fa-running mr-1"></i></i>จัดการกีฬา/ทีม</a>
                                    <a href="<?= URL ?>admin/tournament/form.php?page=sport&sub=tournament<?= $_GET["page"] ?>&sub=<?= $_GET["sub"] ?>&id=<?= $res["tournament_id"]; ?>" class="btn btn-warning"><i class="fa fa-pen mr-1"></i></i>แก้ไข</a>
                                    <?php
                                    $ops = [
                                        "title" => "ยืนยันการลบข้อมูล",
                                        "text" => "คุณต้องการลบข้อมูล " . $res["tournament_name"] . "หรือไม่ ?",
                                        "btnconfirm" => "btn btn-danger m-1",
                                        "textconfirm" => "ลบข้อมูล"
                                    ];
                                    ?>
                                    <a href="<?= URL ?>admin/tournament/delete.php?page=<?= $_GET["page"] ?>&sub=<?= $_GET["sub"] ?>&id=<?= $res["tournament_id"] ?>" class="btn btn-danger btn-confirm" data-options="<?= stringify($ops) ?>">
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