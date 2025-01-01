<?php
session_start(); // 啟動 Session
include 'db.php';

$page_title = "海洋遊戲推薦網站";
ob_start();
?>

<h2>海洋遊戲列表</h2>
<div class="game-container">
    <?php
    $stmt = $pdo->query("SELECT * FROM ocean_games");
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='ocean-game'>";
            if (!empty($row['cover_image'])) {
                echo "<img src='" . htmlspecialchars($row['cover_image']) . "' alt='" . htmlspecialchars($row['title']) . "'>";
            }
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
            echo "<p>評分: " . htmlspecialchars($row['rating']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>目前沒有海洋遊戲。</p>";
    }
    ?>
</div>

<?php
$page_content = ob_get_clean();
include 'layout.php';
?>