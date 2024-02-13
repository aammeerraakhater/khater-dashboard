<?php
ob_start();
session_start();

if (isset($_SESSION['workerID'])) {

    $title = " لوحة تحكم الخاطر ";
    $css = "style.css";
    include "init.php";
    $state = 0;
    if (isset($_GET['q'])) {
        $state = 1;
    }
    $orders = getBased("orders", "isDone", $state, "orderID");
?>

    <?php require_once 'mainNavbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once 'navbar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">لوحة القيادة</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                        </div>

                        <a class="btn btn-sm btn-outline-secondary" href="./addCustomer.php" role="button"> اضافه عميل</a>
                    </div>
                </div>
                <h2> كل العملاء </h2>
                <div class="table-responsive">
                    <table class="table align-middle table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">تعديل بيانات </th>
                                <th scope="col">تمت</th>
                                <th scope="col">الاسم</th>
                                <th scope="col">رقم امر العمل</th>
                                <th scope="col">الكميه</th>
                                <th scope="col">الطلبات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($orders as $order) {
                                $workReqs =  getBased('workreq', 'id', $order['workReqID'], 'customerID');
                                $workReq = $workReqs->fetch_assoc();
                                $customers = getBased('customer', 'customerID', $workReq['customerID'], 'customerID');
                                $customer =  $customers->fetch_assoc();
                            ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td> <a href="./editOrder.php?orderID=<?php echo $order['orderID']; ?>&customerID=<?php echo $workReq['customerID']; ?>" class="btn  btn-outline-info " tabindex="-1" role="button" aria-disabled="true">تعديل </a></td>
                                    <td><input type="checkbox" id="order<?php echo $i; ?>" <?php if ($order['isDone']) {
                                                                                                echo 'checked';
                                                                                            } ?> onclick="confirmOrder('order<?php echo $i; ?>',<?php echo $order['orderID']; ?>)"></td>
                                    <td> <?php echo $customer['usrName']; ?></td>
                                    <td> <?php echo $workReq['workReqNo']; ?></td>
                                    <td> <?php echo $order['quantity']; ?></td>
                                    <td> <?php echo $order['Required']; ?></td>
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

<?php include "includes/templates/footer.php";
    ob_end_flush();
} else {
    header("Refresh:0;url=logIn.php");
}
?>