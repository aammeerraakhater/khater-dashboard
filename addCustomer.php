<?php
ob_start();
session_start();

if (isset($_SESSION['workerID'])) {

    $title = "اضافه عميل";
    $css = "style.css";
    include "init.php";
?>
    <?php require_once 'mainNavbar.php'; ?>

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>عميل جديد</h2>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg">
                    <h4 class="mb-3">أضافه عميل</h4>
                    <form class="needs-validation" novalidate action="procedures.php" method="POST">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="name" class="form-label">الاسم </label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">
                                    يرجى إدخال اسم صحيح.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="phone" class="form-label">رقم الهاتف</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                                <div class="invalid-feedback">
                                    يرجى إدخال رقم هاتف.
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <label for="city" class="form-label">المنطقة</label>
                                <select class="form-select" id="city" name="city" required onchange="addAlternitave(this.value, 'allCityAll', 'altCity', 'city')">
                                    <option value="" selected disabled>اختر...</option>
                                    <?php foreach ($cities as $city) { ?>
                                        <option value="<?php echo $city ?>"><?php echo $city ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    يرجى إدخال المنطقة
                                </div>
                            </div>
                            <div class="hidden col-sm-6" id="allCityAll">
                                <label for="altCity" class="form-label">المنطقة</label>
                                <input type="text" class="form-control" id="altCity" name="">
                                <div class="invalid-feedback">
                                    يرجى إدخال المنطقة
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="delegate" class="form-label">المندوب</label>
                                <select class="form-select" id="delegate" name="delegate" required>
                                    <option value="" selected disabled>اختر...</option>
                                    <?php foreach ($delegants as $delegant) { ?>
                                        <option value="<?php echo $delegant ?>"><?php echo $delegant ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    يرجى اختيار المندوب
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">عنوان </label>
                                <input name="address" type="text" class="form-control" id="address" placeholder="" required>
                                <div class="invalid-feedback">
                                    يرجى إدخال العنوان
                                </div>

                            </div>

                        </div>
                        <div class="col-sm-12">
                            <p> اختر طلب العميل </p>
                            <input type="checkbox" id="option1" name="customerType" value="تكييف">
                            <label for="option1"> تكييف</label>
                            <input type="checkbox" id="option2" name="customerType1" value="فلاتر">
                            <label for="option2"> فلاتر </label>
                            <input type="checkbox" id="option3" name="customerType2" value="مراتب">
                            <label for="option3"> مراتب </label>
                            <div class="invalid-feedback">
                                يرجى اختيار المندوب
                            </div>
                        </div>

                        <hr class="my-4">



                        <button class="w-45 btn btn-primary btn-lg" name="submitCustomer" type="submit">حفظ</button>
                        <button class="w-45 btn btn-primary btn-lg" name="submitCustomerWithWorkReq" type="submit">حفظ و اضافه اذن عمل</button>

                        <hr class="my-4">

                    </form>
                </div>
            </div>
        </main>
    </div>

<?php require_once 'includes/templates/footer.php';
    ob_end_flush();
} else {
    header("Refresh:0;url=logIn.php");
}
?>