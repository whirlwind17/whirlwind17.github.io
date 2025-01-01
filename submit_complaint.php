<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id']; // 從 Session 中獲取 user_id
$complaint_text = filter_input(INPUT_POST, 'complaint_text', FILTER_SANITIZE_STRING);
$complaint_type = filter_input(INPUT_POST, 'complaint_type', FILTER_SANITIZE_STRING);
$rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);

if (!$user_id || !$complaint_text || !$complaint_type || !$rating) {
    echo "請填寫所有必填欄位";
    exit;
}

$stmt = $pdo->prepare("INSERT INTO complaints (user_id, complaint_text, complaint_type, rating) VALUES (?, ?, ?, ?)");
$stmt->execute([$user_id, $complaint_text, $complaint_type, $rating]);

header("Location: complaints.php"); // 提交後重定向到抱怨頁面
?>