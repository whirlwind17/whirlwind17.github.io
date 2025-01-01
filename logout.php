<?php
session_start();
session_destroy(); // 銷毀 Session
header("Location: index.php"); // 重定向到首頁
?>