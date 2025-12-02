-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 02, 2025 at 01:31 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `draft-shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Vêtements', 'Mode homme, femme et enfant', '2025-12-01 13:59:50', '2025-12-01 13:59:50'),
(2, 'Électronique', 'High-tech et gadgets', '2025-12-01 13:59:50', '2025-12-01 13:59:50'),
(3, 'Maison', 'Décoration et ameublement', '2025-12-01 13:59:50', '2025-12-01 13:59:50');

-- --------------------------------------------------------

--
-- Table structure for table `clothing`
--

CREATE TABLE `clothing` (
  `product_id` int NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `material_fee` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clothing`
--

INSERT INTO `clothing` (`product_id`, `size`, `color`, `type`, `material_fee`) VALUES
(9, 'L', 'Bleu', 'Coton', 5);

-- --------------------------------------------------------

--
-- Table structure for table `electronic`
--

CREATE TABLE `electronic` (
  `product_id` int NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `waranty_fee` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `electronic`
--

INSERT INTO `electronic` (`product_id`, `brand`, `waranty_fee`) VALUES
(10, 'Apple', 50),
(11, 'Apple', 50),
(12, 'Apple', 50),
(13, 'Apple', 50);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `photos` json DEFAULT NULL,
  `price` int NOT NULL,
  `description` text,
  `quantity` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `photos`, `price`, `description`, `quantity`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'T-shirt Blanc', '[\"https://picsum.photos/200/300\"]', 1500, 'Basique coton', 50, '2025-12-01 13:59:50', '2025-12-01 13:59:50', 1),
(2, 'Jean Slim', '[\"https://picsum.photos/200/300\"]', 4500, 'Jean bleu', 20, '2025-12-01 13:59:50', '2025-12-01 13:59:50', 1),
(3, 'Smartphone X', '[\"https://picsum.photos/200/300\"]', 80000, 'Dernier cri', 5, '2025-12-01 13:59:50', '2025-12-01 13:59:50', 2),
(4, 'Casque Audio', '[\"https://picsum.photos/200/300\"]', 12000, 'Réduction de bruit', 15, '2025-12-01 13:59:50', '2025-12-01 13:59:50', 2),
(5, 'Lampe de bureau', '[\"https://picsum.photos/200/300\"]', 2500, 'LED économique', 30, '2025-12-01 13:59:50', '2025-12-01 13:59:50', 3),
(6, 'Canapé 3 places', '[\"https://picsum.photos/200/300\"]', 45000, 'Confortable', 2, '2025-12-01 13:59:50', '2025-12-01 13:59:50', 3),
(7, 'Produit modifié87', '[\"https://picsum.photos/200/300\"]', 100, 'Ce produit servira pour le test du Job 04', 1, '2025-12-01 13:59:50', '2025-12-02 11:02:50', 1),
(8, 'Super Vélo', '[\"https://image.com/velo.jpg\"]', 45000, 'Un vélo tout terrain incroyable', 5, '2025-12-02 08:17:35', '2025-12-02 08:17:35', 2),
(9, 'T-shirt Geek', '[\"photo.jpg\"]', 2000, 'Un super t-shirt', 10, '2025-12-02 11:04:28', '2025-12-02 11:04:28', 1),
(10, 'iPhone Test', '[\"img.jpg\"]', 90000, 'Smartphone puissant', 5, '2025-12-02 11:56:30', '2025-12-02 11:56:30', 2),
(11, 'iPhone Test', '[\"img.jpg\"]', 90000, 'Smartphone puissant', 5, '2025-12-02 11:56:31', '2025-12-02 11:56:31', 2),
(12, 'iPhone Test', '[\"img.jpg\"]', 90000, 'Smartphone puissant', 5, '2025-12-02 13:19:55', '2025-12-02 13:19:55', 2),
(13, 'iPhone Test', '[\"img.jpg\"]', 90000, 'Smartphone puissant', 5, '2025-12-02 13:19:56', '2025-12-02 13:19:56', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clothing`
--
ALTER TABLE `clothing`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `electronic`
--
ALTER TABLE `electronic`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clothing`
--
ALTER TABLE `clothing`
  ADD CONSTRAINT `clothing_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `electronic`
--
ALTER TABLE `electronic`
  ADD CONSTRAINT `electronic_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
