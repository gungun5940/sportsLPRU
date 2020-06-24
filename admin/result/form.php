<?php
$_title = "จัดการสถานะการแข่ง";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL . "admin/layouts/navbar.php");

//MENU
include($_pathURL . "admin/layouts/menu.php");

// $sql->table = "match";
// $sql->field = "*";
// $query = $sql->select();
?>
<!-- Content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">จัดการสถานะการแข่ง</h1>
                </div>
                <div class="col-sm-6">
                    <!-- <a data-plugins="modal" href="<?= URL ?>admin/match/formModal.php?page=match&sub=<?= $_GET["sub"] ?>&ts=<?= $_GET["id"] ?>" class="btn btn-primary text-white float-right">สร้าง MATCH</a> -->
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="card ">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-2 text-dark">ชื่อ Tournament</h4>
                </div>
            </div>
            <div class="container-fluid">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td colspan="7" style="background-color: #87CEFA;">
                                <label style="margin: auto;">วันที่</label>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>00:30</td>
                            <td class="text_right"><span class="">ทีมที่่ 1</span></td>
                            <td class="text_center"><a class="btn btn-sm btn-success">0 : 0</a></td>
							<td class="text_left"> ทีมที่่ 2</span></a></td>
							<td class="text-center"> สถานะ
							<?php
                                    // $status = getStatus($res["ts_status"]);
                                    // echo '<a class="' . $status["class"] . '"><i class="' . $status['icon'] . '"></i> ' . $status["name"] . '</a>';
                                    ?>
                                </td>
                            <td class="text-right">
                                <a data-plugins="modal" href="<?= URL ?>admin/result/formModal.php?page=<?= $_GET["page"] ?>&sub=<?= $_GET["sub"] ?>&id=" class="btn btn-warning"><i class="fa fa-pen"></i>แก้ไข</a>
                                <?php
                                // $ops = [
                                //     "title" => "ยืนยันการลบข้อมูล",
                                //     "text" => "คุณต้องการลบข้อมูลคู่" . $res["tournament_name"] ."กับ". $res["tournament_name"] . "หรือไม่ ?",
                                //     "btnconfirm" => "btn btn-danger m-1",
                                //     "textconfirm" => "ลบข้อมูล"
                                // ];
                                ?>
                                <a href="<?= URL ?>admin/result/delete.php?page=<?= $_GET["page"] ?>&sub=<?= $_GET["sub"] ?>&id=<?= $res["ts_id"] ?>" class="btn btn-danger btn-confirm" data-options="<?= stringify($ops) ?>">
                                    <i class="fa fa-trash"></i> ลบ
                                </a>
                            </td>
                        </tr>
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