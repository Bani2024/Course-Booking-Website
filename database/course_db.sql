-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 06:16 PM
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
-- Database: `course_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_forms`
--

CREATE TABLE `admission_forms` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date_month` varchar(20) NOT NULL,
  `birth_date_day` int(11) NOT NULL,
  `birth_date_year` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `state` varchar(100) NOT NULL,
  `high_school` varchar(255) NOT NULL,
  `marks_10th` decimal(5,2) NOT NULL,
  `marks_12th` decimal(5,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_forms`
--

INSERT INTO `admission_forms` (`id`, `first_name`, `last_name`, `birth_date_month`, `birth_date_day`, `birth_date_year`, `gender`, `citizenship`, `phone`, `email`, `address`, `city`, `zip_code`, `state`, `high_school`, `marks_10th`, `marks_12th`, `category`, `course`, `status`, `created_at`) VALUES
(13, 'SNEHAL', 'DAS', '10', 12, 2002, 'Male', 'India', '9002304634', 'SNEHALDAS01@GMAIL.COM', 'GURUDWARA ROAD, BENACHITY', 'DURGAPUR', '713205', 'WEST-BENGAL', 'NIRJHAR DAY BOARDING HIGHER SECONDARY SCHOOL', 85.00, 78.00, 'AI & ML', 'Advanced Certificate Program in GenerativeAl ', 'Pending', '2023-12-15 04:58:01'),
(14, 'RISHITA', 'MAJUMDER', '07', 26, 2003, 'Female', 'India', '7076371802', 'RISHITAMAJUMDER1@GMAIL.COM', 'MARCONY,CHANDIDAS', 'DURGAPUR', '713204', 'WESTBENGAL', 'NIRJHAR DAY BOARDING HIGHER SECONDARY SCHOOL', 87.00, 72.00, 'AI & ML', 'MS in Machine Learning & Al ', 'Pending', '2023-12-15 05:02:43'),
(15, 'SATYA SUNDAR ', 'SEN', '08', 3, 2003, 'Male', 'India', '9832183816', 'SATYASUNDARSEN.PNG@GMAIL.COM', 'PANAGARH BAZAR', 'PANAGARH', '713148', 'WEST-BENGAL', 'KANKSA HIGH SCHOOL', 80.00, 79.00, 'AI & ML', 'MS in Machine Learning & Al ', 'Pending', '2023-12-15 05:10:43'),
(16, 'SARBANI', 'BHATTACHARJEE', '06', 22, 2003, 'Female', 'India', '8392085817', 'SARBANIBHATTA@GMAIL.COM', 'PANAGARH BAJAR', 'PANAGARH', '713148', 'WEST-BENGAL', 'KANKSA GIRLS HIGH SCHOOL', 82.00, 78.00, 'AI & ML', 'Advanced Certificate Program in GenerativeAl ', 'Not Approved', '2023-12-15 05:15:24'),
(17, 'SHREYASI', 'MUKHERJEE', '04', 3, 2003, 'Female', 'India', '9733647313', 'SHREYASHIMUKHERJEE@GMAIL.COM', 'FULJHOR', 'DURGAPUR', '713205', 'WEST-BENGAL', 'KENDRIYA VIDAYALAYA CRF DURGAPUR HIGH SCHOOL', 76.00, 82.00, 'AI & ML', 'MS in Machine Learning & Al ', 'Approved', '2023-12-15 05:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(53, 'MBA'),
(54, 'Doctorate'),
(55, 'AI & ML'),
(56, 'Law'),
(57, 'Software & Tech'),
(58, 'Data Science'),
(59, 'Management'),
(60, 'Bootcamps');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` text NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `image_url`, `category_id`) VALUES
(76, 'Advanced Certificate Program in GenerativeAl ', '5 Months Build 5+ Generative Al projects', '657b81628c8ea_3.png', 55),
(77, 'MS in Machine Learning & Al ', '18 Months Dual Credentials from IIITB & LJMIJ', '657b8194a2f10_2.png', 55),
(78, 'Doctor of Juridical Science(SJD) ', '36 Months \r\nScholarship For 5000 Students', '657c566cf1fbb_4.png', 56);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `username`, `password`, `email`) VALUES
(0, 'satya', '123456', 'satyasundar@gmail.com'),
(1, 'snehal', '123456', 'snehaldas@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `email`, `contact`) VALUES
(0, 'upgrad@gmail.com', '+91 9002304634');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`) VALUES
(1, 'Administration', 'admin1234', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_forms`
--
ALTER TABLE `admission_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_courses_categories` (`category_id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
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
-- AUTO_INCREMENT for table `admission_forms`
--
ALTER TABLE `admission_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_courses_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
