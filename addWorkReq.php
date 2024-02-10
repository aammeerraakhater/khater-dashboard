<?php
ob_start();
session_start();

if (isset($_SESSION['workerID'])) {
  $title = "اضافه اذن عمل ";
  $css = "style.css";
  include "init.php";
?>
  <?php require_once 'mainNavbar.php'; ?>

  <div class="container">
    <main>
      <div class="py-5 text-center">
        <h2>أمر عمل جديد</h2>
      </div>
      <?php if (isset($_GET['customerID'])) {
        $customerID = $_GET['customerID'];
        $customers = getBased('customer', 'customerID', $customerID, 'customerID');
        $customer = $customers->fetch_assoc();
        $dbcity = $customer['city'];
        array_push($cities, $dbcity);
        $cities = array_unique($cities);

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
                <div class="col-sm-6">
                  <label for="city" class="form-label">المنطقة</label>
                  <select class="form-select" id="city" name="city" required onchange="addAlternitave(this.value, 'allCityAlt', 'altCity', 'city')">
                    <option value="" selected disabled>اختر...</option>
                    <?php foreach ($cities as $city) { ?>
                      <option <?php if ($customer['city'] == $city) {
                                echo 'selected';
                              } ?> value="<?php echo $city; ?>"> <?php echo $city; ?> </option>
                    <?php } ?>
                  </select>
                  <div class="invalid-feedback">
                    يرجى إدخال المنطقة
                  </div>
                </div>
                <div class="hidden col-sm-6" id="allCityAlt">
                  <label for="altCity" class="form-label">المنطقة</label>
                  <input type="text" class="form-control" id="altCity" name="">
                  <div class="invalid-feedback">
                    يرجى إدخال المنطقة
                  </div>
                </div>


                <div class="col-md-6 col-sm-12">
                  <label for="address" class="form-label">عنوان </label>
                  <input name="address" type="text" class="form-control" id="address" value="<?php echo $customer['address']; ?>">
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
                  <select class="form-select" id="servicesType" name="servicesType" onchange="addAlternitave(this.value, 'allServicesTypealt', 'altServicesType', 'servicesType')">
                    <option value="">اختر...</option>
                    <?php foreach ($serviceTypes as $serviceType) { ?>
                      <option value="<?php echo $serviceType ?>"><?php echo $serviceType ?></option>
                    <?php } ?>
                  </select>
                  <div class="invalid-feedback">
                    نوع الخدمة .
                  </div>
                </div>
                <div class="hidden col-sm-6" id="allServicesTypealt">
                  <label for="altServicesType" class="form-label">نوع الخدمة</label>
                  <input type="text" class="form-control" id="altServicesType" name="">
                  <div class="invalid-feedback">
                    يرجى إدخال نوع الخدمة
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


<?php require_once 'includes/templates/footer.php';
  ob_end_flush();
} else {
  header("Refresh:0;url=logIn.php");
}

?>