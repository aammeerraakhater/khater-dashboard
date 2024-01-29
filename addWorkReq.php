<?php

$title = "اضافه اذن عمل ";
$css = "style.css";
include "init.php";
?>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="./index.php">الخاطر جروب</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="عرض/إخفاء لوحة التنقل">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">تسجيل الخروج</a>
    </div>
  </div>
</header>

<div class="container">
  <main>
    <div class="py-5 text-center">
      <h2>أمر عمل جديد</h2>
    </div>
    <?php if (isset($_GET['customerID'])) {
      $customerID = $_GET['customerID'];
      $customers =  getDataBasedID('customer', $customerID);
      $customer = $customers->fetch_assoc();
    ?>
      <div class="row">
        <div class="col-md-12 col-lg">
          <h4 class="mb-3">أمر عمل</h4>
          <form class="needs-validation" novalidate action="procedures.php" method="POST">
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="name" class="form-label">الاسم </label>
                <input type="text" class="form-control" id="name" name="name" disabled value="<?php echo $customer['usrName']; ?>">
                <div class="invalid-feedback">
                  يرجى إدخال اسم صحيح.
                </div>
              </div>

              <div class="hidden">
                <?php $customerID = $_GET['customerID'] ?>
                <input type="text" class="form-control" id="id" name="customerID" value="<?php echo $customerID; ?>">
              </div>


              <div class="col-sm-6">
                <label for="workId" class="form-label">رقم امر العمل </label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" id="workId" name="workId" required>
                  <div class="invalid-feedback">
                    رقم العمل الخاص بالعميل
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-12">
                <label for="city" class="form-label">المنطقة</label>
                <select class="form-select" id="city" name="city" required>
                  <option selected value="" disabled>اختر...</option>
                  <?php foreach ($cities as $city) { ?>
                    <option value="<?php echo $city; ?>"> <?php echo $city; ?> </option>
                  <?php } ?>
                </select>

                <div class="invalid-feedback">
                  يرجى إدخال المنطقة
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <label for="city" class="form-label">المنطقة</label>
                <input name="city" type="text" class="form-control" id="address" value="">
                <div class="invalid-feedback">
                  يرجى إدخال المنطقة
                </div>
              </div>

              <div class="col-md-6 col-sm-12">
                <label for="address" class="form-label">عنوان </label>
                <input class="hidden" name="address" type="text" class="form-control" id="address" value="<?php echo $customer['address']; ?>">
              </div>


              <div class="col-sm-6">
                <label for="technician" class="form-label">الفني</label>
                <select class="form-select" id="technician" name="technician">
                  <option value="">اختر...</option>
                  <?php foreach ($technicians as $technician) { ?>
                    <option value="<?php echo $technician ?>"><?php echo $technician ?></option>
                  <?php } ?>
                </select>
                <div class="invalid-feedback">
                  يرجى اختيار اسم الفني
                </div>
              </div>
              <div class="col-sm-6">
                <label for="servicesType" class="form-label"> نوع الخدمة</label>
                <select class="form-select" id="servicesType" name="servicesType">
                  <option value="">اختر...</option>
                  <?php foreach ($serviceTypes as $serviceType) { ?>
                    <option value="<?php echo $serviceType ?>"><?php echo $serviceType ?></option>
                  <?php } ?>
                </select>
                <div class="invalid-feedback">
                  نوع الخدمة .
                </div>
              </div>
            </div>

            <hr class="my-4">

            <div class="row gy-3">

              <div class="col-md-4">
                <label for="quantity" class="form-label">الكمية</label>
                <input type="text" class="form-control" id="quantity" name="quantity" required>
                <div class="invalid-feedback">
                  الكمية
                </div>
              </div>
              <div class="col-md-4">
                <label for="price" class="form-label">المبلغ</label>
                <input type="text" class="form-control" id="price" name="price" required>
                <div class="invalid-feedback">
                  المبلغ
                </div>
              </div>

              <div class="col-md-4">
                <label for="paid" class="form-label">المدفوع</label>
                <input type="text" class="form-control" id="paid" name="paid" placeholder="" required>
                <div class="invalid-feedback">
                  المدفوع
                </div>
              </div>
            </div>

            <hr class="my-4">
            <div class="col-12">
              <label for="notes" class="form-label">ملاحظات</label>
              <input name="notes" type="text" class="form-control" id="notes">
            </div>
            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" name="submitWorkReq" type="submit">حفظ</button>
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


<script src="layout/js/bootstrap.bundle.min.js"></script>

<script src="layout/js/form-validation.js"></script>
</body>

</html>