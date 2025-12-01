-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2025 at 01:02 PM
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
(7, 'Produit Spécial Job 04', '[\"https://picsum.photos/200/300\"]', 9999, 'Ce produit servira pour le test du Job 04', 1, '2025-12-01 13:59:50', '2025-12-01 13:59:50', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
