<?php
function getAllData($table, $arrange)
{
    global $con;
    $stmt = "SELECT * FROM $table ORDER BY $arrange DESC";
    $rows = $con->query($stmt);
    return $rows;
}
function getDataBasedStatus($table, $serviceStatus)
{
    global $con;
    $stmt = "SELECT * FROM $table WHERE serviceStatus='$serviceStatus' ORDER BY id DESC";
    $rows = $con->query($stmt);
    return $rows;
}
function getDestinct($table, $column)
{
    global $con;
    $stmt = "SELECT DISTINCT $column FROM $table";
    $rows = $con->query($stmt);
    return $rows;
}

function getBased($table, $column, $columnEle, $arrange)
{
    global $con;
    $stmt = "SELECT * FROM $table WHERE $column='$columnEle' ORDER BY  $arrange DESC";
    $rows = $con->query($stmt);
    return $rows;
}
function getDataBasedOnCityServices($table, $city, $servicesType)
{
    global $con;
    $stmt = "SELECT * FROM $table WHERE city='$city' AND servicesType LIKE'%$servicesType%' ORDER BY id DESC";
    $rows = $con->query($stmt);
    return $rows;
}

function getDataBasedMoney($table)
{
    global $con;
    $stmt = "SELECT * FROM $table WHERE price > paid";
    $rows = $con->query($stmt);
    return $rows;
}

function updateSpecific($table, $id, $updatedCol, $updatedEle, $idColName = 'id')
{
    global $con;
    $stmt = "UPDATE $table SET $updatedCol='$updatedEle' WHERE $idColName='$id'";
    $rows = $con->query($stmt);
    return $rows;
}
function  checkUser($table, $email, $password)
{
    global $con;
    $stmt = "SELECT * FROM $table WHERE workerEmail = '$email'";
    $rows = $con->query($stmt);
    $row = $rows->fetch_assoc();
    if (isset($row['workerEmail']) && $row['workerEmail'] == $email) {

        if ($row['workerPass'] == $password) {
            $_SESSION['workerID'] = $row['workerID'];
            $_SESSION['workerEmail '] = $row['workerEmail'];
            $_SESSION['wName'] = $row['wName'];
            $_SESSION['isAdmin'] = $row['isAdmin'];
            $_SESSION['msg'] = ' اهلا ' . $_SESSION['wName'];
            header("Refresh:0;url=./index.php");
        } else {
            $_SESSION['msg'] = ' باسورد خاطئ';
        }
    } else {
        $_SESSION['msg'] = ' الادمن غير مسجل  ';
    }
}
