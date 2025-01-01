<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_amount = 0;
foreach ($cart_items as $item) {
    $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE id = ?");
    $stmt->execute([$item['menu_item_id']]);
    $menu_item = $stmt->fetch(PDO::FETCH_ASSOC);

    $total_amount += $menu_item['price'] * $item['quantity'];
}

$stmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount) VALUES (?, ?)");
$stmt->execute([$_SESSION['user_id'], $total_amount]);

$order_id = $pdo->lastInsertId();

foreach ($cart_items as $item) {
    $stmt = $pdo->prepare("INSERT INTO order_items (order_id, menu_item_id, quantity, price) VALUES (?, ?, ?, ?)");
    $stmt->execute([$order_id, $item['menu_item_id'], $item['quantity'], $menu_item['price']]);
}

$stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);

header("Location: orders.php");
exit();
?>