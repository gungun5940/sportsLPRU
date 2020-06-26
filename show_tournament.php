<?php 
$_title = "จัดการทีม";
// HEADER
include("header.php");

//NAVBAR
// include($_pathURL."admin/layouts/navbar.php");

//MENU
// include($_pathURL."admin/layouts/menu.php");

$sql->table = "tournament";
$sql->field = "*";
$query = $sql->select();
?>
<!-- Content -->

<main id="main">
    <div class="container">
        <div class="m-2">
            <h4>ข้อมูลการแข่งขัน</h4>
        </div>

        <div class="clearfix">
            <div class="card p-2 mb-2">
                <table class="table table-bordered DataTable">
                    <thead>
                        <tr class="text-center table-info">
                            <th width="5%">ลำดับ</th>
                            <th width="25%">ระยะเวลาแข่งขัน</th>
                            <th width="50%">ชื่อรายการ</th>
                            <th width="20%">การแข่งขัน / คะแนน</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $num = 0;
                        $ac_status = "";
                        while ($res = mysqli_fetch_assoc($query)) {
                            $num++;
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $num; ?></td>
                                <td>        
                                    <?=dateTH($res["startdate"])?>
                                    <?php
                                    if( $res["startdate"] != $res["enddate"] ){
                                        echo " - ".dateTH($res["enddate"]);
                                    }
                                    ?></td>
                                    
                                <td><a href="<?=URL?>tournament_detail.php?id=<?=$res["tournament_id"]?>"><?php echo $res["tournament_name"]; ?></a></td>
                                <td class="text-center">
                                    <a href="<?=URL?>tournament_detail.php?id=<?=$res["tournament_id"]?>" class="btn btn-primary btn-sm">การแข่งขัน</a>
                                    <a href="<?=URL?>tournament_result.php?id=<?=$res["tournament_id"]?>" class="btn btn-success btn-sm">คะแนน</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- End Content -->
<?php
//FOOTER
include($_pathURL."footer.php");
?>