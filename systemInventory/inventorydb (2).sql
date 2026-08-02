-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2026 at 08:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders_tbl`
--

CREATE TABLE `orders_tbl` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `status` enum('pending','accepted','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_tbl`
--

INSERT INTO `orders_tbl` (`id`, `product_id`, `quantity`, `status`, `created_at`) VALUES
(21, 2, 1, 'accepted', '2026-08-02 04:53:40'),
(22, 26, 3, 'accepted', '2026-08-02 04:54:26'),
(23, 24, 2, 'accepted', '2026-08-02 05:06:53'),
(24, 28, 1, 'accepted', '2026-08-02 05:22:52'),
(25, 28, 1, 'accepted', '2026-08-02 05:23:14'),
(26, 25, 1, 'accepted', '2026-08-02 05:23:29'),
(27, 27, 1, 'accepted', '2026-08-02 05:23:43'),
(28, 27, 4, 'accepted', '2026-08-02 05:24:12'),
(29, 20, 1, 'accepted', '2026-08-02 05:24:28');

-- --------------------------------------------------------

--
-- Table structure for table `products_tbl`
--

CREATE TABLE `products_tbl` (
  `id` int(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `category` enum('Frozen','Pork','Beef') NOT NULL,
  `status` enum('pending','accepted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_tbl`
--

INSERT INTO `products_tbl` (`id`, `product_name`, `price`, `quantity`, `category`, `status`) VALUES
(2, 'Bologna', 45, 0, 'Frozen', 'accepted'),
(5, 'Balingit', 250, 0, 'Pork', 'accepted'),
(12, 'Tapa', 125, 0, 'Beef', 'accepted'),
(20, 'lechon', 200, 0, 'Pork', 'accepted'),
(23, 'hotdog', 50, 0, 'Frozen', 'accepted'),
(24, 'Tapa', 50, 1, 'Beef', 'accepted'),
(25, 'hotdog', 50, 0, 'Frozen', 'accepted'),
(26, 'Bologna', 75, 2, 'Frozen', 'accepted'),
(27, 'lechon', 300, 0, 'Pork', 'accepted'),
(28, 'hotdog', 50, 0, 'Frozen', 'accepted'),
(29, 'lechon', 150, 3, 'Pork', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Customer','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(8, 'Jomer', 'licious@gmail.com', '$2y$10$/xoXkIYTJQrKJWQaXRvwHOz0wblrnrdZSnqQYD.ZEC.I4nyOLALbe', 'Admin'),
(9, 'ndab', 'landoa@gmail.com', '$2y$10$L8s67tr0QcI6DTDBoQPRpe4VW52X72VG0D7LXxZ5EOZzcOfqYK2Le', 'Admin'),
(10, 'Kalde', 'reta@gmail.com', '$2y$10$uYe2d.EL64SixQEuKFPU8.raakvsgRrAnqOOAIIRX57hrd1VH.4me', 'Admin'),
(11, 'Sinigang', 'nabangus@gmail.com', '$2y$10$sE12feh3p/ujSsw8/e5GbOzo430gySKVYRCkTdlDgtDJjW3meohjy', 'Admin'),
(14, 'jdwjd', 'nc@gmail.com', '$2y$10$I1GsC2r41RcOHhNPTLVTxugaLubBdan2WpYWwuzi0yJDnGnY7CHfi', 'Admin'),
(15, 'jj', 'Kinm@gmail.com', '$2y$10$ztXw4RU5.TswAc0aE8/9m.MRf4j.4nZdSvcZ/LjZlNvyAWMEqcXMi', 'Admin'),
(16, 'Teddy', 'pangit@gmail.com', '$2y$10$vrqjezjCvx3JhOQ9VPnL2OXvJU2D/9T.FdqX5.j.wuYllGiSga/1C', 'Admin'),
(18, 'Kim', 'ranjit@gmail.com', '$2y$10$e5sTH5.vVYsPsp1rM2avLOkMkdRbs.X5GlyXD.Ol6bXw7pB6kqScS', 'Admin'),
(19, 'jakda', 'aknfaca@gmail.com', '$2y$10$cIOnWgP9g0mNomvlbL6VMeD84XsrugDhQNzS.3Vy1OlKeyKiRL4jW', 'Admin'),
(21, 'mel@gmail.com', 'akosimelvelascoto@gmail.com', '$2y$10$dKsCUR.K.VrFypUZ9sraXOOmR0AjYMrtCf/dVx/.dYIuk7DyOT1uC', 'Admin'),
(22, 'mel@g', 'me@n.com', '$2y$10$ztcLuMmeoOKKYSFMJDFqze0UhSkz.IYdNXZ7q2bPZN0eRjR1Z/5cW', 'Admin'),
(24, 'mel@gmil.com', 'akosimelveascoto@gmail.com', '$2y$10$C49RiBk7mH.MHwWJpgWRfuFD/sw0xO86AJGjTvNvct/mgI9ckiSMi', 'Admin'),
(25, 'kjbsda', 'asbh@g.vom', '$2y$10$w0X87vc72utJ2Fb1b1bFhub7c6g/UT8WGeT7OU5q41CM7wdNdy2Ne', 'Admin'),
(26, 'kjbe', 'asfafa@gmail.com', '$2y$10$69O.oMcrLOsDYdmqSodZsu2GSNBjyZ1MXAiXEv5nHCIgGdEPJWRmO', 'Customer'),
(27, 'mgmail', 'qfqwfsga@gmail.com', '$2y$10$JoP1SAcCmPFq.Vcm28v20.goTe1.JNKhGDwcYEGB8HgJMCiqtNAbS', 'Customer'),
(28, 'mgail', 'fqwfsga@gmail.com', '$2y$10$DeJM7wUBioeNOq73NfIWje55yKOLsMVaqGZetXU2VBsAHonr.AzNy', 'Customer'),
(29, 'hays', 'n@gmail.com', '$2y$10$xzNonJji7t8Mfsi829mr/e6ke.7HzJV0H06UJHCDoL6qCpEfZZm4m', 'Admin'),
(30, 'hay', 'o@gmail.com', '$2y$10$N7c7i9T01J36s9kVApmRe.8bAb8KWVoCZo/3ceAk6U1A5YTOZl0Jq', 'Customer'),
(31, 'Ako to', 'sinatoy@gmail.com', '$2y$10$f7QXcMOc50JMlsg04A.SeuZL8tQANfdNAmiT6Gci1DxWWaomyXLXa', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products_tbl`
--
ALTER TABLE `products_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products_tbl`
--
ALTER TABLE `products_tbl`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  ADD CONSTRAINT `orders_tbl_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products_tbl` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
