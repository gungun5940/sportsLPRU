<?php
$_title = "จัดการทีม";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL . "admin/layouts/navbar.php");

//MENU
include($_pathURL . "admin/layouts/menu.php");

if( !empty($_GET["id"]) ){
  $sql->table = "team";
  $sql->field = "*";
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
          <h1 class="m-0 text-dark">จัดการทีม</h1>
        </div>
        <div class="col-sm-6">
          <a href="<?= URL ?>admin/team/form.php?page=team&sub=<?=$_GET["sub"]?>&ts=<?=$_GET["id"]?>" class="btn btn-primary text-white float-right">เพิ่มทีม</a>
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
              <th width="10%">ลำดับ</th>
              <th width="40%">ชื่อทีม</th>
              <th width="50%">จัดการ</th>
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
                <td><?php echo $res["team_name"]; ?></td>
                <td class="text-center">
                  <a href="<?= URL ?>admin/player/index.php?page=<?= $_GET["page"] ?>&sub=<?=$_GET["sub"]?>&id=<?= $res["team_id"]; ?>" class="btn btn-success"><i class="fa fa-users mr-1"></i>สมาชิก</a>
                  <a href="<?= URL ?>admin/team/form.php?page=<?= $_GET["page"] ?>&sub=<?=$_GET["sub"]?>&ts=<?=$_GET["id"]?>" class="btn btn-warning"><i class="fa fa-pen mr-1"></i>แก้ไข</a>
                  <?php
                  $ops = [
                    "title" => "ยืนยันการลบข้อมูล",
                    "text" => "คุณต้องการลบข้อมูล " . $res["team_name"] . "หรือไม่ ?",
                    "btnconfirm" => "btn btn-danger m-1",
                    "textconfirm" => "ลบข้อมูล"
                  ];
                  ?>
                  <a href="<?= URL ?>admin/team/delete.php?page=<?= $_GET["page"] ?>&sub=<?=$_GET["sub"]?>&id=<?= $res["team_id"] ?>" class="btn btn-danger btn-confirm" data-options="<?= stringify($ops) ?>">
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