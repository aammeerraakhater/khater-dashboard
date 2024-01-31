<?php
$title = " لوحة تحكم الخاطر ";
$css = "style.css";
include "init.php";
$customers = getAllData("customer", "customerID");
?>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="./index.php">الخاطر جروب</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="عرض/إخفاء لوحة التنقل">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>
    <div class="container-fluid">
        <div class="row">
            <?php require_once 'navbar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">لوحة القيادة</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <!-- <button type="button" class="btn btn-sm btn-outline-secondary" onclick="shareXlsx()">مشاركة</button> -->
                            <!-- <a class="btn btn-sm btn-outline-secondary" href="./saveXlsx.php?q=customers" role="button"> مشاركة كل العملاء</a> -->

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
                                    <td> <a href="./showUsr.php?customerID=<?php echo $customer['customerID']; ?>" class="btn  btn-outline-info " tabindex="-1" role="button" aria-disabled="true">تعديل </a></td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr class="my-4">

            </main>
        </div>
    </div>

    <?php include "includes/templates/footer.php" ?>