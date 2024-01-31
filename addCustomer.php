<?php
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

<?php require_once 'includes/templates/footer.php'; ?>