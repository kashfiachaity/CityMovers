-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2021 at 07:40 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citymovers`
--

-- --------------------------------------------------------

--
-- Table structure for table `aircondition`
--

CREATE TABLE `aircondition` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `worker_number` int(20) NOT NULL,
  `per_worker_wages` int(20) NOT NULL,
  `isHired` tinyint(1) NOT NULL,
  `isApproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aircondition`
--

INSERT INTO `aircondition` (`id`, `user_id`, `company_name`, `worker_number`, `per_worker_wages`, `isHired`, `isApproved`) VALUES
(1, 11, 'Jabbar AC service', 4, 700, 0, 1),
(2, 12, 'Maruf AC and Fredge Service', 5, 600, 0, 1),
(3, 13, 'Munna Enterprise', 4, 650, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookinginformation`
--

CREATE TABLE `bookinginformation` (
  `id` int(15) NOT NULL,
  `presentAddress` varchar(255) NOT NULL,
  `newAddress` varchar(255) NOT NULL,
  `distance` double NOT NULL,
  `movingDate` date NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) NOT NULL,
  `houseTypeDetails` int(255) NOT NULL,
  `officeAreaOne` double NOT NULL,
  `officeAreaTwo` double NOT NULL,
  `presentFloor` int(255) NOT NULL,
  `newFloor` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookinginformation`
--

INSERT INTO `bookinginformation` (`id`, `presentAddress`, `newAddress`, `distance`, `movingDate`, `type`, `houseTypeDetails`, `officeAreaOne`, `officeAreaTwo`, `presentFloor`, `newFloor`) VALUES
(1, 'Kallyanpur, Dhaka, Bangladesh', 'Dhanmondi, Dhaka, Bangladesh', 4.28, '2021-04-30', 'House', 3, 0, 0, 2, 1),
(2, 'Kallyanpur, Dhaka, Bangladesh', 'Dhanmondi Green, Road No. 12A, Dhaka, Bangladesh', 3.93, '2021-04-30', 'House', 4, 0, 0, 2, 3),
(3, 'Kallyanpur Natun Bazar Road, Dhaka, Bangladesh', 'Dhanmondi, Dhaka, Bangladesh', 4.7, '2021-04-30', 'House', 3, 0, 0, 2, 2),
(4, 'Kallyanpur, Dhaka, Bangladesh', 'Dhanmondi, Dhaka, Bangladesh', 4.28, '2021-04-30', 'House', 3, 0, 0, 2, 2),
(5, 'Keraniganj, Bangladesh', 'Dhanmondi, Dhaka, Bangladesh', 5.52, '2021-04-30', 'House', 2, 0, 0, 2, 3),
(6, 'Gulshan, Dhaka, Bangladesh', 'Motijheel, Dhaka, Bangladesh', 6.69, '2021-05-01', 'Office', 0, 1200, 1400, 2, 2),
(7, 'Kallyanpur, Dhaka, Bangladesh', 'Dhanmondi, Dhaka, Bangladesh', 4.28, '2021-05-01', 'House', 3, 0, 0, 2, 2),
(8, 'Kallyanpur, Dhaka, Bangladesh', 'Mohammadpur, Dhaka, Bangladesh', 1.78, '2021-05-01', 'House', 4, 0, 0, 2, 1),
(9, 'Keraniganj, Bangladesh', 'Mohammadpur, Dhaka, Bangladesh', 8.22, '2021-05-01', 'House', 3, 0, 0, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `vehicle_id` int(20) NOT NULL,
  `labour_id` int(20) NOT NULL,
  `hired_labour_number` int(20) NOT NULL,
  `ac_id` int(20) NOT NULL,
  `hired_ac_number` int(20) NOT NULL,
  `electrician_id` int(20) NOT NULL,
  `hired_electrician_number` int(20) NOT NULL,
  `booking_id` int(20) NOT NULL,
  `total_amount` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `order_id`, `vehicle_id`, `labour_id`, `hired_labour_number`, `ac_id`, `hired_ac_number`, `electrician_id`, `hired_electrician_number`, `booking_id`, `total_amount`) VALUES
(1, 1, 1, 2, 1, 2, 1, 1, 1, 3, 10179),
(2, 6, 1, 1, 2, 1, 2, 1, 2, 6, 12868);

-- --------------------------------------------------------

--
-- Table structure for table `electrician`
--

CREATE TABLE `electrician` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `worker_number` int(20) NOT NULL,
  `per_worker_wages` int(20) NOT NULL,
  `isHired` tinyint(1) NOT NULL,
  `isApproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `electrician`
--

INSERT INTO `electrician` (`id`, `user_id`, `company_name`, `worker_number`, `per_worker_wages`, `isHired`, `isApproved`) VALUES
(1, 14, 'Akash Electronics', 3, 500, 0, 1),
(2, 15, 'Mia Wirings', 4, 450, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `labour`
--

CREATE TABLE `labour` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `labour_number` int(20) NOT NULL,
  `labour_wages` int(20) NOT NULL,
  `ishired` tinyint(1) NOT NULL,
  `isApproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `labour`
--

INSERT INTO `labour` (`id`, `user_id`, `company_name`, `labour_number`, `labour_wages`, `ishired`, `isApproved`) VALUES
(1, 7, 'Masum Moving Service', 7, 600, 0, 1),
(2, 8, 'Kawser House & Office Shifting', 8, 450, 0, 1),
(3, 9, 'Robin Shifters', 9, 500, 0, 1),
(4, 10, 'Rahim Sifters', 12, 600, 0, 1),
(5, 18, 'Motalib Shifting Service', 5, 600, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `moving_instruments`
--

CREATE TABLE `moving_instruments` (
  `id` int(20) NOT NULL,
  `instruments_name` varchar(255) NOT NULL,
  `instruments_image` varchar(255) NOT NULL,
  `quantity` int(20) NOT NULL,
  `instruments_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `moving_instruments`
--

INSERT INTO `moving_instruments` (`id`, `instruments_name`, `instruments_image`, `quantity`, `instruments_price`) VALUES
(1, 'Box Medium(21x21x21x21)', '435-4359881_package-vector-corrugated-box-cartoon-cardboard-box-png.png', 40, 50),
(2, 'Bubble Wraper', '8ed5cb6338699b470e92563228bfe528.jpeg', 20, 500),
(3, 'Plastic Wrapper', 'bf0e1762463e0e45696e45a3b72fb0de.jpg', 20, 350),
(4, 'Box Big', '435-4359881_package-vector-corrugated-box-cartoon-cardboard-box-png.png', 10, 90);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_instruments`
--

CREATE TABLE `ordered_instruments` (
  `id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `instruments_id` int(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordered_instruments`
--

INSERT INTO `ordered_instruments` (`id`, `order_id`, `instruments_id`, `quantity`, `price`) VALUES
(1, 2, 2, 1, 500),
(2, 2, 4, 1, 90),
(3, 4, 2, 1, 500),
(4, 5, 2, 1, 500),
(5, 6, 1, 3, 50),
(6, 6, 3, 1, 350);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `houseNo` varchar(255) NOT NULL,
  `roadNo` varchar(255) NOT NULL,
  `postCode` int(20) NOT NULL,
  `city` varchar(255) NOT NULL,
  `isCompleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `houseNo`, `roadNo`, `postCode`, `city`, `isCompleted`) VALUES
(1, 16, '74/C', '14', 1207, 'Kallyanpur', 0),
(2, 16, '67', '01', 1207, 'Kallyanpur', 1),
(4, 17, '5', '10', 1207, 'Mirpur', 0),
(5, 17, '01', '05', 1207, 'Mirpur', 0),
(6, 17, '51', '01', 1212, 'Gulshan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pricing_details`
--

CREATE TABLE `pricing_details` (
  `id` int(255) NOT NULL,
  `distancePrice` double NOT NULL,
  `roomPrice` double NOT NULL,
  `officeAreaPrice` double NOT NULL,
  `floorPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricing_details`
--

INSERT INTO `pricing_details` (`id`, `distancePrice`, `roomPrice`, `officeAreaPrice`, `floorPrice`) VALUES
(1, 70, 700, 1000, 300);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `userRole` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `email`, `hashed_password`, `userRole`) VALUES
(1, 'Admin', '01866351460', 'admin@gmail.com', '$2y$10$okzzPhgO2RpX.k9QlMZSauo6RGGo6ELkASb4tQUVNKSKVdWBQUUDG', 'Admin'),
(2, 'Motin Khan', '01478963258', 'motin@gmail.com', '$2y$10$WxsnbEGoK58qyadnnmMTqeXYneLOxfiyAyZOSrtRWy4rszA/jrz2C', 'Vehicle'),
(3, 'Joynal', '01236987412', 'joynal@gmail.com', '$2y$10$lBs3jlW800twXOlGevbR1eVTfUoFjvlIZT.Bl98//20TLoGRxlZ.G', 'Vehicle'),
(4, 'Sumon Sheikh', '01234567891', 'sumon@gmail.com', '$2y$10$A55Bh2vpmomollXRFENKUeO0yqiKFwHEjb78rn8nC42TE2JA/E/Ya', 'Vehicle'),
(5, 'Mamun Bepary', '01236547896', 'mamun@gmail.com', '$2y$10$8REgf0pGqS83mW/qrtL.zeuR.ER.eGimsQVBzgd808Dn0LZl9jOXi', 'Vehicle'),
(6, 'Musaddek Khan', '01505152534', 'musaddek@gmail.com', '$2y$10$rt9Ri7C2b5Psb2RagylYZ.j/RpwVjP5apW0/S4ebwCu9jiQh.KXXS', 'Vehicle'),
(7, 'Masum Khan', '01598745632', 'masum@gmail.com', '$2y$10$Z8FIC.r1kNKXSBF/nhhn.eA9DUiKry2jijgl0ED.EDeQOk5iNcMvO', 'Labour'),
(8, 'Kawser Mia', '01546789325', 'kawser@gmail.com', '$2y$10$w4U5.5RxILdHnLFs/09RC.XSrR/.Jm1OI59khYA6XNHbWuNHCB0Ji', 'Labour'),
(9, 'Robin Mia', '01456789324', 'robin@gmail.com', '$2y$10$sxmaZX70JxZHHHTD02k1duHrnOMewj/b9ytx4nahqvir2RNdbKTsq', 'Labour'),
(10, 'Rahim Shifting Service', '01254789635', 'rahim@gmail.com', '$2y$10$HTAJ.fZgjg3CUtbt63v.0e0/TY4.yw6lWuc4U8L6rJc4mnZwdw3gm', 'Labour'),
(11, 'Jabbar Mia', '01478965415', 'jabbar@gmail.com', '$2y$10$SbXAe4q1lQSMCiyrCe1odeFjXbCbY0oGAG7FlOkeWqZbIRPXMx2LC', 'AC'),
(12, 'Maruf Sarker', '01569874234', 'maruf@gmail.com', '$2y$10$5HMHIaN04mjPycnfO3Crde7US3gLNnZsf.ZBqCBMu848h5eFo235a', 'AC'),
(13, 'Munna', '01897456321', 'munna@gmail.com', '$2y$10$qr588ZRnimYXoHiJxzMyhes9rzTZ0bxk61dFe9N/jPgkLdzAvMMI6', 'AC'),
(14, 'Akash', '01987458965', 'akash@gmail.com', '$2y$10$taUtDrP3Wof6tdkllxQHU.zJW47ep20wWGHk.HLzyxe7yUDAXZ8Xi', 'Electrician'),
(15, 'Abdul Mia', '01789654123', 'mia01@gmail.com', '$2y$10$NBfDkF81y1yiRW3IwbqOOuZEpD8MG2sydifxw8O8NeHzt61cXXDTq', 'Electrician'),
(16, 'Debnath', '01812282270', 'deb@gmail.com', '$2y$10$A73IjLmp/u3xSnmjE130ce4MZngb6m4rJ2zbpSJl./1RMo24jJOQ.', 'Customer'),
(17, 'Rakib Islam', '01819505879', 'rakib@gmail.com', '$2y$10$gTlCNWQ/njckqvWKPBZFEuigPy/Xcmi95fj1H80tVKj6fltTw2LZm', 'Customer'),
(18, 'Motalib Mia', '01255698487', 'motalib@gmail.com', '$2y$10$EtuImRZcHNnnxvdzwFq14..hekKSGYKJAtk5Rl./ke2EWl7dvYrIO', 'Labour'),
(19, 'Sami', '01897458658', 'sami@gmail.com', '$2y$10$XvEa/1vlp2TFKthNVzLFWe96NZU/n8xQDM6.hpWCmMGJ/v3iSpcie', 'Customer'),
(20, 'Munna', '01978456874', 'munna@gmail.com', '$2y$10$AI2GBxaeigHvHtoG1YRXRunDNNKK4AfIZ.LkZsdP5OX5xXMJO3N5m', 'Customer'),
(21, 'Masud', '01548789562', 'masud@gmail.com', '$2y$10$oEZr4nbsOAJOaMmx3HucQ.4sdIM5dRdL1dF0Og60gYXQILTyyY3Ie', 'Labour');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(255) NOT NULL,
  `user_id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `experience_year` int(25) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `isHired` tinyint(1) NOT NULL,
  `isApproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `user_id`, `name`, `image`, `experience_year`, `vehicle_type`, `price`, `isHired`, `isApproved`) VALUES
(1, 2, 'Akkas', 'unnamed.png', 4, 'Truck', 5000, 0, 1),
(2, 3, 'Mojid Pal', 'Untitled-1 copy.png', 6, 'Van', 600, 0, 1),
(3, 4, 'Karim Monshi', 'ace-gallery-03.jpg', 8, 'Pick Up', 3000, 1, 1),
(4, 5, 'Mokaddes', 'Untitled-1 copy.png', 2, 'Van', 400, 0, 1),
(5, 6, 'Montu', 'ace-gallery-03.jpg', 6, 'Pick Up', 3500, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircondition`
--
ALTER TABLE `aircondition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookinginformation`
--
ALTER TABLE `bookinginformation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electrician`
--
ALTER TABLE `electrician`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labour`
--
ALTER TABLE `labour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moving_instruments`
--
ALTER TABLE `moving_instruments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_instruments`
--
ALTER TABLE `ordered_instruments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing_details`
--
ALTER TABLE `pricing_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircondition`
--
ALTER TABLE `aircondition`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookinginformation`
--
ALTER TABLE `bookinginformation`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `electrician`
--
ALTER TABLE `electrician`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `labour`
--
ALTER TABLE `labour`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `moving_instruments`
--
ALTER TABLE `moving_instruments`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ordered_instruments`
--
ALTER TABLE `ordered_instruments`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pricing_details`
--
ALTER TABLE `pricing_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
