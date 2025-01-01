<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menu_item_id = $_POST['menu_item_id'];
    $quantity = $_POST['quantity'];

    // 檢查購物車中是否已經有該商品
    $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND menu_item_id = ?");
    $stmt->execute([$_SESSION['user_id'], $menu_item_id]);
    $existing_item = $stmt->fetch();

    if ($existing_item) {
        // 如果已經有該商品，更新數量
        $new_quantity = $existing_item['quantity'] + $quantity;
        $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $stmt->execute([$new_quantity, $existing_item['id']]);
    } else {
        // 如果沒有該商品，新增到購物車
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, menu_item_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $menu_item_id, $quantity]);
    }

    header("Location: orders.php");
    exit();
}
?>