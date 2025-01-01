<?php
session_start(); // 啟動 Session
include 'db.php';

$page_title = "線上點餐大網站";
ob_start();
?>

<h2>菜單</h2>
<div class="menu-container">
    <?php
    $stmt = $pdo->query("SELECT * FROM menu_items");
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='menu-item'>";
            echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
            echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
            echo "<p>價格: $" . htmlspecialchars($row['price']) . "</p>";
            if (isset($_SESSION['user_id'])) {
                echo "<form action='add_to_cart.php' method='POST' class='add-to-cart-form'>";
                echo "<input type='hidden' name='menu_item_id' value='" . $row['id'] . "'>";
                echo "<label for='quantity'>數量:</label>";
                echo "<input type='number' id='quantity' name='quantity' value='1' min='1'>";
                echo "<button type='submit'>加入購物車</button>";
                echo "</form>";
            }
            echo "</div>";
        }
    } else {
        echo "<p>目前沒有餐點。</p>";
    }
    ?>
</div>

<!-- 浮動購物車圖示 -->
<div id="cart-icon" onclick="toggleCart()">🛒</div>

<!-- 購物車彈出視窗 -->
<div id="cart-popup" class="cart-popup">
    <h3>購物車</h3>
    <div id="cart-content">
        <!-- 購物車內容會動態載入 -->
    </div>
    <button onclick="checkout()">結帳</button>
</div>

<?php if (!isset($_SESSION['user_id'])): ?>
    <p>請先<a href="login.php">登入</a>以進行點餐。</p>
<?php endif; ?>

<?php
$page_content = ob_get_clean();
include 'layout.php';
?>