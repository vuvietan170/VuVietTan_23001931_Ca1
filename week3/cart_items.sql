-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2026 at 02:52 AM
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
-- Database: `shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `name`, `price`, `quantity`) VALUES
(1, 'Bàn phím cơ Logi', 15000000.00, 3),
(2, 'Chuột không dây', 80000.00, 10),
(3, 'Tai nghe Gaming', 450000.00, 4),
(4, 'Màn hình 24 inch', 3200000.00, 2),
(5, 'Lót chuột RGB', 95000.00, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

 -- lấy ra toàn bộ sp
SELECT * FROM cart_items 

-- SP CO GIA LON HON 100000
SELECT * FROM cart_items 
WHERE price > 100000

--SO LUONG > 5
SELECT * FROM cart_items 
WHERE quantity > 5

-- SP THEO GIA GIAM DAN
SELECT * FROM cart_items 
ORDER BY price DESC

-- CAP NHAT GIA CUA 1 SP
UPDATE cart_items
SET price = 95000 
WHERE id = 2

-- CAP  NHAP SO LUONG 1 SP
UPDATE cart_items SET quantity = 6 WHERE id = 3;

-- XOA 1 SP
DELETE FROM cart_items WHERE id = 4;

-- HIEN THI TEN,GIA,...
SELECT name, price,quantity, (price*quantity) AS total FROM cart_items 

-- tong tien cart
SELECT SUM(price*quantity) AS total_cart FROM cart_items 
