-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-12-31 03:30:26
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `game_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `anime`
--

CREATE TABLE `anime` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `anime`
--

INSERT INTO `anime` (`id`, `title`, `genre`, `description`, `cover_image`, `rating`) VALUES
(1, 'BLEACH 死神 千年血戰篇-相剋譚- ', '動作,冒險\r\n', '關三界存亡的戰爭，流下的究竟是血還是淚？ 得到新力量的一護再次挑戰優哈巴哈，卻被雨龍妨礙。戰鬥舞台轉移到不可侵犯的神域「靈王宮」，靈王的專屬護衛「第零隊」迎戰入侵者，真正的戰鬥和絕望現在才剛要開始。死神與滅卻師、一護與雨龍、信念與決心，無法同時存在的光與影，在深藍色的天空中相剋。', 'https://p2.bahamut.com.tw/B/ACG/c/62/0000135862.JPG', 5),
(2, '寶石之國', '奇幻,科幻', '由 市川春子所著的漫畫為原著，動畫《寶石之國》故事以遙遠的未來為舞台，地上的生物沉入了海底，被微生物吃掉成為無機物體。由於長時間的結晶變成寶石生命體的存在。擁有寶石身體的 28 人，與襲擊他們打算將其作為裝飾品的月人展開了一場又一場的戰鬥。', 'https://p2.bahamut.com.tw/B/ACG/c/78/0000088978.JPG', 5);

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `complaint_text` text NOT NULL,
  `complaint_type` varchar(50) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `complaints`
--

INSERT INTO `complaints` (`id`, `user_id`, `complaint_text`, `complaint_type`, `rating`) VALUES
(1, 1, 'r', 'www', 5);

-- --------------------------------------------------------

--
-- 資料表結構 `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `genre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `title_image` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `videos` varchar(255) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `games`
--

INSERT INTO `games` (`id`, `title`, `genre`, `description`, `cover_image`, `title_image`, `images`, `videos`, `rating`) VALUES
(1, 'Minecraft', 'Survive', 'Minecraft 是什麼類型的遊戲？\r\nMinecraft 是一款開放世界沙盒電玩遊戲。作為沙盒電玩遊戲，Minecraft 有著無限的可能性！您可以專心發揮創意，使用方塊來建造東西，或者四處探索並努力活過夜晚。', 'https://upload.wikimedia.org/wikipedia/zh/5/51/Minecraft_cover.png', 'https://i.imgur.com/h7AspDX.jpeg', '', '', 5),
(2, 'Apex', 'Battle_royale', 'Thank u EA', 'https://i.imgur.com/DwB7LCK.jpeg', 'https://i.imgur.com/DwB7LCK.jpeg', '', '', 4.5),
(3, 'Street Fighter 6', 'Fighting', 'Sakura need to come back.', 'https://i.imgur.com/O4bu4PT.jpeg', 'https://i.imgur.com/O4bu4PT.jpeg', '', '', 4.8),
(4, 'Dark and Darker', 'ARPG', 'It\'s time to go to Dungeon.', 'https://i.imgur.com/wMgmFsK.jpeg', 'https://i.imgur.com/wMgmFsK.jpeg', '', '', 4.7),
(5, 'Monster Hunter Wilds', 'ARPG', 'It\'s time to kill some dragons.', 'https://i.imgur.com/Jz6ELnj.jpeg', 'https://i.imgur.com/Jz6ELnj.jpeg', '', '', 4.8),
(6, 'Undertale', 'RPG', 'Determination.', 'https://imgur.com/AXeDPkT', 'https://imgur.com/AXeDPkT', '', '', 4.7),
(7, 'The Last Guardian', 'Action-Adventure', 'Epic.', 'https://assetsio.gnwcdn.com/co271e.jpg?width=1200&height=1200&fit=bounds&quality=70&format=jpg&auto=webp', 'https://i.imgur.com/SyLrI8Z.jpeg', '', '', 4.9),
(19, 'TEST', 'Action-Adventure', 'Epic.', 'https://assetsio.gnwcdn.com/co271e.jpg?width=1200&height=1200&fit=bounds&quality=70&format=jpg&auto=webp', 'https://i.imgur.com/n8Txdrs.png', '', '', 4.9),
(20, 'ok', 'RPG', 'WTF', 'uploads/02.png', '', '', '', 3),
(21, 's', 's', 's', 'uploads/158377107_4492332330795331_1959341246228610022_n.jpg', '', '', '', 2);

-- --------------------------------------------------------

--
-- 資料表結構 `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `category`, `description`, `price`, `image`) VALUES
(1, '薯條', '炸物', '薯條', 55.00, NULL),
(2, '香雞堡', '漢堡', '香雞堡', 45.00, NULL),
(3, '卡拉雞腿堡', '漢堡', '卡拉雞腿堡', 70.00, NULL),
(4, '可樂', '飲料', '可樂', 40.00, NULL),
(5, '檸檬紅茶', '飲料', '檸檬紅茶', 25.00, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `ocean_games`
--

CREATE TABLE `ocean_games` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `order_date`) VALUES
(1, 1, 440.00, '2024-12-30 23:35:28'),
(2, 1, 485.00, '2024-12-30 23:58:25'),
(3, 1, 0.00, '2024-12-31 00:15:45'),
(4, 1, 45.00, '2024-12-31 00:15:49');

-- --------------------------------------------------------

--
-- 資料表結構 `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_item_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 55.00),
(2, 1, 1, 1, 55.00),
(3, 1, 1, 3, 55.00),
(4, 1, 1, 1, 55.00),
(5, 1, 1, 1, 55.00),
(6, 1, 1, 1, 55.00),
(7, 2, 5, 15, 70.00),
(8, 2, 4, 1, 70.00),
(9, 2, 3, 1, 70.00),
(10, 4, 2, 1, 45.00);

-- --------------------------------------------------------

--
-- 資料表結構 `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `games_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `review_rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'C111181117', 'C111181117@nkust.edu.tw', '$2y$10$R7RxHFhoJa62gzFy2A7oD.G0aV8Slmw7vHwbvt72I24MeaNE4zVH.', '2024-12-30 01:25:54');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_ibfk_user` (`user_id`),
  ADD KEY `cart_ibfk_menu_item` (`menu_item_id`);

--
-- 資料表索引 `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaints_ibfk_user` (`user_id`);

--
-- 資料表索引 `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `ocean_games`
--
ALTER TABLE `ocean_games`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ibfk_user` (`user_id`);

--
-- 資料表索引 `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_ibfk_order` (`order_id`),
  ADD KEY `order_items_ibfk_menu_item` (`menu_item_id`);

--
-- 資料表索引 `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `games_id` (`games_id`),
  ADD KEY `review_ibfk_user` (`user_id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `anime`
--
ALTER TABLE `anime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ocean_games`
--
ALTER TABLE `ocean_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_menu_item` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`),
  ADD CONSTRAINT `cart_ibfk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- 資料表的限制式 `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- 資料表的限制式 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- 資料表的限制式 `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_menu_item` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`),
  ADD CONSTRAINT `order_items_ibfk_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- 資料表的限制式 `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`games_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `review_ibfk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
