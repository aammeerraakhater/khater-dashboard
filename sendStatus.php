<?php
include 'init.php';

if (isset($_GET['id']) & isset($_GET['serviceStatus'])) {
    $id = $_GET['id'];
    $serviceStatus = $_GET['serviceStatus'];
    $updateCol = "serviceStatus";
    $reqDate = date("Y/m/d");

    updateSpecific('workreq', $id, $updateCol, $serviceStatus);
    updateSpecific('workreq', $id, "operatedDate", $reqDate);
}
if (isset($_GET['id']) & isset($_GET['Notes'])) {
    $id = $_GET['id'];
    $note = $_GET['Notes'];
    echo $id, $note;
    $updateCol = "Notes";
    updateSpecific('workreq', $id, $updateCol, $note);
}
if (isset($_GET['id']) & isset($_GET['technician'])) {
    $id = $_GET['id'];
    $technician = $_GET['technician'];
    echo $id, $note;
    $updateCol = "technician";
    updateSpecific('workreq', $id, $updateCol, $technician);
}
