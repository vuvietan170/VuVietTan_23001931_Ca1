  -- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2026 at 03:26 AM
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
-- Database: `movies_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_seats` int(11) NOT NULL,
  `available_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `price`, `total_seats`, `available_seats`) VALUES
(1, 'Avengers', 100000.00, 100, 60),
(2, 'Avatar', 120000.00, 80, 30),
(3, 'Batman', 90000.00, 120, 110),
(4, 'Oppenheimer', 110000.00, 90, 40),
(5, 'Spider-Man', 95000.00, 150, 45);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- all sp
SELECT * FROM movies

-- price> 100
SELECT * FROM movies
WHERE price > 100000

--avai > 50
SELECT * FROM movies
WHERE available_seats > 50

-- gia giam dan
SELECT * FROM movies
ORDER BY price DESC

-- upate avai_seats
UPDATE movies SET available_seats = 60 WHERE id = 4;

-- XOA PHIM 
DELETE FROM movies WHERE id =1;

-- SO VE DA BAN
SELECT (total_seats - available_seats) AS SO_VE_DA_BAN FROM movies;

--DOANH THU MOI PHIM
SELECT (total_seats - available_seats)*price AS DOANH_THU_MOI_PHIM FROM movies

-- TONG DOANH THU
SELECT SUM(total_seats - available_seats)*price AS TONG_DOANH_THU FROM movies;

-- PHIM CO VE BAN RA NHIEU NHAT
SELECT (total_seats - available_seats) AS NHIEU_VE_BAN_NHAT, title FROM movies 
ORDER BY total_seats - available_seats DESC
LIMIT 1
