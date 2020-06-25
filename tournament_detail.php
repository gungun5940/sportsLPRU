<?php include("header.php"); ?>

<?php
if (empty($_GET["id"])) {
    header("location:" . URL . "event_calendar.php");
} else {
    $sql->table = "tournament";
    $sql->field = "*";
    $sql->condition = "WHERE tournament_id={$_GET["id"]}";
    $query = $sql->select();
    $result = mysqli_fetch_assoc($query);
    $sql->table = "tournament_sport";
    $sql->field = "*";
    $sql->condition = "WHERE tournament_id={$_GET["id"]}";
    $query2 = $sql->select();
    $result2 = mysqli_fetch_assoc($query2);
    $count = $sql->countRow($query2);
}
?>
<main id="main">
    <div class="container">
        <div class="card mt-2 mb-2">
            <div class="card-header bg-primary text-white">
                <h5><i class="fas fa-snowboarding"></i> ข้อมูลรายการแข่งขัน</h5>
            </div>
            <div class="card-body">
                <ul>
                    <li><span style="font-weight: bold;">ชื่อรายการ :</span> <?= $result["tournament_name"] ?></li>
                    <li><span style="font-weight: bold;">วันที่จัด :</span> <?= dateTH($result["startdate"]) ?> <b>ถึง</b> <?= dateTH($result["enddate"]) ?></li>
                    <li><span style="font-weight: bold;">ชนิดกีฬา :</span> <?= $count .' ชนิด'?></li>
                   ไ
                        </div>
                    </li>
                </ul>

            </div>
        </div>

    </div>
</main>
<?php include("footer.php"); ?>