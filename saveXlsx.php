<?php

// Load the database configuration file 
include_once 'connect_db.php';

// Include XLSX generator library 
require_once 'PhpXlsxGenerator.php';

// Excel file name for download 
if (isset($_GET['q']) && $_GET['q'] == 'customers') {
    $fileName = "عملاء الخاطر_" . date('Y-m-d') . ".xlsx";

    // Define column names 
    $excelData[] = array('#', 'الاسم', 'رقم التليفون', 'المندوب', 'نوع الخدمة', 'المدينه ', 'العنوان');

    // Fetch records from database and store in an array 
    $query = $con->query("SELECT * FROM customer ORDER BY customerID ASC");
    if ($query->num_rows > 0) {
        $i = 1;
        while ($customer = $query->fetch_assoc()) {
            $lineData =  array($i, $customer['usrName'], $customer['phone'], $customer['delegate'], $customer['servicesType'], $customer['city'], $customer['address']);
            $excelData[] = $lineData;
            $i++;
        }
    }

    // Export data to excel and download as xlsx file 
    $xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
    $xlsx->downloadAs($fileName);
} elseif (isset($_GET['q']) && $_GET['q'] == 'workReq') {
    $fileName = "أوامر العمل_" . date('Y-m-d') . ".xlsx";

    // Define column names 
    $excelData[] = array('#', 'اسم العميل', 'رقم التليفون', 'المندوب', 'رقم امل العمل', 'تاريخ العمل', 'تاريخ تمام العمل', 'الفني', 'نوع الخدمه', 'الكميه', 'السعر', 'المدفوع', 'ملاحظات', 'نوع الخدمه', 'المدينه', 'العنوان');

    // Fetch records from database and store in an array 
    $query = $con->query("SELECT * FROM workreq ORDER BY id ASC");
    if ($query->num_rows > 0) {
        $i = 1;
        while ($row = $query->fetch_assoc()) {
            $customerID = $row['customerID'];
            $queryCustomer = $con->query("SELECT * FROM customer  WHERE customerID = $customerID");
            $customer = $queryCustomer->fetch_assoc();
            $lineData =  array($i, $customer['usrName'], $customer['phone'], $customer['delegate'], $row['workReqNo'], $row['reqDate'], $row['operatedDate'], $row['technician'], $row['servicesType'], $row['Quantity'], $row['price'], $row['paid'], $row['Notes'], $row['serviceStatus'], $row['city'], $row['address']);
            $excelData[] = $lineData;
            $i++;
        }
    }

    // Export data to excel and download as xlsx file 
    $xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
    $xlsx->downloadAs($fileName);
}
exit;
