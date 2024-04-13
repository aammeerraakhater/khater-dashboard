<?php
ob_start();
session_start();

if (isset($_SESSION['workerID'])) {
    $title = "تعديل اذن عمل ";
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
        $dbcity = $result['city'];
        array_push($cities, $dbcity);
        $cities = array_unique($cities);
        $dbservicesType = $result['servicesType'];
        array_push($serviceTypes, $dbservicesType);
        $serviceTypes = array_unique($serviceTypes);

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

                                <div class="hidden">
                                    <?php $customerID = $_GET['customerID'] ?>
                                    <input type="text" class="form-control" id="customerID" name="customerID" value="<?php echo $customerID; ?>">
                                </div>
                                <div class="hidden">
                                    <?php $id = $_GET['id'] ?>
                                    <input type="text" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                                </div>
                                <div class="hidden">
                                    <input type="text" class="form-control" name="editedBy" value="<?php echo $_SESSION['wName']; ?>">
                                </div>


                                <div class="col-sm-6">
                                    <label for="workId" class="form-label">رقم امر العمل </label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" id="workId" name="workId" value="<?php echo $result['workReqNo']; ?>">

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="city" class="form-label">المنطقة</label>
                                    <select class="form-select" id="city" name="city" required onchange="addAlternitave(this.value, 'allCityAlt', 'altCity', 'city')">
                                        <option value="" selected disabled>اختر...</option>
                                        <?php foreach ($cities as $city) { ?>
                                            <option <?php if ($result['city'] == $city) {
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
                                    <input name="address" type="text" class="form-control" id="address" value="<?php echo $result['address']; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="address" class="form-label">المندوب </label>
                                    <input type="text" class="form-control" id="altCity" name="" value="<?php echo $result['delegate']; ?>" disabled>
                                </div>

                                <div class="col-sm-6">
                                    <label for="serviceTypes" class="form-label">نوع الخدمه</label>
                                    <select class="form-select" id="serviceTypes" name="serviceTypes" required onchange="addAlternitave(this.value, 'allserviceTypesAlt', 'altserviceTypes', 'serviceTypes')">
                                        <option value="" selected disabled>اختر...</option>
                                        <?php foreach ($serviceTypes as $serviceType) { ?>
                                            <option <?php if ($result['servicesType'] == $serviceType) {
                                                        echo 'selected';
                                                    } ?> value="<?php echo $serviceType; ?>"> <?php echo $serviceType; ?> </option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        يرجى ادخال نوع الخدمه
                                    </div>
                                </div>
                                <div class="hidden col-sm-6" id="allServicesTypealt">
                                    <label for="altServicesType" class="form-label">نوع الخدمة</label>
                                    <input type="text" class="form-control" id="altServicesType" name="">
                                    <div class="invalid-feedback">
                                        يرجى إدخال نوع الخدمة
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="orderTypes" class="form-label">نوع الصنف</label>
                                    <select class="form-select" id="orderTypes" name="orderType" required onchange="addAlternitave(this.value,  'allOrdersTypealt', 'altOrdersType', 'orderType')">
                                        <option value="" selected disabled>اختر...</option>
                                        <?php foreach ($orderTypes as $orderType) { ?>
                                            <option <?php if ($result['orderType'] == $orderType) {
                                                        echo 'selected';
                                                    } ?> value="<?php echo $orderType; ?>"> <?php echo $orderType; ?> </option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        يرجى إدخال نوع الصنف
                                    </div>
                                </div>
                                <div class="hidden col-sm-6" id="allServicesTypealt">
                                    <label for="altServicesType" class="form-label">نوع الخدمة</label>
                                    <input type="text" class="form-control" id="altServicesType" name="">
                                    <div class="invalid-feedback">
                                        يرجى إدخال نوع الصنف
                                    </div>
                                </div>
                                
                            </div>

                            <hr class="my-4">

                            <div class="row gy-3">

                                <div class="col-md-4">
                                    <label for="quantity" class="form-label">الكمية</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $result['Quantity']; ?>">

                                </div>
                                <div class="col-md-4">
                                    <label for="price" class="form-label">الاجمالي</label>
                                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $result['price']; ?>">

                                </div>

                                <div class="col-md-4">
                                    <label for="paid" class="form-label">المدفوع</label>
                                    <input type="text" class="form-control" id="paid" name="paid" placeholder="" value="<?php echo $result['paid']; ?>">

                                </div>
                            </div>

                            <hr class="my-4">
                            <div class="row gy-3">

                                <div class="col-12">
                                    <label for="notes" class="form-label">ملاحظات</label>
                                    <input type="text" class="form-control" id="notes" name="notes" placeholder="" value="<?php echo $result['Notes']; ?>">
                                </div>
                                <div class="col-12">
                                    <label for="notes" class="form-label">Happy call</label>
                                    <input type="text" class="form-control" id="happyCall" name="happyCall" placeholder="" value="<?php echo $result['happyCall']; ?>">
                                </div>
                                <div class="col-12 hidden">
                                    <label for="oldNotes" class="form-label">ملاحظات</label>
                                    <input type="text" class="form-control" id="oldNotes" name="oldNotes" placeholder="" value="<?php echo $result['Notes']; ?>">
                                </div>
                                <div class="col-12 hidden">
                                    <label for="oldHappyCall" class="form-label">Happy call</label>
                                    <input type="text" class="form-control" id="oldHappyCall" name="oldHappyCall" placeholder="" value="<?php echo $result['happyCall']; ?>">
                                </div>
                            </div>
                            <hr class=" my-4">

                            <button class="w-100 btn btn-primary btn-lg" name="editWorkReq" type="submit"> تعديل اذن الصرف </button>
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