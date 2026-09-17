-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221012.46fdea0d0e
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 10:56 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enha_water`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_responses`
--

CREATE TABLE `chatbot_responses` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatbot_responses`
--

INSERT INTO `chatbot_responses` (`id`, `keyword`, `response`) VALUES
(1, 'harga', 'Harga isi ulang air kami adalah Rp 5.000 per galon.\r\n\r\nUntuk Harga bisa selebihnya di cek pada menu Available Products'),
(2, 'pengiriman', 'Kami menawarkan layanan pengiriman sampai ke depan pintu rumah Anda.'),
(3, 'jam', 'Kami buka dari jam 9 pagi sampai 6 sore, Senin sampai Sabtu.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `recipient_name` varchar(100) NOT NULL,
  `payment_method` enum('bank','qris','cod') NOT NULL,
  `delivery_option` enum('diantar','ambil') NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `user_id`, `quantity`, `order_date`, `address`, `phone`, `recipient_name`, `payment_method`, `delivery_option`, `payment_status`) VALUES
(3, 4, 1, 2, '2024-07-04 16:54:02', 'Kutukan Wetan 01/08, Ngadiluwih, Matesih, Karanganyar, 57781', '087879635290', 'Norhisma', 'cod', 'ambil', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `stock` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `price`, `stock`, `product_image`) VALUES
(4, 'GALON ASLI', 'Air galon', 20.000, 5, 'images/galon asli.jpeg'),
(5, 'UTRA GELASAN', 'Utra Gelasan 1 Dus', 22.000, 10, 'images/utra.jpeg'),
(6, 'LE MINERALE 15 LITER', 'Air Galon Le Minerale 15 L Baru', 20.000, 20, 'images/leminerale15L.jpeg'),
(7, 'AIR 2 TANDON', 'Air 2 Tandon', 1.000, 5, 'images/tandon.jpeg'),
(8, 'LE MINERALE BOTOL 600 ML', 'Le Minerale botol 600 ml 1 Dus isi 24 botol', 50.000, 5, 'images/mineralebotol600ml.jpeg'),
(9, 'LE MINERALE BOTOL 1.5 L', 'Le Minerale botol 1.5 liter 1 dus isi 12', 55.000, 10, 'images/mineralebotol15L.jpeg'),
(10, 'VIT GELAS', 'Air Gelasan Vit 1 Dus', 22.000, 5, 'images/vit.jpeg'),
(11, 'TREVOR / AURA GELASAN', 'Air Gelasan Trevor / Aura 1 Dus', 20.000, 6, 'images/trevor.jpeg'),
(12, 'JAVA GELASAN', 'Air Gelasan Java 1 Dus', 20.000, 4, 'images/java.jpeg'),
(13, 'GALON AQUA', 'Galon Aqua saja tanpa air', 35.000, 10, 'images/galon.jpeg'),
(14, 'GAS 3KG', 'Gas melon 3 kg', 19.000, 20, 'images/gas.jpeg'),
(15, 'AIR ISI ULANG', 'Air isi ulang per galon', 5.000, 50, 'images/isiulang.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `sellers_products`
--

CREATE TABLE `sellers_products` (
  `seller_product_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `user_type` enum('seller','buyer') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `phone`, `user_type`, `created_at`) VALUES
(1, 'risma', '$2y$10$shf6JrW3DWe7S2ZE8sehE.z9vWwu0uO/oAIjiUybM5Squt4FZgi46', 'b22022@poltekindonusa.ac.id', NULL, 'buyer', '2024-07-04 04:24:12'),
(2, 'admin', '$2y$10$h0gPklTc5F6qoaKiq.JWPepa6Lown7flwHpcVS3xKiUFwG0rzjafy', 'b22044@poltekindonusa.ac.id', NULL, 'seller', '2024-07-05 02:05:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `chatbot_responses`
--
ALTER TABLE `chatbot_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sellers_products`
--
ALTER TABLE `sellers_products`
  ADD PRIMARY KEY (`seller_product_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chatbot_responses`
--
ALTER TABLE `chatbot_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sellers_products`
--
ALTER TABLE `sellers_products`
  MODIFY `seller_product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `sellers_products`
--
ALTER TABLE `sellers_products`
  ADD CONSTRAINT `sellers_products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `sellers_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
