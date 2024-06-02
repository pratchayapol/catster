-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb-catster
-- Generation Time: Jun 02, 2024 at 10:20 AM
-- Server version: 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcatster`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_username` varchar(50) NOT NULL,
  `emp_firstname` varchar(50) NOT NULL,
  `emp_lastname` varchar(50) NOT NULL,
  `emp_address` text NOT NULL,
  `emp_email` varchar(50) NOT NULL,
  `emp_tel` char(10) NOT NULL,
  `emp_picture` longblob NOT NULL,
  `emp_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_username`, `emp_firstname`, `emp_lastname`, `emp_address`, `emp_email`, `emp_tel`, `emp_picture`, `emp_password`) VALUES
('emp.ai', 'Ai', 'Employee', 'ทดสอบการเพิ่มพนักงาน', 'emp@gmail.com', '0811052518', 0x31343070782d524d5554495f4b4f5241542e706e67, '1234');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `mem_username` varchar(50) NOT NULL,
  `mem_firstname` varchar(50) NOT NULL,
  `mem_lastname` varchar(50) NOT NULL,
  `mem_email` varchar(50) NOT NULL,
  `mem_tel` char(10) NOT NULL,
  `mem_picture` longblob NOT NULL,
  `mem_status` int(1) NOT NULL,
  `mem_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mem_username`, `mem_firstname`, `mem_lastname`, `mem_email`, `mem_tel`, `mem_picture`, `mem_status`, `mem_password`) VALUES
('mem.ai', 'ไอย์', 'ทดสอบแก้ไข', 'test@gmail.com', '0811052518', 0x6d656d2d312e706e67, 0, '1234'),
('mem.fang', 'Nongnapat', 'Sriwongjan', 'fang.nnp@gmail.com', '0920726830', 0x312e6a7067, 0, '1234');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` char(12) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_tel` char(10) NOT NULL,
  `order_address` text NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `order_total` float(7,2) NOT NULL,
  `order_note` text NOT NULL,
  `mem_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `order_tel`, `order_address`, `order_status`, `order_total`, `order_note`, `mem_username`) VALUES
('OR8785419036', '2024-06-02 17:06:32', '0811052518', 'ทดสอบการสั่งซื้อ', 'paid', 450.00, 'ครั้งที่ 1', 'mem.ai');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` char(12) NOT NULL,
  `product_id` char(5) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `sub_total` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `product_name`, `product_price`, `quantity`, `sub_total`) VALUES
('OR8785419036', 'P0002', 'Kaniva', 250.00, 1, 250.00),
('OR8785419036', 'P0003', 'Nekko', 200.00, 1, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` char(12) NOT NULL,
  `order_id` char(12) NOT NULL,
  `pay_slip` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `order_id`, `pay_slip`) VALUES
('P83105308557', 'OR8785419036', 0x6d656d2d312e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` char(5) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `product_remain` int(10) NOT NULL,
  `product_picture` longblob NOT NULL,
  `product_desc` text NOT NULL,
  `type_id` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_remain`, `product_picture`, `product_desc`, `type_id`) VALUES
('P0001', 'Royal Canin', 222.00, 20, 0x3130312e706e67, 'อาหารแมว สูตร Indoor', 'TYPE1'),
('P0002', 'Kaniva', 250.00, 10, 0x3131332e706e67, 'อาหารแมว ยี่ห้อคานิว่า สูตร Indoor', 'TYPE1'),
('P0003', 'Nekko', 200.00, 20, 0x3130362e706e67, 'รสปลาแซลมอน สำหรับลูกแมว', 'TYPE1'),
('P0004', 'Buzz', 170.00, 20, 0x3130392e706e67, 'รสปลาและไก่ สำหรับแมวอายุ 1 ปี+', 'TYPE1'),
('P0005', 'กล่องชีส', 80.00, 10, 0x3530332e706e67, 'ที่ลับเล็บแมว รูปกล่องชีส', 'TYPE2'),
('P0006', 'กระเป๋าแมว', 390.00, 10, 0x3930312e706e67, 'กระเป๋าใส่แมว ไปนอกสถานที่', 'TYPE3'),
('P0007', 'กรรไกรตัดเล็บ', 150.00, 10, 0x3931342e706e67, 'กรรไกรตัดเล็บแมว ', 'TYPE3'),
('P0008', 'Prammy ขนมแมวเลีย', 15.00, 50, 0x3330352e706e67, 'ขนมแมวเลีย ยี่ห้อ Prammy รสไก่', 'TYPE1');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `type_id` char(5) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`type_id`, `type_name`) VALUES
('TYPE1', 'อาหาร'),
('TYPE2', 'ของเล่น'),
('TYPE3', 'อุปกรณ์');

-- --------------------------------------------------------

--
-- Table structure for table `shelter`
--

CREATE TABLE `shelter` (
  `shelter_name` varchar(50) NOT NULL,
  `shelter_address` text NOT NULL,
  `shelter_tel` char(10) NOT NULL,
  `shelter_donation` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shelter`
--

INSERT INTO `shelter` (`shelter_name`, `shelter_address`, `shelter_tel`, `shelter_donation`) VALUES
('Catster', '90/58 -- โครงการ BIZTOWN พระราม 3 - สุขสวัสดิ์ หมู่ 18 ตำบลบางพึ่ง อำเภอพระประแดง จ.สมุทรปราการ 10130', '0635974794', 67.50);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine`
--

CREATE TABLE `vaccine` (
  `vac_id` char(5) NOT NULL,
  `vac_name` varchar(50) NOT NULL,
  `vac_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccine`
--

INSERT INTO `vaccine` (`vac_id`, `vac_name`, `vac_desc`) VALUES
('VAC01', 'FPV', 'ไข้หัดแมว'),
('VAC02', 'FeLV', 'ไวรัสมะเร็งเม็ดเลือดขาว');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mem_username`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `mem_username` (`mem_username`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `shelter`
--
ALTER TABLE `shelter`
  ADD PRIMARY KEY (`shelter_name`);

--
-- Indexes for table `vaccine`
--
ALTER TABLE `vaccine`
  ADD PRIMARY KEY (`vac_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `mem_username` FOREIGN KEY (`mem_username`) REFERENCES `members` (`mem_username`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `type_id` FOREIGN KEY (`type_id`) REFERENCES `product_type` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
