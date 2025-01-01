<?php
session_start(); // 啟動 Session
include 'db.php';

$page_title = "動漫推薦網站";
ob_start(); // 開始緩衝輸出
?>

<h2>動漫列表</h2>
<div class="game-container">
    <?php
    $stmt = $pdo->query("SELECT * FROM anime");
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='anime'>";
            if (!empty($row['cover_image'])) {
                echo "<img src='" . htmlspecialchars($row['cover_image']) . "' alt='" . htmlspecialchars($row['title']) . "'>";
            }
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
            echo "<p>評分: " . htmlspecialchars($row['rating']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>目前沒有動漫。</p>";
    }
    ?>
</div>

<?php
$page_content = ob_get_clean(); // 獲取緩衝內容並清空緩衝
include 'layout.php'; // 引入 Layout
?>