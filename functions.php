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
function getSum($table = 'workreq', $countElement = 'paid', $condition = 'operatedDate', $monthlyDate)
{
    global $con;
    $stmt = "SELECT SUM($countElement) FROM `$table` WHERE $condition  LIKE '$monthlyDate'";
    $results = $con->query($stmt);
    return $results;
}
function getCount($table = 'workreq', $countElement = 'id', $condition = 'reqDate',  $monthlyDate)
{
    global $con;
    $stmt = "SELECT COUNT($countElement) FROM $table WHERE $condition  LIKE '$monthlyDate';";
    $result = $con->query($stmt);
    return $result;
}
function getCountAll($table = 'customer', $countElement = 'customerID')
{
    global $con;
    $stmt = "SELECT COUNT($countElement) FROM $table ;";
    $result = $con->query($stmt);
    return $result;
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
function getDataBasedOn2Elements($table, $element1, $element1Value, $element2,  $element2Value)
{
    global $con;
    $stmt = "SELECT * FROM $table WHERE (($element1='$element1Value') AND ($element2='$element2Value')) ";
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
            header("Refresh:1;url=./index.php");
        } else {
            $_SESSION['msg'] = ' باسورد خاطئ';
        }
    } else {
        $_SESSION['msg'] = ' الادمن غير مسجل  ';
    }
}
