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
                </div><?php }
                    require_once('buttons.php');
                      ?>

              <a class="btn btn-sm btn-outline-secondary" href="./addCustomer.php" role="button"> اضافه عميل</a>
            </div>
          </div>

          <h2> كل أوامر العمل </h2>
          <div class="table-responsive">
            <table id="example" class="table align-middle table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">حالة الخدمة</th>
                  <th scope="col">الاسم</th>
                  <th scope="col">أمر العمل</th>
                  <th scope="col">الفني</th>
                  <th scope="col">المندوب</th>
                  <th scope="col">تاريخ الطلب</th>
                  <th scope="col">تاريخ التنفيذ</th>
                  <th scope="col">المدينه</th>
                  <th scope="col">العنوان</th>
                  <th scope="col">الموبايل</th>
                  <th scope="col">نوع الخدمه</th>
                  <th scope="col">الكميه</th>
                  <th scope="col">السعر </th>
                  <th scope="col">المدفوع </th>
                  <th scope="col">الباقي </th>
                  <th scope="col">الملاحظات </th> <!-- 16 -->
                  <th scope="col">Happy call </th> <!-- 17 -->
                  <th scope="col">اخر تعديل</th> <!-- 17 -->
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
                      <td>
                        <select style="width:115px;" class="form-select" id="serviceStatus<?php echo $i; ?>" name="serviceStatus" onchange="changeStatus(serviceStatus<?php echo $i; ?>, <?php echo $result['id']; ?>,this.value)">
                          <option selected value="" disabled>اختر...</option>
                          <?php foreach ($serviceStatuses as $serviceStatus) { ?>
                            <option <?php if ($result['serviceStatus'] == $serviceStatus) {
                                      echo 'selected';
                                    } ?> value="<?php echo $serviceStatus; ?>"> <?php echo $serviceStatus; ?> </option>
                          <?php } ?>
                        </select>
                      </td>
                      <td> <a href="./showUsr.php?customerID=<?php echo $customer['customerID']; ?>" aria-disabled="true" class="text-decoration-none"> <?php echo $customer['usrName']; ?></a></td>
                      <td> <?php echo $result['workReqNo']; ?></td>
                      <td> <select style="width:150px;" class="form-select" id="technician<?php echo $i; ?>" name="technician" onchange="changetechnician(technician<?php echo $i; ?>,<?php echo $result['id']; ?>,this.value)">
                          <option selected value="" disabled>اختر...</option>
                          <?php foreach ($technicians as $technician) { ?>
                            <option <?php if ($result['technician'] == $technician['wName']) {
                                      echo 'selected';
                                    } ?> value="<?php echo $technician['wName']; ?>"> <?php echo $technician['wName']; ?> </option>
                          <?php } ?>
                        </select>
                      </td>
                      <td> <?php echo $result['delegate']; ?></td>
                      <td> <?php echo $result['reqDate']; ?></td>
                      <td> <?php echo $result['operatedDate']; ?></td>
                      <td> <?php echo $result['city']; ?></td>
                      <td> <?php echo $result['address']; ?></td>
                      <td> <?php echo $customer['phone']; ?></td>
                      <td> <?php echo $result['servicesType']; ?></td>
                      <td> <?php echo $result['Quantity']; ?></td>
                      <td> <?php echo $result['price']; ?></td>
                      <td> <?php echo $result['paid']; ?></td>
                      <td> <?php echo $result['price'] - $result['paid']; ?></td>
                      <td>
                        <div style="width:300px;"><?php echo $result['Notes']; ?></div>
                      </td>
                      <td>
                        <div style="width:300px;"><?php echo $result['happyCall']; ?></div>
                      </td>
                      <td> <?php echo $result['editedBy']; ?></td>

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