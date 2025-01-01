<?php
include 'db.php';

$page_title = "註冊";
ob_start();
?>

<h2>註冊</h2>
<form action="register_process.php" method="POST" class="form-container">
    <label for="username">用戶名</label>
    <input type="text" id="username" name="username" required>

    <label for="email">電子郵件</label>
    <input type="email" id="email" name="email" required>

    <label for="password">密碼</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">註冊</button>
</form>
<p>已經有帳號？<a href="login.php">登入</a></p>

<?php
$page_content = ob_get_clean();
include 'layout.php';
?>