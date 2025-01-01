<?php
session_start();
include 'db.php';

$games_id = filter_input(INPUT_POST, 'games_id', FILTER_SANITIZE_NUMBER_INT);
$user_id = $_SESSION['user_id']; // 從 Session 中獲取 user_id
$review_text = filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_STRING);
$review_rating = filter_input(INPUT_POST, 'review_rating', FILTER_SANITIZE_NUMBER_INT);

if (!$games_id || !$user_id || !$review_text || !$review_rating) {
    echo "請填寫所有必填欄位";
    exit;
}

$stmt = $pdo->prepare("INSERT INTO review (games_id, user_id, review_text, review_rating) VALUES (?, ?, ?, ?)");
$stmt->execute([$games_id, $user_id, $review_text, $review_rating]);

header("Location: games.php?id=" . $games_id);
?>