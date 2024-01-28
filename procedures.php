<?php
include "init.php";
if (isset($_POST["submitCustomer"]) || isset($_POST["submitCustomerWithWorkReq"])) {
    $usrName = $_POST['name']; #
    $phone = $_POST['phone']; #
    $delegate = $_POST['delegate']; #
    $city = $_POST['city']; #
    $address = $_POST['address']; #
    if (isset($_POST['customerType'])) {
        $customerType = $_POST['customerType'] . " ";
    } else {
        $customerType = "";
    }
    if (isset($_POST['customerType1'])) {
        $customerType1 = $_POST['customerType1'] . " ";
    } else {
        $customerType1 = "";
    }
    if (isset($_POST['customerType2'])) {
        $customerType2 = $_POST['customerType2'];
    } else {
        $customerType2 = "";
    }
    $servicesType = $customerType . $customerType1 . $customerType2;

    $table = "customer";
    global $con;
    $stmt = "INSERT INTO $table(usrName,phone,delegate,city,address,servicesType) VALUES('$usrName','$phone','$delegate','$city','$address','$servicesType')";
    $rows = $con->query($stmt);
    if (isset($_POST["submitCustomerWithWorkReq"])) {
        $customerID = $con->insert_id;
        header("Refresh:0;url=addWorkReq.php?customerID=$customerID");
    } else {
        header("Refresh:0;url=index.php");
    }
} {
    if (isset($_POST["submitWorkReq"]) || isset($_POST['customerID'])) {
        $customerID = $_POST['customerID']; #
        $workReqNo = $_POST['workId']; #
        $technician = $_POST['technician']; #
        $city = $_POST['city']; #
        $address = $_POST['address']; #
        $servicesType = $_POST['servicesType'];
        $Quantity = $_POST['quantity']; #
        $price = $_POST['price']; #
        $paid = $_POST['paid']; #
        $Notes = $_POST['notes'];
        $reqDate = date("Y/m/d");

        $table = "workreq";
        global $con;
        $stmt = "INSERT INTO $table(customerID,workReqNo,technician,city,address,servicesType, Quantity, price, paid , Notes, reqDate) VALUES('$customerID','$workReqNo','$technician','$city','$address','$servicesType','$Quantity','$price','$paid','$Notes', '$reqDate')";
        $rows = $con->query($stmt);
        header("Refresh:0;url=index.php");
    }
}
