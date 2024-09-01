<?php
session_start();
require_once __DIR__ . "/../lib/util.php";
$user_id = isset($_SESSION["user_login"]) ? $_SESSION["user_login"] : null;

if (isset($_GET["addToCart"]) && isset($_GET["product_id"]) && isset($_GET["amount"]) && isset($_GET["drink_type"])) {
    $product_id = $_GET["product_id"];
    $amount = $_GET["amount"];
    $drink_type = $_GET["drink_type"];

    if (!$user_id) {
        msg("กรุณาทำการเข้าสู่ระบบก่อน", 'danger', "../pages/login.php");
    }

    $products = sql("SELECT * FROM `products` WHERE `product_id` = ?", [$product_id])->fetch(PDO::FETCH_ASSOC);
    $carts = sql("SELECT * FROM `carts` WHERE `product_id` = ? AND `drink_type` = ? AND `user_id` = ?", [$product_id, $drink_type, $user_id]);

    if ($carts->rowCount() > 0) {
        $cart = $carts->fetch(PDO::FETCH_ASSOC);
        $updateAmount = sql("UPDATE `carts` SET `amount` = ? WHERE `product_id` = ? AND `drink_type` = ? AND `user_id` = ?", [
            $cart["amount"] + $amount,
            $product_id,
            $drink_type,
            $user_id
        ]);
    } else {
        $insert = sql("INSERT INTO `carts`(`product_id`, `amount`, `drink_type`, `user_id`) VALUES(?, ?, ?, ?)", [
            $product_id,
            $amount,
            $drink_type,
            $user_id
        ]);
    }

    header("Location: ../pages/cart.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["deleteItemOnCart"])) {
    $cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
    $carts = sql("DELETE FROM `carts` WHERE `cart_id` = ? AND `user_id` = ?", [$cart_id, $user_id]);
    if (!$user_id) {
        echo json_encode(['success' => false, 'message' => 'กรุณาทำการเข้าสู่ระบบก่อน']);
        exit;
    }
    echo json_encode(['success' => true, 'message' => 'ลบสินค้าในตะกร้าของคุณแล้ว']);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET["updateAmount"])) {
    $cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
    $amount = isset($_POST['amount']) ? intval($_POST['amount']) : 0;
    if (!$user_id) {
        echo json_encode(['status' => 'error', 'message' => 'กรุณาทำการเข้าสู่ระบบก่อน']);
        exit;
    }
    $updateAmount = sql("UPDATE `carts` SET `amount` = ? WHERE `cart_id` = ? AND `user_id` = ?", [
        $amount,
        $cart_id,
        $user_id
    ]);
    echo json_encode(['status' => 'success', 'message' => 'อัปเดตตะกร้าเรียบร้อย']);
}
