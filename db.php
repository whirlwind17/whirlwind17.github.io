<?php
$host = getenv('DB_HOST') ?: 'localhost'; // 資料庫主機
$db = getenv('DB_NAME') ?: 'game_db'; // 資料庫名稱
$user = getenv('DB_USER') ?: 'root'; // 使用者名稱
$pass = getenv('DB_PASS') ?: ''; // 密碼

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    echo "Connection failed. Please try again later.";
}
?>
