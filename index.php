<?php
session_start(); // 啟動 Session
include 'db.php';

$page_title = "遊戲推薦網站";
ob_start();
?>

<h2>遊戲:</h2>
<?php if (isset($_SESSION['username'])): ?>
    <p>歡迎回來，<?php echo htmlspecialchars($_SESSION['username']); ?>！</p>
<?php endif; ?>
<div class="game-container">
    <?php
    $stmt = $pdo->query("SELECT * FROM games");
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='game'>";
            if (!empty($row['title_image'])) {
                echo "<a href='games.php?id=" . $row['id'] . "'><img src='" . htmlspecialchars($row["title_image"]) . "' alt='title Image'></a>";
            }
            echo "<div class='game-title'>" . htmlspecialchars($row['title']) . "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>目前沒有遊戲。</p>";
    }
    ?>
</div>

<?php
$page_content = ob_get_clean();
include 'layout.php';
?>