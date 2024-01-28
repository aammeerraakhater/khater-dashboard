<?php
$title = " لوحة تحكم الخاطر ";
$css = "style.css";
include "init.php";
$customers = getAllData("customer");
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
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./index.php">
                                <span data-feather="home"></span>
                                كل أوامر العمل
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="./allCustomers.php">
                                <span data-feather="home"></span>
                                كل العملاء
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?city=بنها&servicesType=تركيب">
                                <span data-feather="shopping-cart"></span>
                                عملاء بنها - تركيب
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?city=بنها&servicesType=صيانة">
                                <span data-feather="users"></span>
                                عملاء بنها - صيانة
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?city=طوخ&servicesType=تركيب">
                                <span data-feather="bar-chart-2"></span>
                                عملاء طوخ - تركيب
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?city=طوخ&servicesType=صيانة">
                                <span data-feather="layers"></span>
                                عملاء طوخ - صيانة
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>التقارير</span>
                        <a class="link-secondary" href="#" aria-label="إضافة تقرير جديد">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>

                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?serviceStatus=عمل اليوم">
                                <span data-feather="file-text"></span>
                                عمل اليوم
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?serviceStatus=شكوى">
                                <span data-feather="file-text"></span>
                                شكوى
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?serviceStatus=تأجيل">
                                <span data-feather="file-text"></span>
                                تأجيل
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?serviceStatus=تمت">
                                <span data-feather="file-text"></span>
                                تمت
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?serviceStatus=مطلوب">
                                <span data-feather="file-text"></span>
                                مطلوب
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?serviceStatus=بالورشة">
                                <span data-feather="file-text"></span>
                                بالورشة
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?q=unpaid">
                                <span data-feather="file-text"></span>
                                عملاء عليهم مديونية
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">لوحة القيادة</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <!-- <button type="button" class="btn btn-sm btn-outline-secondary" onclick="shareXlsx()">مشاركة</button> -->
                            <a class="btn btn-sm btn-outline-secondary" href="./saveXlsx.php?q=customers" role="button"> مشاركة كل العملاء</a>

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
                                <th scope="col">عرض العميل</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($customers as $customer) {
                            ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $customer['usrName']; ?></td>
                                    <td> <?php echo $customer['delegate']; ?></td>
                                    <td> <?php echo $customer['city']; ?></td>
                                    <td> <?php echo $customer['address']; ?></td>
                                    <td> <?php echo $customer['phone']; ?></td>
                                    <td> <a href="./addWorkReq.php?customerID=<?php echo $customer['customerID']; ?>" class="btn  btn-outline-success " tabindex="-1" role="button" aria-disabled="true">اضافه </a></td>
                                    <td> <a href="./showUsr.php?customerID=<?php echo $customer['customerID']; ?>" class="btn  btn-outline-info " tabindex="-1" role="button" aria-disabled="true">عرض </a></td>
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