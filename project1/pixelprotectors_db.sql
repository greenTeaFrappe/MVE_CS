-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 19, 2025 at 03:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(1, 'Cybersecurity Specialist', 'Protect computers and data from hackers. As a cybersecurity specialist you will help maintain secure infrastructures and manage cyber attacks. You will work under and report to our Security Director.', 'Maintain infrastructures for secure data storage\r\nRespond to cyber threats\r\nImplement malware software\r\nUse appropriate cyber security tools\r\nCollaborate with the security team to create and analyse evasion tactics', 'Teamwork skills\r\nMinimum 3 years experience in a similar role\r\nMinimum academic requirement - Bachelors Degree in Cybersecurity or adjacent;\r\nExperience with programming languages including:\r\n- JavaScript\r\n- Python\r\n- SQL\r\nKnowledge of Linux operating system', '90,000 - 110,000', 'CSS01'),
(2, 'Data Analyst', 'Working with us as a Data Analyst you will process and interpret data to help us make informed decisions. You will work in the Data Analysis team, under the guidance of a Senior Analyst.', 'Maintain exisiting infrastructures\r\nCollect, clean, analyse and interpret data\r\nAnalyse data to identify trends\r\nHelp improve reliability and efficiency of analysis models\r\nProvide reports on performance and analytics', 'Attention to detail\r\nMinimum 2 years experience in a similar role\r\nMinimum academic requirement - Bachelors Degree in Data Science or adjacent\r\nExperience with the following languages:\r\n- SQL\r\n- R\r\nExperience with Tableau\r\nKnowledge of Linux operating system', '65,000 - 80,000', 'DA002'),
(3, 'Software Engineer', 'Update old and program new software to improve business performance. You will work on projects with a programming team, and report to a Project Manager.', 'Maintain and debug software programs\r\nWork on projects in cross-departmental teams\r\nImprove software performance and optimise programs\r\nApply testing and quality assurance\r\nAdhere to programming standards', 'Good teamwork skills\r\nMinimum 2 years experience in a similar role\r\nMinimum academic requirement - Bachelors Degree in Computer Science or adjacent\r\nExperience with the following languages:\r\n- JavaScript\r\n- Python\r\n- C++\r\nGreat problem solving skills', '82,000 - 110,000', 'SE003');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
