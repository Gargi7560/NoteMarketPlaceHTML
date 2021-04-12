-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2021 at 01:11 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notemarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `notedetails`
--

CREATE TABLE `notedetails` (
  `NoteDetailID` int(11) NOT NULL,
  `SellerID` int(11) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `ActionByID` int(11) DEFAULT NULL,
  `AdminRemarks` varchar(255) DEFAULT NULL,
  `PublishedDate` datetime DEFAULT NULL,
  `Title` varchar(100) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `DisplayPicture` varchar(500) DEFAULT NULL,
  `NoteTypeID` int(11) DEFAULT NULL,
  `NumberOfPages` int(11) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `UniversityName` varchar(200) DEFAULT NULL,
  `CountryID` int(11) DEFAULT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `CourseCode` varchar(100) DEFAULT NULL,
  `Professor` varchar(100) DEFAULT NULL,
  `SellingModeID` int(11) NOT NULL,
  `SellingPrice` decimal(5,2) DEFAULT NULL,
  `NotesPreview` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notedetails`
--

INSERT INTO `notedetails` (`NoteDetailID`, `SellerID`, `StatusID`, `ActionByID`, `AdminRemarks`, `PublishedDate`, `Title`, `CategoryID`, `DisplayPicture`, `NoteTypeID`, `NumberOfPages`, `Description`, `UniversityName`, `CountryID`, `Course`, `CourseCode`, `Professor`, `SellingModeID`, `SellingPrice`, `NotesPreview`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(38, 6, 5, 24, 'bad content', NULL, 'Computer Operating System', 2, '../user/UploadedFiles/Members/6/38/DP_Note_38.png', 2, 20, 'Demo', 'University Of Afgan', 3, 'MS-CS', 'C002', 'Mr.Abc', 1, '0.00', '../user/UploadedFiles/Members/6/38/NP_Note_38.pdf', '2021-03-02 11:57:06', 6, '2021-04-03 22:35:59', 24, b'1'),
(53, 6, 4, 1, NULL, NULL, 'Computer Science', 1, '../user/UploadedFiles/Members/6/53/DP_Note_53.png', 3, 100, 'It is great.', 'University Of California', 245, 'Science', 'C003', 'Mr.Xyz', 2, '12.00', '../user/UploadedFiles/Members/6/53/NP_Note_53.pdf', '2021-03-02 13:50:08', 6, '2021-04-10 13:16:40', 1, b'1'),
(54, 6, 1, 1, NULL, NULL, 'Basic Tech India Publication', 4, '../user/UploadedFiles/Members/6/54/DP_Note_54.png', 1, 120, 'It is awesome', 'University Of California', 245, 'Science', 'C004', 'Mr.Abc', 1, '0.00', '../user/UploadedFiles/Members/6/54/NP_Note_54.pdf', '2021-03-02 13:55:03', 6, '2021-02-01 13:55:03', 6, b'1'),
(55, 6, 4, 1, NULL, '2021-01-04 22:01:38', 'Computer Seventh Edition', 2, '../user/UploadedFiles/Members/6/55/DP_Note_55.png', 2, 204, 'It is good', 'Indain institution', 101, 'Computer', 'C001', 'Mr.Xyz', 2, '100.00', '../user/UploadedFiles/Members/6/55/NP_Note_55.pdf', '2021-03-02 13:57:42', 6, '2021-03-02 13:57:42', 6, b'1'),
(56, 6, 4, 1, NULL, '2021-03-01 22:01:50', 'The Principle of Computer Hardware', 1, '../user/UploadedFiles/Members/6/56/DP_Note_56.png', 1, 50, 'It is awesome', 'University Of California', 245, 'MS-CE', 'C002', 'Mr.Abc', 1, '0.00', '../user/UploadedFiles/Members/6/56/NP_Note_56.pdf', '2021-03-02 14:12:30', 6, '2021-03-02 14:12:30', 6, b'1'),
(58, 6, 4, 1, NULL, '2021-03-17 22:02:00', 'Artificial Intelligence', 2, '../user/UploadedFiles/Members/6/58/DP_Note_58.png', 3, 111, 'Final Edition', 'Indain institution', 101, 'Master', 'C003', 'Mr.Xyz', 1, '0.00', '../user/UploadedFiles/Members/6/58/NP_Note_58.pdf', '2021-03-02 14:36:52', 6, '2021-03-02 14:36:52', 6, b'1'),
(59, 6, 4, 1, NULL, '2021-03-02 22:02:07', 'Machine Learning', 2, '../user/UploadedFiles/Members/6/59/DP_Note_59.png', 3, 40, 'Important for exams', 'University Of California', 245, 'Science', 'C004', 'Mr.Abc', 2, '51.00', '../user/UploadedFiles/Members/6/59/NP_Note_59.pdf', '2021-03-02 14:38:54', 6, '2021-03-02 14:38:54', 6, b'1'),
(60, 6, 4, 1, NULL, '2020-12-02 22:02:19', 'Hardware - Computer', 3, '../user/UploadedFiles/Members/6/60/DP_Note_60.png', 1, 180, 'It is great', 'University Of Afgan', 101, 'com', 'C001', 'Mr.Xyz', 1, '0.00', '../user/UploadedFiles/Members/6/60/NP_Note_60.pdf', '2021-03-02 14:41:40', 6, '2021-04-10 10:43:20', 1, b'1'),
(61, 6, 4, 1, NULL, '2021-03-15 14:50:31', 'Software - Computer', 1, '../user/UploadedFiles/Members/6/61/DP_Note_61.png', 2, 230, 'It is an imp.', 'University Of Afgan', 101, 'Networking', 'C002', 'Mr.Abc', 2, '50.00', '../user/UploadedFiles/Members/6/61/NP_Note_61.pdf', '2021-03-02 14:45:34', 6, '2021-03-02 14:45:34', 6, b'1'),
(62, 10, 5, 1, 'not proper data', NULL, 'Computer Network ', 2, '../user/UploadedFiles/Members/10/62/DP_Note_62.png', 2, 100, 'It is very good.', 'Indain institution', 101, 'MS-CS', 'C001', 'Mr. Xyz', 2, '15.00', '../user/UploadedFiles/Members/10/62/NP_Note_62.pdf', '2021-03-02 14:55:15', 10, '2021-04-03 22:33:26', 24, b'1'),
(63, 10, 4, 1, NULL, '2021-03-15 14:51:12', 'The Principle of Deep Learning', 4, '../user/UploadedFiles/Members/10/63/DP_Note_63.png', 1, 450, 'It is awesome.', 'Oxford', 240, 'Science', 'C003', 'Mr.Xyz', 2, '12.00', '../user/UploadedFiles/Members/10/63/NP_Note_63.pdf', '2021-03-02 14:59:47', 10, '2021-03-02 14:59:47', 10, b'1'),
(64, 10, 6, 1, 'not proper data', '2021-03-01 21:04:34', 'Cyber Security And Networking', 1, '../user/UploadedFiles/Members/10/64/DP_Note_64.png', 3, 300, 'It is helpful.', 'Indain institution', 101, 'Commerce', 'C004', '', 1, '0.00', '../user/UploadedFiles/Members/10/64/NP_Note_64.pdf', '2021-03-11 20:09:42', 10, '2021-03-11 20:09:42', 10, b'1'),
(65, 7, 3, 1, NULL, NULL, 'U7 com', 4, '../user/UploadedFiles/Members/7/65/DP_Note_65.png', 2, 170, 'Relating to COM', 'Indain institution', 101, 'MA', 'C007', 'Mr. Xyz', 1, '0.00', '../user/UploadedFiles/Members/7/65/NP_Note_65.pdf', '2021-03-27 14:01:44', 7, '2021-04-05 13:08:14', 24, b'1'),
(66, 7, 4, 1, NULL, '2021-03-27 14:47:09', 'U7 commerce', 4, '../user/UploadedFiles/Members/7/66/DP_Note_66.png', 2, 70, 'Relating to CA', 'Indain institution', 101, 'MBA', 'C007', 'Mr. Xyz', 1, '0.00', '../user/UploadedFiles/Members/7/66/NP_Note_66.pdf', '2021-03-27 14:02:20', 7, '2021-04-05 13:08:14', 24, b'1'),
(67, 9, 4, 1, NULL, '2021-03-26 14:47:47', 'U9 Arts', 3, '../user/UploadedFiles/Members/9/67/DP_Note_67.jpg', 3, 150, 'Arts related', 'USA College', 228, 'Arts ', 'C009', 'Mr.Abc', 2, '50.00', '../user/UploadedFiles/Members/9/67/NP_Note_67.pdf', '2021-03-27 14:31:54', 9, '2021-03-27 14:31:54', 9, b'1'),
(68, 9, 1, 1, NULL, NULL, 'U9 Information Technology', 1, '../user/UploadedFiles/Members/9/68/DP_Note_68.png', 1, 100, 'Useful in IT', 'London university', 210, 'CE', 'C009', 'Mr. Xyz', 1, '0.00', '../user/UploadedFiles/Members/9/68/NP_Note_68.pdf', '2021-03-27 14:34:35', 9, '2021-03-27 14:34:35', 9, b'1'),
(69, 6, 4, 1, NULL, NULL, 'Path Checking', 2, '../user/UploadedFiles/Members/6/69/DP_Note_69.png', 1, 100, '                   path                 ', '', NULL, '', '', '', 1, '0.00', '../user/UploadedFiles/Members/6/69/NP_Note_69.pdf', '2021-04-10 16:46:19', 6, '2021-04-10 16:46:19', 6, b'1'),
(70, 6, 4, 1, NULL, NULL, 'Final note', 7, '../user/UploadedFiles/Members/6/70/DP_Note_70.png', 1, 200, 'Final note for desc', 'Indain institution', 101, 'MS-CS', 'C002', 'Mr. Xyz', 2, '12.00', '../user/UploadedFiles/Members/6/70/NP_Note_70.pdf', '2021-04-10 18:46:27', 6, '2021-04-10 18:46:27', 6, b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notedetails`
--
ALTER TABLE `notedetails`
  ADD PRIMARY KEY (`NoteDetailID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `SellingModeID` (`SellingModeID`),
  ADD KEY `StatusID` (`StatusID`),
  ADD KEY `ActionByID` (`ActionByID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `NoteTypeID` (`NoteTypeID`),
  ADD KEY `CountryID` (`CountryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notedetails`
--
ALTER TABLE `notedetails`
  MODIFY `NoteDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notedetails`
--
ALTER TABLE `notedetails`
  ADD CONSTRAINT `notedetails_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `notedetails_ibfk_2` FOREIGN KEY (`SellingModeID`) REFERENCES `referencedata` (`ReferenceDataID`),
  ADD CONSTRAINT `notedetails_ibfk_3` FOREIGN KEY (`StatusID`) REFERENCES `referencedata` (`ReferenceDataID`),
  ADD CONSTRAINT `notedetails_ibfk_4` FOREIGN KEY (`ActionByID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `notedetails_ibfk_5` FOREIGN KEY (`CategoryID`) REFERENCES `notecategories` (`NoteCategoryID`),
  ADD CONSTRAINT `notedetails_ibfk_6` FOREIGN KEY (`NoteTypeID`) REFERENCES `notetypes` (`NoteTypeID`),
  ADD CONSTRAINT `notedetails_ibfk_7` FOREIGN KEY (`CountryID`) REFERENCES `countries` (`CountryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
