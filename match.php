<?php
if (!empty($_GET["sport"]) && !empty($_GET["id"])) {
    $sql->table = "matchs m 
                            LEFT JOIN team t1 ON m.team_a = t1.team_id
                            LEFT JOIN team t2 ON m.team_b = t2.team_id";
    $sql->field = "m.*, t1.team_name AS team_a_name, t2.team_name AS team_b_name";
    $sql->condition = "WHERE m.tournament_id={$_GET["id"]} AND m.sport_id={$_GET["sport"]} ORDER BY match_date DESC";
    $query = $sql->select();

    $data = [];
    while ($result = mysqli_fetch_assoc($query)) {
        $date = date("Y-m-d", strtotime($result["match_date"]));
        $time = date("H:i", strtotime($result["match_date"]));
        $result["match_time"] = $time;

        $data[$date][] = $result;
    }

    $sql->table = "tournament";
    $sql->field = "*";
    $sql->condition = "WHERE tournament_id={$_GET["id"]}";
    $res = mysqli_fetch_assoc($sql->select());

    foreach ($data as $date => $value) {
?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td colspan="7" style="background-color: #87CEFA;">
                        <label style="margin: auto;"><?= DateTH($date) ?></label>
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($value as $round) {
                    $acolor = '';
                    $bcolor = '';
                    if ($round['score_a'] > $round['score_b']) {
                        $acolor = 'green';
                        $bcolor = 'red';
                    } else if ($round['score_b'] > $round['score_a']) {
                        $acolor = 'red';
                        $bcolor = 'green';
                    } else {
                        $acolor = 'gray';
                        $bcolor = 'gray';
                    }
                ?>
                    <tr>
                        <td width="20%"><?= $round['match_time'] ?></td>
                        <td width="30%" class="text_right" style="color:<?= $acolor ?>"><span class="">ทีม <?= $round['team_a_name'] ?></span></td>
                        <td width="20%" class="text_center"><a class="btn btn-sm btn-success text-white"> <?= $round['score_a'] ?> : <?= $round['score_b'] ?> </a></td>
                        <td width="30%" class="text_left" style="color:<?= $bcolor ?>"> ทีม <?= $round['team_b_name'] ?></span></a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
<?php
    }
}
else{
    ?>
    <h4 class="text-center text-red">ไม่พบข้อมูล</h4>
    <?php
}
?>