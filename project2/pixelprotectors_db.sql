-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 24, 2025 at 06:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pixelprotectors_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `JobReferenceNumber` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `StreetAddress` varchar(100) NOT NULL,
  `Suburb` varchar(50) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Postcode` varchar(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Python` varchar(50) DEFAULT NULL,
  `Adobe_Illustrator` varchar(50) DEFAULT NULL,
  `JAVA` varchar(50) DEFAULT NULL,
  `MySQL` varchar(50) DEFAULT NULL,
  `OtherSkills` text DEFAULT NULL,
  `Status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `JobReferenceNumber`, `FirstName`, `LastName`, `StreetAddress`, `Suburb`, `State`, `Postcode`, `Email`, `PhoneNumber`, `Python`, `Adobe_Illustrator`, `JAVA`, `MySQL`, `OtherSkills`, `Status`) VALUES
(1, '01_CybersecuritySpecialist', 'John', 'Smith', '38 Hutton Street', 'Melbourne', 'VIC', '3038', 'john.smith@gmail.com', '0492837405', 'Yes', 'No', 'Yes', 'Yes', 'HTML, CSS, PHP', 'New'),
(2, '01_CybersecuritySpecialist', 'Alice', 'Johnson', '123 Cyber St', 'Melbourne', 'VIC', '3000', 'alice.johnson@example.com', '0412345678', 'Yes', 'No', 'Yes', 'Yes', 'Network Security, Ethical Hacking', 'New'),
(3, '02_DataAnalyst', 'Bob', 'Smith', '456 Data Ave', 'Sydney', 'NSW', '2000', 'bob.smith@example.com', '0423456789', 'Yes', 'No', 'Yes', 'No', 'Data Visualization, SQL', 'New'),
(4, '03_SoftwareEngineer', 'Charlie', 'Brown', '789 Dev Rd', 'Brisbane', 'QLD', '4000', 'charlie.brown@example.com', '0434567890', 'No', 'Yes', 'Yes', 'Yes', 'UI/UX Design, JavaScript', 'New'),
(5, '01_CybersecuritySpecialist', 'Diana', 'White', '101 Secure Ln', 'Perth', 'WA', '6000', 'diana.white@example.com', '0445678901', 'Yes', 'No', 'No', 'Yes', 'Penetration Testing, Firewalls', 'New'),
(6, '02_DataAnalyst', 'Eve', 'Davis', '202 Insight Blvd', 'Adelaide', 'SA', '5000', 'eve.davis@example.com', '0456789012', 'Yes', 'No', 'Yes', 'Yes', 'Big Data, Machine Learning', 'New'),
(7, '03_SoftwareEngineer', 'Frank', 'Miller', '303 Code Pkwy', 'Hobart', 'TAS', '7000', 'frank.miller@example.com', '0467890123', 'No', 'Yes', 'Yes', 'No', 'Agile Development, Python', 'New'),
(8, '01_CybersecuritySpecialist', 'Grace', 'Wilson', '404 Secure Rd', 'Canberra', 'ACT', '2600', 'grace.wilson@example.com', '0478901234', 'Yes', 'No', 'Yes', 'Yes', 'Cryptography, Incident Response', 'New'),
(9, '02_DataAnalyst', 'Hank', 'Moore', '505 Data Ln', 'Darwin', 'NT', '0800', 'hank.moore@example.com', '0489012345', 'Yes', 'No', 'No', 'Yes', 'Data Mining, Predictive Analytics', 'New'),
(10, '03_SoftwareEngineer', 'Ivy', 'Taylor', '606 Dev Blvd', 'Gold Coast', 'QLD', '4217', 'ivy.taylor@example.com', '0490123456', 'No', 'Yes', 'Yes', 'Yes', 'Cloud Computing, Java', 'New'),
(11, '01_CybersecuritySpecialist', 'Jack', 'Anderson', '707 Secure St', 'Newcastle', 'NSW', '2300', 'jack.anderson@example.com', '0501234567', 'Yes', 'No', 'Yes', 'Yes', 'Threat Analysis, Risk Management', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `responsibilites` text NOT NULL,
  `requirements` text NOT NULL,
  `salary` varchar(25) NOT NULL,
  `ref_number` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `description`, `responsibilites`, `requirements`, `salary`, `ref_number`) VALUES
(1, 'Cybersecurity Specialist', 'Protect computers and data from hackers. As a cybersecurity specialist you will help maintain secure infrastructures and manage cyber attacks. You will work under and report to our Security Director.', 'Maintain infrastructures for secure data storage\r\nRespond to cyber threats\r\nImplement malware software\r\nUse appropriate cyber security tools\r\nCollaborate with the security team to create and analyse evasion tactics', 'Teamwork skills\r\nMinimum 3 years experience in a similar role\r\nMinimum academic requirement - Bachelors Degree in Cybersecurity or adjacent\r\nExperience with programming languages including:\r\n- JavaScript\r\n- Python\r\n- SQL\r\nKnowledge of Linux operating system', '90,000 - 110,000', 'CSS01'),
(2, 'Data Analyst', 'Working with us as a Data Analyst you will process and interpret data to help us make informed decisions. You will work in the Data Analysis team, under the guidance of a Senior Analyst.', 'Maintain exisiting infrastructures\r\nCollect, clean, analyse and interpret data\r\nAnalyse data to identify trends\r\nHelp improve reliability and efficiency of analysis models\r\nProvide reports on performance and analytics', 'Attention to detail\r\nMinimum 2 years experience in a similar role\r\nMinimum academic requirement - Bachelors Degree in Data Science or adjacent\r\nExperience with the following languages:\r\n- SQL\r\n- R\r\nExperience with Tableau\r\nKnowledge of Linux operating system', '65,000 - 80,000', 'DA002'),
(3, 'Software Engineer', 'Update old and program new software to improve business performance. You will work on projects with a programming team, and report to a Project Manager.', 'Maintain and debug software programs\r\nWork on projects in cross-departmental teams\r\nImprove software performance and optimise programs\r\nApply testing and quality assurance\r\nAdhere to programming standards', 'Good teamwork skills\r\nMinimum 2 years experience in a similar role\r\nMinimum academic requirement - Bachelors Degree in Computer Science or adjacent\r\nExperience with the following languages:\r\n- JavaScript\r\n- Python\r\n- C++\r\nGreat problem solving skills', '82,000 - 110,000', 'SE003');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('PixelProtectors_Admin', 'PP_0208');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
