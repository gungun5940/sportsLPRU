
<?php 
$_pathURL = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."sportsLPRU".DIRECTORY_SEPARATOR;
include($_pathURL."config.php");
include($_pathURL."app/SQLiManager.php");
// include($_pathURL."app/check_auth.php");
// if( empty($auth) ) {
//   header("location:".URL."admin/login.php"); //NOT HAVE DATA IN DATABASE
// }
$sql = new SQLiManager(); //SET FOR PAGES

//APP
include($_pathURL."app/fn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>กีฬามหาวิทยาลัยราชภัฏลำปาง</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/logo.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- DataTable -->
    <link rel="stylesheet" href="<?= PLUGINS ?>datatables-bs4/css/dataTables.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- =======================================================
  * Template Name: EstateAgency - v2.0.0
  * Template URL: https://bootstrapmade.com/real-estate-agency-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<!-- ======= Header/Navbar ======= -->
<nav class="navbar navbar-default navbar-trans navbar-expand-lg ">
    <div class="container">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a class="navbar-brand text-brand" href="index.php"><img src="assets/img/logo.png" width="40px" height="45px"><span class="color-b">LPRU</span></a>
        <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-expanded="false">
            <span class="fa fa-search" aria-hidden="true"></span>
        </button>
        <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="index.php">หน้าแรก</a>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ชนิดกีฬา
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">รายงาน</a>
                        <a class="dropdown-item" href="#">รายงาน</a>
                        <a class="dropdown-item" href="#">รายงาน</a>
                        <a class="dropdown-item" href="#">รายงาน</a>
                    </div>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link " href="show_tournament.php" >   ข้อมูลการแข่งขัน
                    </a>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ผลการแข่งขัน
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">รายงาน</a>
                        <a class="dropdown-item" href="#">รายงาน</a>
                        <a class="dropdown-item" href="#">รายงาน</a>
                        <a class="dropdown-item" href="#">รายงาน</a>
                    </div>
                </li> -->
            </ul>
        </div>
        <a href="admin/login.php"><span class="price-a">Login</span></a>
        </button>
    </div>
</nav><!-- End Header/Navbar -->

</body>