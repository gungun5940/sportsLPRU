<?php include("header.php"); ?>

<?php
if (empty($_GET["id"])) {
    header("location:" . URL . "index.php");
} else {
    $sql->table = "tournament";
    $sql->field = "*";
    $sql->condition = "WHERE tournament_id={$_GET["id"]}";
    $query = $sql->select();
    $result = mysqli_fetch_assoc($query);

    $sql->table = "tournament_sport ts LEFT JOIN sport s ON ts.sport_id=s.sport_id";
    $sql->field = "ts.*, s.sport_name";
    $sql->condition = "WHERE tournament_id={$_GET["id"]}";
    $query2 = $sql->select();

    if( !empty($_GET["sport"]) ){
        $sql->table = "sport";
        $sql->field = "*";
        $sql->condition = "WHERE sport_id={$_GET["sport"]}";
        $sQuery = $sql->select();
        $resSport = mysqli_fetch_assoc($sQuery);
    }
}
?>
<main id="main">
    <div class="container">
        <div class="card mt-2 mb-2">
            <div class="card-header bg-success">
                <h5 class="text-white"><i class="fas fa-snowboarding"></i> ข้อมูลรายการแข่งขัน</h5>
            </div>
            <div class="card-body">
                <ul>
                    <li><span style="font-weight: bold;">ชื่อรายการ :</span> <?= $result["tournament_name"] ?></li>
                    <li><span style="font-weight: bold;">วันที่จัด :</span> <?= dateTH($result["startdate"]) ?> <b>ถึง</b> <?= dateTH($result["enddate"]) ?></li>
                    <li><span style="font-weight: bold;">ชนิดกีฬา : </span> <?= !empty($resSport['sport_name']) ? $resSport['sport_name'] : "" ?></li>
                   
                        
                    </li>
                </ul>
                <div class="text-center">
                <?php
                    while($sport = mysqli_fetch_assoc($query2)){
                        ?>
                        <a href="<?=URL?>tournament_result.php?id=<?=$_GET["id"]?>&sport=<?=$sport["sport_id"]?>" class="btn btn-success"><?=$sport['sport_name']?></a>
                        <?php
                    }
                    ?>
                    </div>
            </div>
            </div>

            <?php
            if( !empty($_GET["sport"]) ) {
            ?>
            <div class="card mt-2 mb-2">
            <div class="card-header bg-success">
                <h5 class="text-white"><i class="fas fa-snowboarding"></i>คะแนนการแข่งขัน</h5>
            </div>
            <div class="card-body">
            <?php include("score.php"); ?>
            </div>
            </div>
            <?php } ?>
        </div>
</main>
<?php include("footer.php"); ?>