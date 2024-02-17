<?php
ob_start();
session_start();

if (isset($_SESSION['workerID'])) {
    $title = "اضافه طلب شراء";
    $css = "style.css";
    include "init.php";
?>
    <?php require_once 'mainNavbar.php'; ?>

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>طلب شراء جديد</h2>
            </div>
            <?php if (isset($_GET['customerID']) && isset($_GET['id'])) {
                $customerID = $_GET['customerID'];
                $customers = getBased('customer', 'customerID', $customerID, 'customerID');
                $customer = $customers->fetch_assoc();

                $workReqID = $_GET['id'];
            ?>
                <div class="row">
                    <div class="col-md-12 col-lg">
                        <h4 class="mb-3">طلب شراء </h4>
                        <form class="needs-validation" novalidate action="procedures.php" method="POST">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">الاسم </label>
                                    <input type="text" class="form-control" id="name" name="name" disabled value="<?php echo $customer['usrName']; ?>">
                                    <div class="invalid-feedback">
                                        يرجى إدخال اسم صحيح.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="personOrdered" class="form-label">الطالب</label>
                                    <input type="text" class="form-control" id="personOrdered" name="personOrdered" value="<?php echo $_SESSION['wName']; ?>" required>
                                    <div class="invalid-feedback">
                                        برجاء ادخل الطالب
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="orderedFrom" class="form-label">مطلوب من</label>
                                    <input type="text" class="form-control" id="orderedFrom" name="orderedFrom" required>
                                    <div class="invalid-feedback">
                                        برجاء ادخل السعر
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="quantity" class="form-label">الكمية</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity" required>
                                    <div class="invalid-feedback">
                                        الكمية
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="price" class="form-label">السعر</label>
                                    <input type="text" class="form-control" id="price" name="price" required>
                                    <div class="invalid-feedback">
                                        برجاء ادخل السعر
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="paid" class="form-label">المدفوع</label>
                                    <input type="text" class="form-control" id="paid" name="paid">
                                </div>
                                <div class="col-md-6">
                                    <label for="serviceType" class="form-label">نوع الخدمه</label>
                                    <input type="text" class="form-control" id="serviceType" name="serviceType">
                                </div>

                                <div class="hidden">
                                    <input type="text" class="form-control" id="id" name="id" value="<?php echo  $_GET['id']; ?>">
                                </div>
                                <hr class="my-4">
                                <div class="col-12">
                                    <label for="order" class="form-label">الطلبات</label>
                                    <input name="order" type="text" class="form-control" id="order">
                                </div>
                                <div class="col-12">
                                    <label for="note" class="form-label">التواصل /الملاحظات</label>
                                    <input name="note" type="text" class="form-control" id="note">
                                </div>
                                <hr class="my-4">

                                <button class="w-100 btn btn-primary btn-lg" name="addOrderRequest" type="submit">حفظ</button>
                                <hr class="my-4">

                            </div>

                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="py-5 text-center">
                    <h2>برجاء اختيار امر عمل لادخال طلب الشراء </h2>
                    <a class="btn btn-sm btn-outline-secondary" href="./allCustomers.php" role="button"> الرجوع لصفحه العملاء </a>

                </div>
            <?php } ?>
        </main>
    </div>


<?php require_once 'includes/templates/footer.php';
    ob_end_flush();
} else {
    header("Refresh:0;url=logIn.php");
}

?>