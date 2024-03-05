<?php
date_default_timezone_set('Africa/Cairo');
$path = "includes/templates/";
$cssPath = "layout/css/";
$jsPath = "layout/js/";

include "connect_db.php";
include "functions.php";
include $path . "header.php";

$delegants = getBased('workers', 'isAdmin', 0, 'workerID');
$technicians = getBased('workers', 'isAdmin', 3, 'workerID');
$serviceStatuses = array('عمل اليوم', 'شكوى', 'تأجيل', 'تم', 'مطلوب', 'بالورشة', 'استكمال', 'ضروري', 'الغاء');
$cities = array('بنها', 'طوخ', 'أخرى');
$serviceTypes = array(' تركيب تكييف', 'صيانه تكييف', ' تركيب فلتر', 'صيانه فلتر', '  مراتب', 'أخرى');
$customerTypes = array('تكييف', 'فلاتر', 'مراتب');
$orderStatuses = array('تسعير', 'طلب', 'تم', 'الغاء', 'تواصل مع العميل');
