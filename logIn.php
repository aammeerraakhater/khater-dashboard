<?php
ob_start();
session_start();
$css = "logIn.css";
$title = "تسجيل الدخول";
include 'init.php';
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST["password"]);
    $hashpass = sha1($password);
    $table = 'workers';
    checkUser($table, $email, $hashpass);
}
?>
<div class="container">
    <div class="containerimg">
    </div>
    <div class="formcontainer">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="form-group ">
                <label for="exampleInputEmail1">الايميل</label>
                <input required type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">برجاء ادخال الايميل</small>
            </div>

            <div class="form-group ">
                <label for="exampleInputEmail2">الباسورد</label>
                <input required type="password" name="password" class="form-control" id="exampleInputEmail2">
                <small id="emailHelp" class="form-text text-muted">برجاء ادخال الباسورد</small>
            </div>

            <button class="btn btn-primary btn-block btn-submit">تسجيل الدخول </button>
        </form>

    </div>
</div>

<?php
include "includes/templates/footer.php";
ob_end_flush();
