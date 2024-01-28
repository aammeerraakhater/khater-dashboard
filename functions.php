<?php
function getAllData($table)
{
    global $con;
    $stmt = "SELECT * FROM $table";
    $rows = $con->query($stmt);
    return $rows;
}
function getDataBasedOnCityServices($table, $city, $servicesType)
{
    global $con;
    $stmt = "SELECT * FROM $table WHERE city='$city' AND servicesType='$servicesType'";
    $rows = $con->query($stmt);
    return $rows;
}
function getDataBasedStatus($table, $serviceStatus)
{
    global $con;
    $stmt = "SELECT * FROM $table WHERE serviceStatus='$serviceStatus'";
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

function updateSpecific($table, $id, $updatedCol, $updatedEle)
{
    global $con;
    $stmt = "UPDATE $table SET $updatedCol='$updatedEle' WHERE id='$id'";
    $rows = $con->query($stmt);
    return $rows;
}
function getDataBasedID($table, $customerID)
{
    global $con;
    $stmt = "SELECT * FROM $table WHERE customerID='$customerID'";
    $rows = $con->query($stmt);
    return $rows;
}
