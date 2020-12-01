-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2020 at 03:52 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cedcoss`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `distance` varchar(255) NOT NULL,
  `is_available` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `name`, `distance`, `is_available`) VALUES
(1, 'charbagh', '0', 1),
(2, 'indira nagar', '10', 1),
(3, 'bbd', '30', 1),
(4, 'barabanki', '60', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ride`
--

CREATE TABLE `tbl_ride` (
  `ride_id` int(11) NOT NULL,
  `ride_date` date NOT NULL,
  `pickup` varchar(100) NOT NULL,
  `droplocation` varchar(100) NOT NULL,
  `total_distance` varchar(200) NOT NULL,
  `luggage` varchar(255) NOT NULL,
  `total_fare` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `customer_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ride`
--

INSERT INTO `tbl_ride` (`ride_id`, `ride_date`, `pickup`, `droplocation`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`) VALUES
(1, '2020-11-25', 'charbagh', 'indira nagar', '10', '', '185', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dateofsignup` datetime NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `isblock` int(11) NOT NULL DEFAULT 0,
  `password` varchar(100) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `name`, `dateofsignup`, `mobile`, `isblock`, `password`, `is_admin`) VALUES
(1, 'admin', 'admin', '2020-11-24 09:18:26', '9616871205', 1, 'Password123$', 1),
(2, 'arjunkumar@gmail.com', 'Arjun kumar', '2020-11-24 09:19:35', '9616871205', 1, 'arjun1023', 0),
(4, 'arjun@gmail.com', 'anivesh', '2020-11-24 00:00:00', '7007599630', 0, 'anivesh', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD PRIMARY KEY (`ride_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  MODIFY `ride_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
