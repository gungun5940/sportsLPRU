<?php 
$_pathURL = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."sportsLPRU".DIRECTORY_SEPARATOR;
include($_pathURL."config.php");
include($_pathURL."app/SQLiManager.php");
include($_pathURL."app/check_auth.php");
if( empty($auth) ) {
  header("location:".URL."admin/login.php"); //NOT HAVE DATA IN DATABASE
}
$sql = new SQLiManager(); //SET FOR PAGES

//APP
include($_pathURL."app/fn.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=!empty($_title) ? $_title : 'Office System';?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- JQUERY UI -->
  <link rel="stylesheet" href="<?=PLUGINS?>jquery-ui/jquery-ui.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=PLUGINS?>fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- BOOTSTRAP 4.5 -->
  <link rel="stylesheet" href="<?=PLUGINS?>bootstrap/css/bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=CSS?>/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=PLUGINS?>overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=PLUGINS?>datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- SWEETALERT -->
  <link rel="stylesheet" href="<?=CSS?>sweetalert2.css">
  <style type="text/css" media="screen">
    .ui-datepicker select.ui-datepicker-month{
      width: 60%;
      margin-top : 1px;
      height: 30px;
      margin : 1px;
    }
    .ui-datepicker select.ui-datepicker-year {
      width: 38%;
      height: 28px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">