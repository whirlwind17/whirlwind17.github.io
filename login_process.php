<?php
include 'db.php';

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if (!$username || !$password) {
    echo "請填寫所有必填欄位";
    exit;
}

// 查詢用戶
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password'])) {
    echo "用戶名或密碼錯誤";
    exit;
}

// 登入成功，設置 Session
session_start();
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];

header("Location: index.php"); // 登入成功後重定向到首頁
?>