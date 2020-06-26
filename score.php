<?php
$sql->table = "team";
$sql->field = "*";
$sql->condition = "WHERE tournament_id={$_GET["id"]} AND sport_id={$_GET["sport"]} ORDER BY team_point DESC";
$query = $sql->select();
?>
<table class="table table-striped">
    <thead class="text-center">
        <tr>
            <th width="10%">ลำดับ</th>
            <th width="60%">ชื่อทีม</th>
            <th width="10%">คะแนนรวม</th>
            <th width="20%">สถานะ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while($result = mysqli_fetch_assoc($query)){
            ?>
            <tr>
                <td class="text-center"><?=$no?></td>
                <td><?=$result["team_name"]?></td>
                <td class="text-center"><?= !empty($result["team_point"]) ? $result["team_point"] : "-" ?></td>
                <td class="text-center">
                    <?php
                    $status = "-";
                    if( $result["team_status"] == 1 ){
                        $status = '<a class="btn btn-primary text-white btn-sm">กำลังแข่ง</a>';
                    }
                    if( $result["team_status"] == 2 ){
                        $status = '<a class="btn btn-danger text-white btn-sm">คัดออก</a>';
                    }
                    echo $status;
                    ?>
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table>