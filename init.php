<?php
date_default_timezone_set('Africa/Cairo');
$path = "includes/templates/";
$cssPath = "layout/css/";
$jsPath = "layout/js/";

include "connect_db.php";
include "functions.php";
include $path . "header.php";
$delegants = array('الحاج أحمد خاطر', 'هلال', 'مصطفى', 'محمد مرسي', 'حسام', 'وهبه', 'الحاج محمد', 'أمنية', 'اخرى');
$technicians = array('غريب', 'اسلام', 'توفيق', 'خليفه', 'محمد عزب', 'رأفت', 'ايمن', 'نشأت', 'مصطفى', 'توفيق', 'اخرى');
$serviceStatuses = array('عمل اليوم', 'شكوى', 'تأجيل', 'تم', 'مطلوب', 'بالورشة', 'استكمال', 'ضروري', 'الغاء');
