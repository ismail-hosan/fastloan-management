-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2022 at 09:05 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fast_loan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrower`
--

CREATE TABLE `tbl_borrower` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nid` bigint(30) NOT NULL,
  `rejected` int(11) NOT NULL DEFAULT 0,
  `gender` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `working_status` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_borrower`
--

INSERT INTO `tbl_borrower` (`id`, `name`, `nid`, `rejected`, `gender`, `mobile`, `email`, `dob`, `address`, `working_status`, `image`, `password`, `city`) VALUES
(1, 'TIPU SULTAM', 199661456, 0, 'Male', '01834564564', 'raihan@mail.com', '1997-11-27', 'Uttara, Dhaka', 'Student', 'uploads/a72f84b339.jpg', '$2y$10$bxwEmaT0KHwBTNZUCWswueV5PJmsjM39tXwLLIHTkc2SOrxe9KQXy', '0'),
(2, 'Samdani', 19996456456, 0, 'Male', '0163456455', 'kamalkarim@mail.com', '1995-06-14', 'Mirpur, Dhaka', 'Owner', 'uploads/4afa45893c.jpg', '$2y$10$qXNVLOe19LCChTa1jI84tekKmZaJuX7GJ38utcA1seUUyWrZl87LW', '0'),
(3, 'Md Raihan Uddin', 151030582, 0, 'Male', '01834564564', 'kamalkarim@mail.com', '2018-08-22', 'Uttara, Dhaka', 'Unemployed', 'uploads/810b73db93.jpg', '$2y$10$.IybWoZhtgTu.pLuYnWQFeNGakNpRXq8tlLC6WvouVC5.ZUoa1pDq', '0'),
(28, 'Abdullah Al Mamun', 3742661576, 0, 'Male', '01722410301', 'rabbe01515@gmail.com', '1994-06-27', 'Mohammadpur', 'Student', 'uploads/1850f8cd1e.jpg', '$2y$10$TeA2ut5U7/8SaosYKDdtteZIrCtIAnkCfQDKjETlitp6rrldDSLoq', 'Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_interest_rates`
--

CREATE TABLE `tbl_interest_rates` (
  `id` int(11) NOT NULL,
  `loan_purpose` varchar(50) NOT NULL,
  `interest_rates` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_interest_rates`
--

INSERT INTO `tbl_interest_rates` (`id`, `loan_purpose`, `interest_rates`) VALUES
(1, 'Education Loan', 7),
(2, 'Home Loan', 9),
(3, 'Marriage loan', 8),
(4, 'Personal Loan', 10),
(5, 'Travel Loan', 9),
(6, 'Business Loan', 12),
(7, 'Car Loan', 11),
(8, 'Doctor’s Loan', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_liability`
--

CREATE TABLE `tbl_liability` (
  `id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `property_details` text NOT NULL,
  `price` bigint(50) NOT NULL,
  `pay_remaining_loan` bigint(50) NOT NULL,
  `return_money` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loan_application`
--

CREATE TABLE `tbl_loan_application` (
  `id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `name` varchar(100) NOT NULL,
  `expected_loan` bigint(50) NOT NULL,
  `loan_percentage` int(11) NOT NULL,
  `installments` int(11) NOT NULL,
  `total_loan` bigint(50) NOT NULL,
  `emi_loan` int(11) NOT NULL,
  `amount_paid` bigint(50) DEFAULT 0,
  `amount_remain` bigint(50) DEFAULT NULL,
  `current_inst` int(11) DEFAULT 0,
  `remain_inst` int(11) DEFAULT NULL,
  `next_date` date DEFAULT NULL,
  `files` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_loan_application`
--

INSERT INTO `tbl_loan_application` (`id`, `b_id`, `status`, `name`, `expected_loan`, `loan_percentage`, `installments`, `total_loan`, `emi_loan`, `amount_paid`, `amount_remain`, `current_inst`, `remain_inst`, `next_date`, `files`) VALUES
(1, 1, 3, 'TIPU SULTAM', 40000, 12, 8, 44800, 5600, 44800, 0, 8, 0, '2018-08-12', 'admin/uploads/documents/ff4bff1a9b.docx'),
(2, 2, 3, 'Samdani', 8000, 5, 5, 8400, 1680, 8400, 0, 5, 0, '2018-08-13', 'admin/uploads/documents/f2c5766143.docx');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mailer`
--

CREATE TABLE `tbl_mailer` (
  `id` int(11) NOT NULL,
  `from_name` varchar(50) NOT NULL,
  `from_email` varchar(50) NOT NULL,
  `host` varchar(50) NOT NULL,
  `authentication` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `encryption` varchar(50) NOT NULL,
  `port` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mailer`
--

INSERT INTO `tbl_mailer` (`id`, `from_name`, `from_email`, `host`, `authentication`, `username`, `password`, `encryption`, `port`) VALUES
(1, 'Fast Loan Ltd.', 'tanemrah18@gmail.com', 'smtp.gmail.com', 'true', 'tanemrah18@gmail.com', 'cGFzc3dvcmQ=', 'tls', '587');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `pay_amount` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `current_inst` int(11) NOT NULL,
  `remain_inst` int(11) NOT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `b_id`, `loan_id`, `pay_amount`, `pay_date`, `current_inst`, `remain_inst`, `fine`) VALUES
(1, 1, 1, 5600, '2018-04-15', 1, 7, 0),
(2, 2, 2, 1680, '2018-04-15', 1, 4, 0),
(3, 2, 2, 1680, '2018-05-10', 2, 3, 0),
(4, 1, 1, 5600, '2018-08-30', 2, 6, 112),
(5, 1, 1, 5600, '2022-06-26', 3, 5, 112),
(6, 2, 2, 1680, '2022-06-26', 3, 2, 34),
(7, 2, 2, 1680, '2022-06-26', 4, 1, 34),
(8, 1, 1, 5600, '2022-06-26', 4, 4, 112),
(9, 2, 2, 1680, '2022-06-26', 5, 0, 34),
(10, 1, 1, 5600, '2022-06-30', 5, 3, 112),
(11, 1, 1, 5600, '2022-07-09', 6, 2, 112),
(12, 1, 1, 5600, '2022-07-16', 7, 1, 112),
(13, 1, 1, 5600, '2022-07-23', 8, 0, 112);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `status` enum('Active','Inactive','Banned') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `email`, `pass`, `designation`, `role`, `status`) VALUES
(1, 'Md Niamul Haque', 'head@gmail.com', '202cb962ac59075b964b07152d234b70', 'Head Officer', 3, 'Inactive'),
(2, 'Md Abul Kalam', 'branch@gmail.com', '202cb962ac59075b964b07152d234b70', 'Branch Officer', 2, 'Inactive'),
(3, 'Md Faizul Haque', 'varifier@gmail.com', '202cb962ac59075b964b07152d234b70', 'Varifier', 1, 'Inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_borrower`
--
ALTER TABLE `tbl_borrower`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nid` (`nid`);

--
-- Indexes for table `tbl_interest_rates`
--
ALTER TABLE `tbl_interest_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_liability`
--
ALTER TABLE `tbl_liability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_loan_application`
--
ALTER TABLE `tbl_loan_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mailer`
--
ALTER TABLE `tbl_mailer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_borrower`
--
ALTER TABLE `tbl_borrower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_interest_rates`
--
ALTER TABLE `tbl_interest_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_loan_application`
--
ALTER TABLE `tbl_loan_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_mailer`
--
ALTER TABLE `tbl_mailer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
