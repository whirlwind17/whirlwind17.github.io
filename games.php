<?php
session_start(); // 啟動 Session
include 'db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
$stmt->execute([$id]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$game) {
    echo "Game not found.";
    exit;
}

$images = json_decode($game['images'], true);
$videos = json_decode($game['videos'], true);

function resizeImage($file, $max_width, $max_height) {
    list($width, $height, $type) = getimagesize($file);
    $src = null;
    switch ($type) {
        case IMAGETYPE_JPEG:
            $src = imagecreatefromjpeg($file);
            break;
        case IMAGETYPE_PNG:
            $src = imagecreatefrompng($file);
            break;
        case IMAGETYPE_GIF:
            $src = imagecreatefromgif($file);
            break;
        default:
            return $file;
    }

    if ($width > $max_width || $height > $max_height) {
        $ratio = min($max_width / $width, $max_height / $height);
        $new_width = $width * $ratio;
        $new_height = $height * $ratio;

        $dst = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        $new_file = 'resized_' . basename($file);
        switch ($type) {
            case IMAGETYPE_JPEG:
                imagejpeg($dst, $new_file);
                break;
            case IMAGETYPE_PNG:
                imagepng($dst, $new_file);
                break;
            case IMAGETYPE_GIF:
                imagegif($dst, $new_file);
                break;
        }

        imagedestroy($src);
        imagedestroy($dst);

        return $new_file;
    }
    return $file;
}

if (!empty($game['title_image'])) {
    $game['title_image'] = resizeImage($game['title_image'], 980, 540);
}

// Fetch reviews
$review_stmt = $pdo->prepare("SELECT * FROM review WHERE games_id = ?");
$review_stmt->execute([$id]);
$reviews = $review_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo htmlspecialchars($game['title']); ?></title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .container p {
            text-align: left;
        }
    </style>
</head>
<body>
    <header>
        <span class="menu-icon" onclick="openNav()">☰ Menu</span>
        <?php
        echo "<h1 class='header-title'>" . htmlspecialchars($game['title']) . "</h1>";
        ?>
    </header>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="index.php">Home</a>
    </div>

    <main id="main" class="container">
        <img src="<?php echo htmlspecialchars($game['title_image']); ?>" alt="<?php echo htmlspecialchars($game['title']); ?>" style="max-width: 1920px; max-height: 1080px;">
        <p><?php echo htmlspecialchars($game['description']); ?></p>
        <p>評分: <?php echo htmlspecialchars($game['rating']); ?></p>

        <?php if (!empty($images)): ?>
            <h3>遊戲圖片</h3>
            <?php foreach ($images as $image): ?>
                <img src="<?php echo htmlspecialchars($image); ?>" alt="Game Image" style="max-width: 100%; height: auto;">
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($videos)): ?>
            <h3>遊戲影片</h3>
            <?php foreach ($videos as $video): ?>
                <iframe width="560" height="315" src="<?php echo htmlspecialchars($video); ?>" frameborder="0" allowfullscreen></iframe>
            <?php endforeach; ?>
        <?php endif; ?>
        <h3>評論</h3>
        <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $review): ?>
                <div class="review">
                    <p><?php echo htmlspecialchars($review['review_text']); ?></p>
                    <p>評分: <?php echo htmlspecialchars($review['review_rating']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>目前沒有評論。</p>
        <?php endif; ?>

        <h3>新增評論</h3>
        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="submit_review.php" method="POST" class="form-container">
                <input type="hidden" name="games_id" value="<?php echo $id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <label for="review_text">評論內容</label>
                <textarea id="review_text" name="review_text" required></textarea>
                <label for="review_rating">評分</label>
                <input type="number" id="review_rating" name="review_rating" min="1" max="10" required>
                <button type="submit">提交評論</button>
         </form>
        <?php else: ?>
            <p>請先<a href="login.php">登入</a>以提交評論。</p>
        <?php endif; ?>
    </main>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
</body>
</html>