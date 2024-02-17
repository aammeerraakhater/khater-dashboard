<?php
ob_start();
session_start();

if (isset($_SESSION['workerID'])) {
    $title = " لوحة تحكم الخاطر ";
    $css = "style.css";
    include "init.php";

    if (isset($_GET['city']) && isset($_GET['servicesType'])) {
        $city = $_GET['city'];
        $servicesType = $_GET['servicesType'];
        $results = getDataBasedOnCityServices("workreq", $city, $servicesType);
    } elseif (isset($_GET['serviceStatus'])) {
        $serviceStatus = $_GET['serviceStatus'];
        $results = getDataBasedStatus("workreq", $serviceStatus);
    } elseif (isset($_GET['q'])) {
        $results = getDataBasedMoney("workreq");
    } else {
        $results = getAllData("workreq", "id");
    }
?>

    <body>

        <?php require_once 'mainNavbar.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <?php require_once 'navbar.php'; ?>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">لوحة القيادة</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <?php if (isset($_SESSION['isAdmin']) && ($_SESSION['isAdmin']) == 1) { ?>
                                <div class="btn-group me-2">
                                    <a class="btn btn-sm btn-outline-secondary" href="./saveXlsx.php?q=workReq" role="button"> مشاركة أوامر العمل</a>
                                </div><?php } ?>
                            <div class="dropdown mx-2">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    فلتر للعملاء
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="./index.php?city=بنها&servicesType=تكييف"> عملاء بنها - تكييف</a></li>
                                    <li><a class="dropdown-item" href="./index.php?city=بنها&servicesType=فلتر"> عملاء بنها - فلتر </a></li>
                                    <li><a class="dropdown-item" href="./index.php?city=طوخ&servicesType=تكييف"> عملاء طوخ - تكييف </a></li>
                                    <li><a class="dropdown-item" href="./index.php?city=طوخ&servicesType=فلتر"> عملاء طوخ - فلتر </a></li>
                                </ul>
                            </div>
                            <a class="btn btn-sm btn-outline-secondary" href="./addCustomer.php" role="button"> اضافه عميل</a>
                        </div>
                    </div>

                    <h2> كل العملاء </h2>
                    <div class="table-responsive">
                        <table id="customersTable" class="table align-middle table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">المندوب</th>
                                    <th scope="col">المدينه</th>
                                    <th scope="col">العنوان</th>
                                    <th scope="col">الموبايل</th>
                                    <th scope="col">اضافه امر عمل</th>
                                    <th scope="col">تعديل بيانات العميل</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $i = 1;
                                foreach ($results as $result) {
                                    $customers = getBased("customer", "customerID", $result['customerID'], 'customerID');
                                    foreach ($customers as $customer) {

                                ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><a href="./showUsr.php?customerID=<?php echo $customer['customerID']; ?>" aria-disabled="true" class="text-decoration-none"> <?php echo $customer['usrName']; ?></a></td>
                                            <td> <?php echo $customer['delegate']; ?></td>
                                            <td> <?php echo $customer['city']; ?></td>
                                            <td> <?php echo $customer['address']; ?></td>
                                            <td> <?php echo $customer['phone']; ?></td>
                                            <td> <a href="./addWorkReq.php?customerID=<?php echo $customer['customerID']; ?>" class="btn  btn-outline-success " tabindex="-1" role="button" aria-disabled="true">اضافه </a></td>
                                            <td> <a href="./editUsr.php?customerID=<?php echo $customer['customerID']; ?>" class="btn  btn-outline-info " tabindex="-1" role="button" aria-disabled="true">تعديل </a></td>
                                        </tr>
                                <?php
                                        $i++;
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <hr class="my-4">
                </main>
            </div>
        </div>

    <?php
    include "includes/templates/footer.php";
    ob_end_flush();
} else {
    header("Refresh:0;url=logIn.php");
}
    ?>