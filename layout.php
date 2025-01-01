<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $page_title; ?></title>
</head>
<body>
    <header>
        <span class="menu-icon" onclick="openNav()">☰ Menu</span>
        <h1><?php echo $page_title; ?></h1>
        <?php if (isset($_SESSION['username'])): ?>
            <div class="user-info">
                歡迎，<?php echo htmlspecialchars($_SESSION['username']); ?>！
            </div>
        <?php endif; ?>
    </header>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="index.php">首頁</a>
        <a href="complaints.php">線上抱怨網站</a>
        <a href="anime.php">動漫推薦網站</a>
        <a href="orders.php">線上點餐大網站</a>
        <a href="ocean_games.php">海洋遊戲推薦網站</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="logout.php">登出</a>
        <?php else: ?>
            <a href="login.php">登入</a>
            <a href="register.php">註冊</a>
        <?php endif; ?>
    </div>

    <main id="main">
        <?php echo $page_content; ?>
    </main>

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

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>

    <!-- 引入 cart.js -->
    <script src="js/cart.js"></script>
</body>
</html>