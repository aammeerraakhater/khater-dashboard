<?php
ob_start();
session_start();
require "init.php";
session_unset();
session_destroy();
header("location:LogIn.php");
exit();
ob_end_flush();
