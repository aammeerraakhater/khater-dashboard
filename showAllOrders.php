<?php
ob_start();
session_start();

if (isset($_SESSION['workerID'])) {

    $title = " لوحة تحكم الخاطر ";
    $css = "style.css";
    include "init.php";
    if (isset($_GET['q'])) {
        $state =  $_GET['q'];
        $orders = getBased("orders", "orderStatus", $state, "orderID");
    } else {
        $orders = getAllData("orders", "orderID");
    }

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
                        <?php require_once('buttons.php');
                        ?>

                        <a class="btn btn-sm btn-outline-secondary" href="./addCustomer.php" role="button"> اضافه عميل</a>
                    </div>
                </div>
                <h2> كل الطلبات </h2>
                <div class="table-responsive">
                    <table id="ordersTable" class="table align-middle table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">تعديل بيانات </th>
                                <th scope="col">حاله الطلب</th>
                                <th scope="col">الاسم</th>
                                <th scope="col">الطالب</th>
                                <th scope="col">المطلوب منه</th>
                                <th scope="col">رفم التليفون</th>
                                <th scope="col">رقم امر العمل</th>
                                <th scope="col">تاريخ تمام الطلب</th>
                                <th scope="col">تاريخ الطلب</th>
                                <th scope="col">الكميه</th>
                                <th scope="col">السعر</th>
                                <th scope="col">المدفوع</th>
                                <th scope="col">الباقي</th>
                                <th scope="col">الطلبات</th>
                                <th scope="col">ملاحظات</th>
                                <th scope="col">العنوان</th>
                                <th scope="col">المدينه</th>
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
                                    <td>
                                        <select style="width:115px;" class="form-select" id="order<?php echo $i; ?>" name="orderStatus" onchange="confirmOrder(order<?php echo $i; ?>, <?php echo $order['orderID']; ?>,this.value)">
                                            <option selected value="" disabled>اختر...</option>
                                            <?php foreach ($orderStatuses as $orderStatus) { ?>
                                                <option <?php if ($order['orderStatus'] == $orderStatus) {
                                                            echo 'selected';
                                                        } ?> value="<?php echo $orderStatus; ?>"> <?php echo $orderStatus; ?> </option>
                                            <?php } ?>
                                        </select>

                                    </td>
                                    <td> <?php echo $customer['usrName']; ?></td>
                                    <td> <?php echo $order['personOrdered']; ?></td>
                                    <td> <?php echo $order['orderedFrom']; ?></td>
                                    <td> <?php echo $customer['phone']; ?></td>
                                    <td> <?php echo $workReq['workReqNo']; ?></td>
                                    <td> <?php echo $order['doneDate']; ?></td>
                                    <td> <?php echo  $order['reqDate']; ?></td>
                                    <td> <?php echo $order['quantity']; ?></td>
                                    <td> <?php echo $order['price']; ?></td>
                                    <td> <?php echo $order['paid']; ?></td>
                                    <td> <?php echo $order['price'] - $order['paid']; ?></td>
                                    <td>
                                        <div style="width:150px"><?php echo $order['Required']; ?></div>
                                    </td>
                                    <td>
                                        <div style="width:150px"><?php echo $order['addNotes']; ?></div>
                                    </td>
                                    <td> <?php echo $workReq['city']; ?></td>
                                    <td> <?php echo $workReq['address']; ?></td>
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

<?php
    include "includes/templates/footer.php";
    ob_end_flush();
} else {
    header("Refresh:0;url=logIn.php");
}
?>