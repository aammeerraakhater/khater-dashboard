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
                <h2> طلب شراء تعديل </h2>
            </div>
            <?php if (isset($_GET['orderID']) && isset($_GET['customerID'])) {
                $customerID = $_GET['customerID'];
                $customers = getBased('customer', 'customerID', $customerID, 'customerID');
                $customer = $customers->fetch_assoc();

                $orderID = $_GET['orderID'];
                $orders = getBased('orders', 'orderID', $orderID, 'orderID');
                $order = $orders->fetch_assoc();
            ?>
                <div class="row">
                    <div class="col-md-12 col-lg">
                        <h4 class="mb-3">طلب شراء </h4>
                        <form class="needs-validation" novalidate action="procedures.php" method="POST">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">الاسم </label>
                                    <div class="form-control"><?php echo $customer['usrName']; ?></div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="phone" class="form-label">رقم التليفون </label>
                                    <div class="form-control"><?php echo $customer['phone']; ?></div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">المدينه </label>
                                    <div class="form-control"><?php echo $customer['city']; ?></div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">العنوان </label>
                                    <div class="form-control"><?php echo $customer['address']; ?></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="quantity" class="form-label">الكمية</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity" required value="<?php echo $order['quantity']; ?>">
                                    <div class="invalid-feedback">
                                        الكمية
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="form-label">السعر</label>
                                    <input type="text" class="form-control" id="price" name="price" required value="<?php echo $order['price']; ?>">
                                    <div class="invalid-feedback">
                                        برجاء ادخل السعر
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="paid" class="form-label">المدفوع</label>
                                    <input type="text" class="form-control" id="paid" name="paid" value="<?php echo $order['paid']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="serviceType" class="form-label">نوع الخدمه</label>
                                    <input type="text" class="form-control" id="serviceType" name="serviceType" value="<?php echo $order['serviceType']; ?>">
                                </div>

                                <div class="hidden">
                                    <input type="text" class="form-control" id="id" name="id" value="<?php echo  $order['orderID']; ?>">
                                </div>
                                <hr class="my-4">
                                <div class="col-12">
                                    <label for="order" class="form-label">الطلبات</label>
                                    <input name="order" type="text" class="form-control" id="order" value="<?php echo $order['Required']; ?>">
                                </div>
                                <div class="col-12 hidden">
                                    <label for="oldOrder" class="form-label">الطلبات</label>
                                    <input name="oldOrder" type="text" class="form-control" id="oldOrder" value="<?php echo $order['Required']; ?>">
                                </div>
                                <div class="col-12">
                                    <label for="note" class="form-label">التواصل /الملاحظات</label>
                                    <input name="note" type="text" class="form-control" id="note" value="<?php echo $order['addNotes']; ?>">
                                </div>
                                <div class="col-12 hidden">
                                    <label for="oldNote" class="form-label">التواصل /الملاحظات</label>
                                    <input name="oldNote" type="text" class="form-control" id="oldNote" value="<?php echo $order['addNotes']; ?>">
                                </div>

                                <hr class="my-4">

                                <button class="w-100 btn btn-primary btn-lg" name="EditOrderRequest" type="submit">حفظ</button>
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