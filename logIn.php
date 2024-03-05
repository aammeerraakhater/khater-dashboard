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
        <?php if (isset($_SESSION['msg'])) { ?>
            <div style="color:red;"><?php echo $_SESSION['msg']; ?></div><?php } ?>
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="form-group ">
                <label for="exampleInputEmail1">الايميل</label>
                <input required type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div clas="form-group my-2">
                <label class="m-2" for="exampleInputEmail1">الباسورد</label>
                <div class="input-group">
                    <input type="password" name="password" id="r2PasswordNewUser" size="40" maxlength="40" class="form-control" required autofocus />
                    <span class="input-group-text">
                        <span data-target="#r2PasswordNewUser" class="pw-toggle2 material-icons">visibility</span>
                    </span>
                </div>
            </div>
            <button class="btn btn-primary btn-block btn-submit my-4">تسجيل الدخول </button>
        </form>

    </div>
</div>

<?php
include "includes/templates/footer.php";
ob_end_flush();
