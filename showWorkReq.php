<?php
ob_start();
session_start();

if (isset($_SESSION['workerID'])) {
    $title = "اذن عمل ";
    $css = "style.css";
    include "init.php";
?>
    <?php require_once 'mainNavbar.php'; ?>
    <?php if (isset($_GET['customerID']) && isset($_GET['id'])) {
        $customerID = $_GET['customerID'];
        $id = $_GET['id'];
        $customers = getBased('customer', 'customerID', $customerID, "customerID");
        $results = getBased("workReq", 'id', $id, "id");
        $customer = $customers->fetch_assoc();
        $result = $results->fetch_assoc();
    ?>

        <div class="container" id="capture">
            <main>
                <div>

                    <div class="py-5 text-center">
                        <h2>أمر عمل : <?php echo $customer['usrName']; ?></h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">رقم التليفون </label>
                                    <div class="form-control"><?php echo $customer['phone']; ?></div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="workId" class="form-label">رقم امر العمل </label>
                                    <div class="input-group has-validation">
                                        <div class="form-control"><?php echo $result['workReqNo']; ?></div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="city" class="form-label">المنطقة</label>
                                    <div class="form-control"><?php echo $result['city']; ?></div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="address" class="form-label">عنوان </label>
                                    <div class="form-control"><?php echo $result['address']; ?></div>
                                </div>


                                <div class="col-sm-6">
                                    <label for="technician" class="form-label">الفني</label>
                                    <div class="form-control"><?php echo $result['technician']; ?></div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="servicesType" class="form-label"> نوع الخدمة</label>
                                    <div class="form-control"><?php echo $result['servicesType']; ?></div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row gy-3">

                                <div class="col-md-3">
                                    <label for="quantity" class="form-label">الكمية</label>
                                    <div class="form-control"><?php echo $result['Quantity']; ?></div>
                                </div>
                                <div class="col-md-3">
                                    <label for="price" class="form-label">الاجمالي</label>
                                    <div class="form-control"><?php echo $result['price']; ?></div>
                                </div>

                                <div class="col-md-3">
                                    <label for="paid" class="form-label">المدفوع</label>
                                    <div class="form-control"><?php echo $result['paid']; ?></div>
                                </div>
                                <div class="col-md-3">
                                    <label for="rest" class="form-label">المتبقي</label>
                                    <div class="form-control"><?php echo $result['price'] - $result['paid']; ?></div>
                                </div>
                            </div>

                            <hr class="my-4">
                            <div class="col-12">
                                <label for="notes" class="form-label">ملاحظات</label>
                                <div class="form-control"><?php echo $result['Notes']; ?></div>
                            </div>
                            <hr class=" my-4">

                        </div>
                    </div>
                </div>

            <?php } else { ?>
                <div class="py-5 text-center">
                    <h2>برجاء اختيار عميل لادخال امر العمل </h2>
                    <a class="btn btn-sm btn-outline-secondary" href="./showAllCustomers.php" role="button"> الرجوع لصفحه العملاء </a>

                </div>
            <?php } ?>
            </main>
            <button class="w-100 btn btn-primary btn-lg" id="captureBtn" onclick="capture()"> حفظ صوره </button>
            <hr class="my-4">

        </div>

    <?php require_once 'includes/templates/footer.php';
    ob_end_flush();
} else {
    header("Refresh:0;url=logIn.php");
}
    ?>