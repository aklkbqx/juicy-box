<?php
session_start();
require_once __DIR__ . "/../lib/util.php";
$user_id = isset($_SESSION["user_login"]) ? $_SESSION["user_login"] : (isset($_SESSION["admin_login"]) ? header("location: ../") : header("location: ./login.php"));
if ($user_id) {
    $row = sql("SELECT * FROM `users` WHERE `user_id` = ?", [$user_id])->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการโปรไฟล์ | Account Setting</title>
    <?php require_once __DIR__ . "/../lib/link.php"; ?>
</head>

<body class="bg-light">
    <?php require_once __DIR__ . "/../components/navbar.php"; ?>

    <div class="w-100 d-flex justify-content-center" style="margin-bottom: 3rem;margin-top: 7.2rem;">
        <div class="border bg-white rounded-5 shadow-sm p-4" style="width:1200px;">
            <div class="d-flex justify-content-start">
                <a href="javascript:window.history.back()" class="d-flex align-items-center text-primary" style="gap:10px">
                    <i class="fa-solid fa-left-long"></i>
                    <h5>กลับ</h5>
                </a>
            </div>
            <?php require_once "../components/manage_account.php" ?>
        </div>
    </div>
    
</body>

</html>