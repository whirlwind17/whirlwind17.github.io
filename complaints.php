<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';

$page_title = "線上抱怨網站";
ob_start();
?>

<h2>抱怨列表</h2>
<div class="complaint-container">
    <?php
    // 查詢抱怨並關聯用戶名稱
    $stmt = $pdo->query("
        SELECT complaints.*, users.username 
        FROM complaints 
        JOIN users ON complaints.user_id = users.id
    ");
    $complaints = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($complaints) > 0) {
        foreach ($complaints as $complaint):
    ?>
        <div class="complaint">
            <p><strong>用戶:</strong> <?php echo htmlspecialchars($complaint['username']); ?></p>
            <p><strong>抱怨內容:</strong> <?php echo htmlspecialchars($complaint['complaint_text']); ?></p>
            <p><strong>類型:</strong> <?php echo htmlspecialchars($complaint['complaint_type']); ?></p>
            <p><strong>評分:</strong> <?php echo htmlspecialchars($complaint['rating']); ?></p>
        </div>
    <?php
        endforeach;
    } else {
        echo "<p>目前沒有抱怨。</p>";
    }
    ?>
</div>

<?php if (isset($_SESSION['user_id'])): ?>
    <h3>新增抱怨</h3>
    <form action="submit_complaint.php" method="POST" class="form-container">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <label for="complaint_text">抱怨內容</label>
        <textarea id="complaint_text" name="complaint_text" required></textarea>
        <label for="complaint_type">抱怨類型</label>
        <input type="text" id="complaint_type" name="complaint_type" required>
        <label for="rating">評分</label>
        <input type="number" id="rating" name="rating" min="1" max="10" required>
        <button type="submit">提交抱怨</button>
    </form>
<?php else: ?>
    <p>請先<a href="login.php">登入</a>以提交抱怨。</p>
<?php endif; ?>

<?php
$page_content = ob_get_clean();
include 'layout.php';
?>