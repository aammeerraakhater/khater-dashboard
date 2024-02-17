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
    if (isset($_POST["submitWorkReq"])) {
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
if (isset($_POST["editCustomer"])) {
    $customerID = $_POST['customerID'];
    $usrName = $_POST['name']; #
    $phone = $_POST['phone']; #
    $delegate = $_POST['delegate']; #
    $city = $_POST['city']; #
    $address = $_POST['address']; #

    $table = "customer";
    global $con;
    $stmt = "UPDATE $table SET usrName = '$usrName' ,phone = '$phone',delegate = '$delegate',city = '$city',address = '$address' WHERE customerID =$customerID";
    $rows = $con->query($stmt);
    header("Refresh:0;url=showUsr.php?customerID=$customerID");
}
if (isset($_POST["editWorkReq"])) {
    $customerID = $_POST['customerID']; #
    $id = $_POST['id']; #
    $workReqNo = $_POST['workId']; #workId
    $city = $_POST['city']; #
    $address = $_POST['address']; #
    $servicesType = $_POST['serviceTypes'];
    $Quantity = $_POST['quantity']; #
    $price = $_POST['price']; #
    $paid = $_POST['paid']; #
    $Notes = $_POST['notes'];
    $happyCall = $_POST['happyCall'];
    $editedBy = $_POST['editedBy'];

    $table = "workReq";
    global $con;
    $stmt = "UPDATE $table SET 
            workReqNo = '$workReqNo',
            city = '$city',
            address = '$address',
            servicesType = '$servicesType',
            Quantity = '$Quantity',
            price = '$price',
            Notes = '$Notes',
            paid = '$paid',
            happyCall = '$happyCall',
            editedBy = '$editedBy'
            WHERE id =$id";
    $rows = $con->query($stmt);
    header("Refresh:0;url=showUsr.php?customerID=$customerID");
}
if (isset($_POST["addOrderRequest"])) {
    $order = $_POST['order']; #
    $quantity = $_POST['quantity']; #
    $workReqID = $_POST['id'];
    $price = $_POST['price']; #
    $paid = $_POST['paid']; #
    $serviceType = $_POST['serviceType'];
    $note = $_POST['note']; #
    $personOrdered = $_POST['personOrdered'];
    $orderedFrom = $_POST['orderedFrom']; #

    $reqDate = date("Y/m/d");

    $table = "orders";
    global $con;
    $stmt = "INSERT INTO $table(workReqID,quantity,Required, reqDate,price,paid,serviceType, addNotes, personOrdered,orderedFrom ) VALUES('$workReqID','$quantity','$order','$reqDate','$price','$paid','$serviceType','$note','$personOrdered','$orderedFrom')";
    $rows = $con->query($stmt);
    header("Refresh:0;url=index.php");
}
if (isset($_POST["EditOrderRequest"])) {
    $order = $_POST['order']; #
    $quantity = $_POST['quantity']; #
    $orderID = $_POST['id'];
    $price = $_POST['price']; #
    $paid = $_POST['paid']; #
    $serviceType = $_POST['serviceType'];
    $note = $_POST['note']; #

    $table = "orders";
    global $con;
    $stmt = "UPDATE $table SET quantity = '$quantity',Required='$order',price='$price',paid='$paid',serviceType='$serviceType',addNotes='$note' WHERE orderID = '$orderID'";
    $rows = $con->query($stmt);
    header("Refresh:0;url=index.php");
}
