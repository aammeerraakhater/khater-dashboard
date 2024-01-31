<?php

$title = "اضافه اذن عمل ";
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

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>أمر عمل : <?php echo $customer['usrName']; ?></h2>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg">
                    <form class="needs-validation" novalidate action="procedures.php" method="POST">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="name" class="form-label">رقم التليفون </label>
                                <input type="text" class="form-control" id="phone" name="phone" disabled value="<?php echo $customer['phone']; ?>">

                            </div>

                            <!-- <div class="hidden">
                                <?php $customerID = $_GET['customerID'] ?>
                                <input type="text" class="form-control" id="id" name="customerID" value="<?php echo $customerID; ?>">
                            </div> -->


                            <div class="col-sm-6">
                                <label for="workId" class="form-label">رقم امر العمل </label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="workId" name="workId" disabled value="<?php echo $result['workReqNo']; ?>">

                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <label for="city" class="form-label">المنطقة</label>
                                <input type="text" class="form-control" id="workId" name="workId" disabled value="<?php echo $result['city']; ?>">

                            </div>

                            <div class="col-md-6 col-sm-12">
                                <label for="address" class="form-label">عنوان </label>
                                <input name="address" type="text" class="form-control" id="address" disabled value="<?php echo $result['address']; ?>">
                            </div>


                            <div class="col-sm-6">
                                <label for="technician" class="form-label">الفني</label>
                                <input name="technician" type="text" class="form-control" id="technician" disabled value="<?php echo $result['technician']; ?>">

                            </div>
                            <div class="col-sm-6">
                                <label for="servicesType" class="form-label"> نوع الخدمة</label>
                                <input name="servicesType" type="text" class="form-control" id="servicesType" disabled value="<?php echo $result['servicesType']; ?>">

                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row gy-3">

                            <div class="col-md-3">
                                <label for="quantity" class="form-label">الكمية</label>
                                <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $result['Quantity']; ?>" disabled>

                            </div>
                            <div class="col-md-3">
                                <label for="price" class="form-label">الاجمالي</label>
                                <input type="text" class="form-control" id="price" name="price" value="<?php echo $result['price']; ?>" disabled>

                            </div>

                            <div class="col-md-3">
                                <label for="paid" class="form-label">المدفوع</label>
                                <input type="text" class="form-control" id="paid" name="paid" placeholder="" disabled value="<?php echo $result['paid']; ?>">

                            </div>
                            <div class="col-md-3">
                                <label for="paid" class="form-label">المتبقي</label>
                                <input type="text" class="form-control" id="paid" name="paid" placeholder="" disabled value="<?php echo $result['price'] - $result['paid']; ?>">

                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="col-12">
                            <label for="notes" class="form-label">ملاحظات</label>
                            <div class="form-control"><?php echo $result['Notes']; ?></div>
                        </div>
                        <hr class=" my-4">

                        <button class="w-100 btn btn-primary btn-lg" name="submitWorkReq" type="submit"> حفظ صوره </button>
                        <hr class="my-4">

                    </form>
                </div>
            </div>
        <?php } else { ?>
            <div class="py-5 text-center">
                <h2>برجاء اختيار عميل لادخال امر العمل </h2>
                <a class="btn btn-sm btn-outline-secondary" href="./allCustomers.php" role="button"> الرجوع لصفحه العملاء </a>

            </div>
        <?php } ?>
        </main>
    </div>

    <?php require_once 'includes/templates/footer.php'; ?>