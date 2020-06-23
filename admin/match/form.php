<!DOCTYPE html>
<html lang="en">
<?php
$_pathURL = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "sportsLPRU" . DIRECTORY_SEPARATOR;
include($_pathURL . "config.php");
include($_pathURL . "app/SQLiManager.php");
include($_pathURL . "app/check_auth.php");
if (empty($auth)) {
    header("location:" . URL . "admin/login.php"); //NOT HAVE DATA IN DATABASE
}
$sql = new SQLiManager(); //SET FOR PAGES

//APP
include($_pathURL . "app/fn.php");
?>

<head>
    <meta charset="UTF-8">
    <title>Tournament Bracket</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- JQUERY UI -->
    <link rel="stylesheet" href="<?= PLUGINS ?>jquery-ui/jquery-ui.min.css">
    <!-- BOOTSTRAP 4.5 -->
    <link rel="stylesheet" href="<?= PLUGINS ?>bootstrap/css/bootstrap.css">
    <!-- SWEETALERT -->
    <link rel="stylesheet" href="<?= CSS ?>sweetalert2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= CSS ?>match.css">
</head>

<body>
    <?php
    // SET TABLE //
    if (!empty($_GET["ts"])) {
        $sql->table = "team";
        $sql->condition = "WHERE ts_id=".$_GET["ts"];
        $cTeam = $sql->countRow();
    }

    ?>

    <div class="container">
        
        <?php $round = ceil($cTeam) / 2; ?>
        <div class="tournament-bracket tournament-bracket--rounded">
            <div class="tournament-bracket__round tournament-bracket__round--quarterfinals">
                <h3 class="tournament-bracket__round-title"><?= $round == 1 ? "รอบชิงชนะเลิศ" : "รอบที่ ".$round ?></h3>
                <ul class="tournament-bracket__list">
                    <?php 
                    for($i=1; $i<=$round; $i++){
                    ?>
                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table class="tournament-bracket__table">
                                <caption class="tournament-bracket__caption">
                                    <time datetime="1998-02-18">18 February 1998</time>
                                </caption>
                                <tbody class="tournament-bracket__content">
                                    <tr class="tournament-bracket__team tournament-bracket__team--winner">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Canada">CAN</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-ca" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">4</span>
                                        </td>
                                    </tr>
                                    <tr class="tournament-bracket__team">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Kazakhstan">KAZ</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-kz" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">1</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                    <?php
                    }
                    ?>
                    

                    <!-- <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table class="tournament-bracket__table">
                                <caption class="tournament-bracket__caption">
                                    <time datetime="1998-02-18">18 February 1998</time>
                                </caption>
                                <thead class="sr-only">
                                    <tr>
                                        <th>Country</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody class="tournament-bracket__content">
                                    <tr class="tournament-bracket__team tournament-bracket__team--winner">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Czech Republic">CZE</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-cz" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">4</span>
                                        </td>
                                    </tr>
                                    <tr class="tournament-bracket__team">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Unitede states of America">USA</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-us" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">1</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table class="tournament-bracket__table">
                                <caption class="tournament-bracket__caption">
                                    <time datetime="1998-02-18">18 February 1998</time>
                                </caption>
                                <thead class="sr-only">
                                    <tr>
                                        <th>Country</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody class="tournament-bracket__content">
                                    <tr class="tournament-bracket__team tournament-bracket__team--winner">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Finland">FIN</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-fi" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">2</span>
                                        </td>
                                    </tr>
                                    <tr class="tournament-bracket__team">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Sweden">SVE</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-se" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">1</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>

                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table class="tournament-bracket__table">
                                <caption class="tournament-bracket__caption">
                                    <time datetime="1998-02-18">18 February 1998</time>
                                </caption>
                                <thead class="sr-only">
                                    <tr>
                                        <th>Country</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody class="tournament-bracket__content">
                                    <tr class="tournament-bracket__team tournament-bracket__team--winner">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Russia">RUS</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-ru" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">4</span>
                                        </td>
                                    </tr>
                                    <tr class="tournament-bracket__team">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Belarus">BEL</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-by" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">1</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tournament-bracket__round tournament-bracket__round--semifinals">
                <h3 class="tournament-bracket__round-title">Semifinals</h3>
                <ul class="tournament-bracket__list">
                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table class="tournament-bracket__table">
                                <caption class="tournament-bracket__caption">
                                    <time datetime="1998-02-20">20 February 1998</time>
                                </caption>
                                <thead class="sr-only">
                                    <tr>
                                        <th>Country</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody class="tournament-bracket__content">
                                    <tr class="tournament-bracket__team">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Canada">CAN</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-ca" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">1</span>
                                        </td>
                                    </tr>
                                    <tr class="tournament-bracket__team tournament-bracket__team--winner">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Czech Republic">CZE</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-cz" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">2</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>

                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table class="tournament-bracket__table">
                                <caption class="tournament-bracket__caption">
                                    <time datetime="1998-02-20">20 February 1998</time>
                                </caption>
                                <thead class="sr-only">
                                    <tr>
                                        <th>Country</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody class="tournament-bracket__content">
                                    <tr class="tournament-bracket__team">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Finland">FIN</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-fi" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">4</span>
                                        </td>
                                    </tr>
                                    <tr class="tournament-bracket__team tournament-bracket__team--winner">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Russia">RUS</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-ru" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">7</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tournament-bracket__round tournament-bracket__round--bronze">
                <h3 class="tournament-bracket__round-title">Bronze medal game</h3>
                <ul class="tournament-bracket__list">
                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table class="tournament-bracket__table">
                                <caption class="tournament-bracket__caption">
                                    <time datetime="1998-02-21">21 February 1998</time>
                                </caption>
                                <thead class="sr-only">
                                    <tr>
                                        <th>Country</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody class="tournament-bracket__content">
                                    <tr class="tournament-bracket__team tournament-bracket__team--winner">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Finland">FIN</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-fi" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">3</span>
                                            <span class="tournament-bracket__medal tournament-bracket__medal--bronze fa fa-trophy" aria-label="Bronze medal"></span>
                                        </td>
                                    </tr>
                                    <tr class="tournament-bracket__team">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Canada">CAN</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-ca" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">2</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tournament-bracket__round tournament-bracket__round--gold">
                <h3 class="tournament-bracket__round-title">Gold medal game</h3>
                <ul class="tournament-bracket__list">
                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table class="tournament-bracket__table">
                                <caption class="tournament-bracket__caption">
                                    <time datetime="1998-02-22">22 February 1998</time>
                                </caption>
                                <thead class="sr-only">
                                    <tr>
                                        <th>Country</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody class="tournament-bracket__content">
                                    <tr class="tournament-bracket__team tournament-bracket__team--winner">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Czech Republic">CZE</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-cz" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">1</span>
                                            <span class="tournament-bracket__medal tournament-bracket__medal--gold fa fa-trophy" aria-label="Gold medal"></span>
                                        </td>
                                    </tr>
                                    <tr class="tournament-bracket__team">
                                        <td class="tournament-bracket__country">
                                            <abbr class="tournament-bracket__code" title="Russia">RUS</abbr>
                                            <span class="tournament-bracket__flag flag-icon flag-icon-ru" aria-label="Flag"></span>
                                        </td>
                                        <td class="tournament-bracket__score">
                                            <span class="tournament-bracket__number">0</span>
                                            <span class="tournament-bracket__medal tournament-bracket__medal--silver fa fa-trophy" aria-label="Silver medal"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
            </div> -->
        </div>
    </div>

    <script src="<?= PLUGINS ?>jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= PLUGINS ?>jquery-ui/jquery-ui.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= PLUGINS ?>bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= JS ?>adminlte.min.js"></script>
    <!-- SWEETALERT -->
    <script src="<?= JS ?>sweetalert2.js"></script>
    <!-- MAIN -->
    <script src="<?= JS ?>main.js"></script>
</body>

</html>