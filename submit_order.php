<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id']; // 從 Session 中獲取 user_id
$order_details = filter_input(INPUT_POST, 'order_details', FILTER_SANITIZE_STRING);

if (!$user_id || !$order_details) {
    echo "請填寫所有必填欄位";
    exit;
}

$order_date = date('Y-m-d H:i:s'); // 獲取當前時間

$stmt = $pdo->prepare("INSERT INTO orders (user_id, order_details, order_date) VALUES (?, ?, ?)");
$stmt->execute([$user_id, $order_details, $order_date]);

header("Location: orders.php"); // 提交後重定向到訂單頁面
?>