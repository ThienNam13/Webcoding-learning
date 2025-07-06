-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2025 at 02:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orderingfooddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `ten_mon` varchar(100) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `gia` decimal(10,2) NOT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `loai` varchar(50) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `ten_mon`, `mo_ta`, `gia`, `hinh_anh`, `loai`, `is_available`) VALUES
(1, 'Combo cô đơn', '1 gà rán + 1 mì ý hoặc 1 hamburger + 1 nước', 79000.00, 'assets/img/food/combo_co_don.png', 'Combo', 1),
(2, 'Gà x2', '2 miếng gà rán giòn tan, đậm vị truyền thống', 65000.00, 'assets/img/food/ga_x2.png', 'Gà rán', 1),
(3, 'Mì Ý sốt bò bằm', 'Mì Ý sợi mềm, phủ sốt bò bằm đậm đà', 35000.00, 'assets/img/food/my_y.png', 'Burger - Cơm - Mì ý', 1),
(4, 'Hamburger gà chiên', 'Bánh mì kẹp gà giòn, rau và sốt đặc trưng', 35000.00, 'assets/img/food/hamburger.png', 'Burger - Cơm - Mì ý', 1),
(5, 'Trà đào kem cheese', 'Trà đào mát lạnh, phủ kem cheese béo mịn', 30000.00, 'assets/img/food/tra_dao_cheese.png', 'Tráng miệng', 1),
(6, 'Combo cặp đôi', '2 gà rán + 1 mì ý + 1 hamburger + khoai + 2 nước', 129000.00, 'assets/img/food/combo_cap_doi.png', 'Combo', 1),
(7, 'Combo gia đình', '3 gà rán + 2 mì ý + 1 hamburger + 2 khoai + 3 nước', 179000.00, 'assets/img/food/combo_gia_dinh.png', 'Combo', 1),
(8, 'Combo tiệc vui', '5 gà rán + 3 mì ý + 2 hamburger + 3 khoai + 5 nước', 279000.00, 'assets/img/food/combo_tiec_vui.png', 'Combo', 1),
(9, 'Matcha Latte Kem Sữa', 'Matcha đậm vị, thêm lớp kem sữa béo mịn phía trên', 32000.00, 'assets/img/food/matcha_latte.png', 'Món mới', 1),
(10, 'Khoai lắc phô mai', 'Khoai tây chiên giòn rắc phô mai thơm lừng', 19000.00, 'assets/img/food/khoai_lac.png', 'Khuyến mãi', 1),
(11, 'Gà popcorn', 'Miếng gà nhỏ giòn rụm, ăn vặt siêu cuốn', 27000.00, 'assets/img/food/ga_popcorn.png', 'Khuyến mãi', 1),
(12, 'Pepsi không caloo', 'Pepsi không đường, không calo, mát lạnh sảng khoái', 12000.00, 'assets/img/food/pepsi_zero.png', 'Tráng miệng', 1),
(13, 'Trà sữa trân châu đường đen', 'Trà sữa hương vị truyền thống cùng những hạt trân châu ngọt ngào', 20000.00, 'images/pepsi_zero.jpg', 'Món mới', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `ma_don` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `dia_chi` text NOT NULL,
  `phuong_xa` varchar(100) DEFAULT NULL,
  `khu_vuc` varchar(100) NOT NULL,
  `tong_tien` decimal(10,2) NOT NULL,
  `thoi_gian_dat` datetime DEFAULT current_timestamp(),
  `trang_thai` varchar(50) DEFAULT 'Đang xử lý',
  `ghi_chu` text DEFAULT NULL,
  `hinh_thuc_thanh_toan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ma_don`, `user_id`, `ho_ten`, `sdt`, `dia_chi`, `phuong_xa`, `khu_vuc`, `tong_tien`, `thoi_gian_dat`, `trang_thai`, `ghi_chu`, `hinh_thuc_thanh_toan`) VALUES
(35, 'ODF0035', NULL, 'NAM', '0381902800', 'hiiiiiiiiiiiiiii', NULL, 'TP Hồ Chí Minh', 42000.00, '2025-07-03 14:37:10', 'Đang xử lý', '', 'bank'),
(36, 'ODF0036', NULL, 'Linh', '88888888888', 'kkk', NULL, 'TP Hồ Chí Minh', 34000.00, '2025-07-03 14:38:33', 'Đang xử lý', '', 'bank'),
(37, 'ODF0037', 1, 'NAMmmm', '763', 'd', NULL, 'TP Hồ Chí Minh', 42000.00, '2025-07-03 14:46:18', 'Đang xử lý', '', 'cod'),
(38, 'ODF0038', 1, 'Nam Nguyễn Thiên', '0388190280', 'd', NULL, 'TP Hồ Chí Minh', 42000.00, '2025-07-03 14:46:41', 'Đang xử lý', '', 'cod'),
(39, 'ODF0039', 1, 'TEST', '09', 'hj', NULL, 'TP Hồ Chí Minh', 53000.00, '2025-07-03 14:48:43', 'Đang xử lý', '', 'bank'),
(40, 'ODF0040', 1, 'k biet', '00', 'k biet', NULL, 'TP Hồ Chí Minh', 82000.00, '2025-07-04 00:34:11', 'Đã hủy', '', 'bank'),
(41, 'ODF0041', NULL, 'Nam Nguyễn Thiên', '0388190280', 'k biet', NULL, 'TP Hồ Chí Minh', 393000.00, '2025-07-04 13:31:29', 'Đang xử lý', '', 'cod'),
(42, 'ODF0042', NULL, 'hdhdhdh', 'hshshshs', 'Ai mà biết', NULL, 'TP Hồ Chí Minh', 393000.00, '2025-07-04 17:20:38', 'Đang xử lý', '', 'cod'),
(43, 'ODF0043', NULL, 'k biet', '0388190170', 'Ai mà biết', NULL, 'TP Hồ Chí Minh', 329000.00, '2025-07-04 17:54:36', 'Đang xử lý', '', 'cod'),
(44, 'ODF0044', NULL, 'k biet', '0388190170', 'Ai mà biết', NULL, 'TP Hồ Chí Minh', 329000.00, '2025-07-04 18:01:00', 'Đang xử lý', '', 'cod'),
(45, 'ODF0045', NULL, 'Linh', '0388190280', 'Ai mà biết', NULL, 'TP Hồ Chí Minh', 329000.00, '2025-07-04 18:34:45', 'Đang xử lý', 'ji', 'cod'),
(46, 'ODF0046', NULL, 'k bic', '0388190280', '29 võ oanh', NULL, 'TP Hồ Chí Minh', 42000.00, '2025-07-04 19:21:05', 'Đang xử lý', '', 'cod'),
(47, 'ODF0047', NULL, 'Nguyễn Thiên Nam', '0388190280', '2 võ oanh', NULL, 'TP Hồ Chí Minh', 42000.00, '2025-07-04 19:33:51', 'Hoàn thành', '', 'cod'),
(48, 'ODF0048', NULL, 'Nguyễn Thiên Nam', '0388190290', '76 nguyễn', NULL, 'TP Hồ Chí Minh', 79000.00, '2025-07-04 19:43:33', 'Đã hủy', '', 'bank'),
(49, 'ODF0049', NULL, 'Thiên Nem', '0388190280', '28 võ công', NULL, 'TP Hồ Chí Minh', 1511000.00, '2025-07-05 11:55:49', 'Đang xử lý', '', 'cod'),
(50, 'ODF0050', 1, 'sjcisd', '0388290100', '45 Hà Giang', NULL, 'TP Hồ Chí Minh', 42000.00, '2025-07-06 15:22:06', 'Hoàn thành', '', 'cod'),
(51, 'ODF0051', 1, 'Nam Thiên', '0388190180', '2 võ oanh', NULL, 'TP Hồ Chí Minh', 42000.00, '2025-07-06 17:08:03', 'Đang giao', 'không giao', 'cod'),
(52, 'ODF0052', 1, 'ghchgc', '096357363', '2 dia chi giao hang', NULL, 'TP Hồ Chí Minh', 42000.00, '2025-07-06 17:33:09', 'Đã hủy', '', 'cod'),
(53, 'ODF0053', 7, 'Thiên Nem', '072827733', '20 đồng khởi', NULL, 'TP Hồ Chí Minh', 42000.00, '2025-07-06 18:22:26', 'Đang giao', 'khong giao', 'cod'),
(54, 'ODF0054', 8, 'Trình là gì', '0388190297', '58 Trình Hiếu', NULL, 'TP Hồ Chí Minh', 125000.00, '2025-07-06 19:14:47', 'Đang xử lý', '', 'bank'),
(55, 'ODF0055', 8, 'Trình', '0904394687', '28 Trình Hiếu', 'Phường An Hội Đông', 'TP Hồ Chí Minh', 42000.00, '2025-07-06 19:43:58', 'Đang xử lý', 'không giao', 'cod');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `don_gia` decimal(10,2) NOT NULL,
  `ghi_chu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `food_id`, `so_luong`, `don_gia`, `ghi_chu`) VALUES
(46, 35, 11, 1, 27000.00, NULL),
(47, 36, 10, 1, 19000.00, NULL),
(48, 37, 11, 1, 27000.00, NULL),
(49, 38, 11, 1, 27000.00, NULL),
(50, 39, 10, 2, 19000.00, NULL),
(51, 40, 9, 1, 32000.00, NULL),
(52, 40, 3, 1, 35000.00, NULL),
(53, 41, 9, 2, 32000.00, NULL),
(54, 41, 3, 1, 35000.00, NULL),
(55, 41, 8, 1, 279000.00, NULL),
(56, 42, 9, 2, 32000.00, NULL),
(57, 42, 3, 1, 35000.00, NULL),
(58, 42, 8, 1, 279000.00, NULL),
(59, 43, 3, 1, 35000.00, NULL),
(60, 43, 8, 1, 279000.00, NULL),
(61, 44, 3, 1, 35000.00, NULL),
(62, 44, 8, 1, 279000.00, NULL),
(63, 45, 3, 1, 35000.00, NULL),
(64, 45, 8, 1, 279000.00, NULL),
(65, 46, 11, 1, 27000.00, NULL),
(66, 47, 11, 1, 27000.00, NULL),
(67, 48, 9, 2, 32000.00, NULL),
(68, 49, 8, 1, 279000.00, NULL),
(69, 49, 1, 1, 79000.00, NULL),
(70, 49, 7, 2, 179000.00, NULL),
(71, 49, 9, 3, 32000.00, NULL),
(72, 49, 10, 1, 19000.00, NULL),
(73, 49, 13, 1, 20000.00, NULL),
(74, 49, 6, 5, 129000.00, NULL),
(75, 50, 11, 1, 27000.00, NULL),
(76, 51, 11, 1, 27000.00, NULL),
(77, 52, 11, 1, 27000.00, NULL),
(78, 53, 11, 1, 27000.00, NULL),
(79, 54, 11, 1, 27000.00, NULL),
(80, 54, 10, 1, 19000.00, NULL),
(81, 54, 9, 2, 32000.00, NULL),
(82, 55, 11, 1, 27000.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'user',
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `fullname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `blocked`, `fullname`) VALUES
(1, 'nemakira002@gmail.com', '$2y$10$eztvwfSlOJIfZ5UyTIf4n.vRVwHBk0iAaereegS2U8inT8sYQ0pAS', 'admin', 0, 'Nguyễn Thiên Nam'),
(2, 'thiennam456@gmail.com', 'khongcopass', 'user', 1, 'Thiên Nam'),
(4, 'thiennam4567@gmail.com', 'khongcopass', 'admin', 0, 'Thiên Nam'),
(5, 'namnam123@gmail.com', '$2y$10$f0J9boT/Rkcaq8qPAk9dOOfYmZYkYwoq/Z0NdJP3yVj8LcpZOA4Dy', 'user', 0, 'Test ter'),
(6, 'tranphatne09@gmail.com', '$2y$10$ToZQynewe0E22ceMgOvTZOxAfbmgPNSiLWTf26lxvxTlp3HiFoVhm', 'user', 0, 'Thiên Nam'),
(7, 'aibiet123@gmail.com', '$2y$10$5tvyLtqlA73Hni6j9L09Iu7kQElSrXb.0GgI2SqynqC3AlDP7FbUG', 'user', 0, 'NAM'),
(8, 'trinhlagi@gmail.com', '$2y$10$q0ZeB1lXIdXySSh.bdGzd.t6LeTsJyS4RyWGzr6FHhpYejQeL8HtW', 'user', 0, 'Trình');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_don` (`ma_don`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
