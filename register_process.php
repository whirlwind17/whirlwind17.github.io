<?php
include 'db.php';

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if (!$username || !$email || !$password) {
    echo "請填寫所有必填欄位";
    exit;
}

// 檢查用戶名或電子郵件是否已存在
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->execute([$username, $email]);
if ($stmt->rowCount() > 0) {
    echo "用戶名或電子郵件已被使用";
    exit;
}

// 加密密碼
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// 插入新用戶
$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $hashed_password]);

header("Location: login.php"); // 註冊成功後重定向到登入頁面
?>