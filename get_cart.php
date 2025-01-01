<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "請先登入。";
    exit();
}

$stmt = $pdo->prepare("SELECT cart.*, menu_items.name, menu_items.price FROM cart JOIN menu_items ON cart.menu_item_id = menu_items.id WHERE cart.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$cart_items = $stmt->fetchAll();

if (count($cart_items) > 0) {
    foreach ($cart_items as $item) {
        echo "<div class='cart-item'>";
        echo "<p>" . htmlspecialchars($item['name']) . " x " . htmlspecialchars($item['quantity']) . "</p>";
        echo "<p>價格: $" . htmlspecialchars($item['price'] * $item['quantity']) . "</p>";
        echo "<form action='remove_from_cart.php' method='POST'>";
        echo "<input type='hidden' name='cart_item_id' value='" . $item['id'] . "'>";
        echo "<button type='submit'>移除</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "<p>購物車是空的。</p>";
}
?>