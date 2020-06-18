<?php
include("../../config.php");
include("../../app/SQLiManager.php");

$sql = new SQLiManager();

if (!empty($_GET["id"])) {
    $sql->table = "file";
    $sql->field = "*";
    $query = $sql->select();
    while ($row = $query->fetch_object()) {
        $pdf = $row->ts_file;
        $path = "../filePDF/";
        $file = $path . $pdf;
    }
    if (!file_exists($file)) {
        die("NO FILE HERE");
    }
    
    // Add header to load pdf file
    header('Content-type: application/pdf');
    // header('Content-Disposition: attachment; filename="' . $file . '"'); //download file
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    @readfile($file) or die("File not found.");
}
?>