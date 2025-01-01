<?php
include 'db.php';

$page_title = "登入";
ob_start();
?>

<h2>登入</h2>
<form action="login_process.php" method="POST" class="form-container">
    <label for="username">用戶名</label>
    <input type="text" id="username" name="username" required>

    <label for="password">密碼</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">登入</button>
</form>
<p>還沒有帳號？<a href="register.php">註冊</a></p>

<?php
$page_content = ob_get_clean();
include 'layout.php';
?>