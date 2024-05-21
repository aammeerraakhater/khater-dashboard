<?php
ob_start();
session_start();
include 'includes/header.php';
include 'init.php'; ?>
<div class="container-scroller">
  <!-- partial:partials/_navbar.html -->
  <?php include 'nav.php' ?>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php
    include 'sideNav.php';
    $date = date('Y-m') . '-%';
    ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
              <i class="mdi mdi-home"></i>
            </span>
            الداش بورد
          </h3>
        </div>
        <div class="row">
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">
                  مبيعات الشهر
                  <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <?php $sumresult =  getSum($table = 'workreq', $countElement = 'paid', $condition = 'operatedDate', $monthlyDate = $date)->fetch_array(); ?>
                <h2 class="mb-5"><?php echo $sumresult[0]; ?><i class=" mdi mdi-cash-usd "></i></h2>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">
                  عدد اوامر العمل في الشهر
                  <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <?php $countresult =  getCount($table = 'workreq', $countElement = 'id', $condition = 'reqDate', $date)->fetch_assoc(); ?>

                <h2 class="mb-5"><?php
                                  foreach ($countresult as $rekg) {
                                    echo $rekg;
                                  }  ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">
                  عدد العملاء
                  <i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>
                <?php $countresult =  getCountAll()->fetch_assoc(); ?>
                <h2 class="mb-5"><?php
                                  foreach ($countresult as $rekg) {
                                    echo $rekg;
                                  }  ?></h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <?php $results = getBased("workreq", "serviceStatus", "عمل اليوم", "id"); ?>
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title"><?php echo $results->num_rows; ?> أعمال لليوم </h4>
                <div class="table-responsive">
                  <div class="card-body px-2">
                    <h4 class="card-title">أوامر العمل</h4>
                    </p>
                    <table class="table table-bordered table-striped">
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
                              <td>
                                <div style="width:150px;">
                                  <a href="./showUsr.php?customerID=<?php echo $customer['customerID']; ?>" aria-disabled="true" class="text-decoration-none"> <?php echo $customer['usrName']; ?></a>
                                </div>
                              </td>
                              <td> <?php echo $result['workReqNo']; ?></td>
                              <td> <select style="width:150px;height:fit-content;" class="form-select" id="technician<?php echo $i; ?>" name="technician" onchange="changetechnician(technician<?php echo $i; ?>,<?php echo $result['id']; ?>,this.value)">
                                  <option selected value="" disabled>اختر...</option>
                                  <?php foreach ($technicians as $technician) { ?>
                                    <option <?php if ($result['technician'] == $technician['wName']) {
                                              echo 'selected';
                                            } ?> value="<?php echo $technician['wName']; ?>"> <?php echo $technician['wName']; ?> </option>
                                  <?php } ?>
                                </select>
                              </td>
                              <td> <?php echo $result['delegate']; ?></td>

                              <td>
                                <div style="width:100px;"> <?php echo $result['reqDate']; ?> </div>
                              </td>
                              <td>
                                <div style="width:100px;"> <?php echo $result['operatedDate']; ?> </div>
                              </td>
                              <td> <?php echo $result['city']; ?></td>
                              <td> <?php echo $result['address']; ?></td>
                              <td> <?php echo $customer['phone']; ?></td>
                              <td> <?php echo $result['servicesType']; ?></td>
                              <td> <?php echo $result['Quantity']; ?></td>
                              <td> <?php echo $result['price']; ?></td>
                              <td> <?php echo $result['paid']; ?></td>
                              <td> <?php echo $result['price'] - $result['paid']; ?></td>
                              <td>
                                <div style="width:300px;height:fit=content;"><?php echo $result['Notes']; ?></div>
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
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">المبيعات ومقدارها</h4>
                <div class="table-responsive">
                  <table class="table">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>عدد اوامر العمل</th>
                        <th>النسبه</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $totalNum = getCountAll($table = 'customer', $countElement = 'customerID')->fetch_array();
                      $i = 1;
                      foreach ($technicians as $technician) { ?>
                        <tr>
                          <td><?= $i; ?></td>
                          <td><?php echo $technician['wName']; ?></td>
                          <?php $countresult = getCount($table = 'workreq', $countElement = 'id', $condition = 'technician', $technician['wName'])->fetch_array(); ?>
                          <td><?php echo $countresult[0] ?></td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-<?php echo $colors[$i % 5]; ?>" role="progressbar" style="width: <?php echo ($countresult[0] / $totalNum[0]) * 100; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                        </tr>
                      <?php
                        $i++;
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">انواع الخدمه و النسبه </h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>نوع الخدمة</th>
                        <th>النسبه بالارقام</th>
                        <th>النسبه</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      $totalNum = getCountAll($table = 'customer', $countElement = 'customerID')->fetch_array();
                      foreach ($serviceStatuses as $serviceStatus) { ?>
                        <tr>
                          <td><?= $i; ?></td>
                          <td><?php echo $serviceStatus; ?></td>
                          <?php $countresult = getCount($table = 'workreq', $countElement = 'id', $condition = 'serviceStatus',  $serviceStatus)->fetch_array(); ?>
                          <td><?php echo $countresult[0]; ?></td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-<?php echo $colors[$i % 5]; ?>" role="progressbar" style="width: <?php echo ($countresult[0] / $totalNum[0]) * 100; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                        </tr>
                      <?php
                        $i++;
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- <div class="row">
          <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="clearfix">
                  <h4 class="card-title float-left">
                    Visit And Sales Statistics
                  </h4>
                  <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                </div>
                <canvas id="visit-sale-chart" class="mt-4"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Traffic Sources</h4>
                <canvas id="traffic-chart"></canvas>
                <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
              </div>
            </div>
          </div>
        </div> -->
      </div>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<?php include "includes/footer.php";
ob_end_flush();
