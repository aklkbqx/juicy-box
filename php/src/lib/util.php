<?php
// $servername = "sql110.infinityfree.com";
// $username = "if0_37143452";
// $password = "sA0PqsKsBz";
// $database = "if0_37143452_juicybox_db";
// $port = "9906";
$servername = "mysql-juicybox";
$username = "username";
$password = "password";
$database = "juicybox_db";
$port = "9906";

require_once $_SERVER['DOCUMENT_ROOT'] . "/config-function/database.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/config-function/function.php";

$webname = "JUICY BOX";

$bannerTitle = [
    "ยินดีต้อนรับสู่",
    "JUICYBOX",
    "สั่งชาหรือกาแฟออนไลน์",
    "<a href='#orderProducts' class='btn btn-light rounded-4 fs-3'>
        สั่งซื้อเลย! <i class='fa-solid fa-mug-hot text-primary'></i>
    </a>"
];

$imageBanner = [
    pathImage("banner1.jpg", "banner"),
    pathImage("banner2.jpg", "banner"),
    pathImage("banner3.jpg", "banner")
];

$email_var = "example@email.com";
$address_var = "193 ถนน มาตุลี ตำบลปากน้ำโพ อำเภอเมืองนครสวรรค์ นครสวรรค์ 60000";
$copyright_text_var = "© 2024 - All Rights Reserved";


$linkContact = [
    [
        "label" => "Facebook",
        "icon" => '<i class="fa-brands fa-facebook"></i>',
        "link" => "https://web.facebook.com/facebook/"
    ],
    [
        "label" => "Instagram",
        "icon" => '<i class="fa-brands fa-square-instagram"></i>',
        "link" => "https://www.instagram.com/instagram"
    ],
    [
        "label" => "Line",
        "icon" => '<i class="fa-brands fa-line"></i>',
        "link" => "https://line.me/th/"
    ],
    [
        "label" => "เบอร์โทรศัพท์",
        "icon" => '<i class="fa-solid fa-phone"></i>',
        "link" => "#"
    ],
];
