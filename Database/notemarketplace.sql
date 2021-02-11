-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2021 at 04:26 PM
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
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `CountryID` int(11) NOT NULL,
  `CountryName` varchar(100) NOT NULL,
  `CountryCode` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `downloadnotes`
--

CREATE TABLE `downloadnotes` (
  `DownloadNoteID` int(11) NOT NULL,
  `NoteDetailID` int(11) NOT NULL,
  `SellerID` int(11) NOT NULL,
  `DownloaderID` int(11) NOT NULL,
  `IsSellerHasAllowedDownload` bit(1) NOT NULL,
  `AttachmentPath` varchar(255) DEFAULT NULL,
  `IsAttachmentDownloaded` bit(1) NOT NULL,
  `AttachmentDownloadedDate` datetime DEFAULT NULL,
  `IsPaid` bit(1) NOT NULL,
  `PurchasedPrice` decimal(5,2) DEFAULT NULL,
  `NoteTitle` varchar(100) NOT NULL,
  `NoteCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notecategories`
--

CREATE TABLE `notecategories` (
  `NoteCategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `notesattachments`
--

CREATE TABLE `notesattachments` (
  `NotesAttachmentID` int(11) NOT NULL,
  `NoteDetailID` int(11) NOT NULL,
  `FileName` varchar(100) NOT NULL,
  `FilePath` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notesreportedissues`
--

CREATE TABLE `notesreportedissues` (
  `NotesReportedIssuesID` int(11) NOT NULL,
  `NoteDetailID` int(11) NOT NULL,
  `ReportedByID` int(11) NOT NULL,
  `AgainstDownloadID` int(11) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notesreviews`
--

CREATE TABLE `notesreviews` (
  `NotesReviewID` int(11) NOT NULL,
  `NoteDetailID` int(11) NOT NULL,
  `ReviewedByID` int(11) NOT NULL,
  `AgainstDownloadsID` int(11) NOT NULL,
  `Ratings` decimal(5,2) NOT NULL,
  `Comments` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notetypes`
--

CREATE TABLE `notetypes` (
  `NoteTypeID` int(11) NOT NULL,
  `TypeName` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `referencedata`
--

CREATE TABLE `referencedata` (
  `ReferenceDataID` int(11) NOT NULL,
  `Value` varchar(100) NOT NULL,
  `DataValue` varchar(100) NOT NULL,
  `ReferenceCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `systemconfiguration`
--

CREATE TABLE `systemconfiguration` (
  `SystemConfigurationID` int(11) NOT NULL,
  `Key` varchar(100) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userpofiledetails`
--

CREATE TABLE `userpofiledetails` (
  `UserProfileDetailID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DOB` datetime DEFAULT NULL,
  `GenderID` int(11) DEFAULT NULL,
  `SecondaryEmailAddress` varchar(100) NOT NULL,
  `PhoneNumber-CountryID` int(11) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `ProfilePicture` varchar(500) DEFAULT NULL,
  `AddressLine1` varchar(100) NOT NULL,
  `AddressLine2` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZipCode` varchar(50) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `University` varchar(100) DEFAULT NULL,
  `College` varchar(100) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `UserRoleID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserRoleID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `Password` varchar(24) NOT NULL,
  `IsEmailVerified` bit(1) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`CountryID`);

--
-- Indexes for table `downloadnotes`
--
ALTER TABLE `downloadnotes`
  ADD PRIMARY KEY (`DownloadNoteID`),
  ADD KEY `NoteDetailID` (`NoteDetailID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `DownloaderID` (`DownloaderID`);

--
-- Indexes for table `notecategories`
--
ALTER TABLE `notecategories`
  ADD PRIMARY KEY (`NoteCategoryID`);

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
-- Indexes for table `notesattachments`
--
ALTER TABLE `notesattachments`
  ADD PRIMARY KEY (`NotesAttachmentID`),
  ADD KEY `NoteDetailID` (`NoteDetailID`);

--
-- Indexes for table `notesreportedissues`
--
ALTER TABLE `notesreportedissues`
  ADD PRIMARY KEY (`NotesReportedIssuesID`),
  ADD KEY `NoteDetailID` (`NoteDetailID`),
  ADD KEY `ReportedByID` (`ReportedByID`),
  ADD KEY `AgainstDownloadID` (`AgainstDownloadID`);

--
-- Indexes for table `notesreviews`
--
ALTER TABLE `notesreviews`
  ADD PRIMARY KEY (`NotesReviewID`),
  ADD KEY `NoteDetailID` (`NoteDetailID`),
  ADD KEY `ReviewedByID` (`ReviewedByID`),
  ADD KEY `AgainstDownloadsID` (`AgainstDownloadsID`);

--
-- Indexes for table `notetypes`
--
ALTER TABLE `notetypes`
  ADD PRIMARY KEY (`NoteTypeID`);

--
-- Indexes for table `referencedata`
--
ALTER TABLE `referencedata`
  ADD PRIMARY KEY (`ReferenceDataID`);

--
-- Indexes for table `systemconfiguration`
--
ALTER TABLE `systemconfiguration`
  ADD PRIMARY KEY (`SystemConfigurationID`);

--
-- Indexes for table `userpofiledetails`
--
ALTER TABLE `userpofiledetails`
  ADD PRIMARY KEY (`UserProfileDetailID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `GenderID` (`GenderID`),
  ADD KEY `PhoneNumber-CountryID` (`PhoneNumber-CountryID`),
  ADD KEY `CountryID` (`CountryID`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`UserRoleID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `UserRoleID` (`UserRoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `CountryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `downloadnotes`
--
ALTER TABLE `downloadnotes`
  MODIFY `DownloadNoteID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notecategories`
--
ALTER TABLE `notecategories`
  MODIFY `NoteCategoryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notedetails`
--
ALTER TABLE `notedetails`
  MODIFY `NoteDetailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notesattachments`
--
ALTER TABLE `notesattachments`
  MODIFY `NotesAttachmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notesreportedissues`
--
ALTER TABLE `notesreportedissues`
  MODIFY `NotesReportedIssuesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notesreviews`
--
ALTER TABLE `notesreviews`
  MODIFY `NotesReviewID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notetypes`
--
ALTER TABLE `notetypes`
  MODIFY `NoteTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referencedata`
--
ALTER TABLE `referencedata`
  MODIFY `ReferenceDataID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `systemconfiguration`
--
ALTER TABLE `systemconfiguration`
  MODIFY `SystemConfigurationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userpofiledetails`
--
ALTER TABLE `userpofiledetails`
  MODIFY `UserProfileDetailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `UserRoleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloadnotes`
--
ALTER TABLE `downloadnotes`
  ADD CONSTRAINT `downloadnotes_ibfk_1` FOREIGN KEY (`NoteDetailID`) REFERENCES `notedetails` (`NoteDetailID`),
  ADD CONSTRAINT `downloadnotes_ibfk_2` FOREIGN KEY (`SellerID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `downloadnotes_ibfk_3` FOREIGN KEY (`DownloaderID`) REFERENCES `users` (`UserID`);

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

--
-- Constraints for table `notesattachments`
--
ALTER TABLE `notesattachments`
  ADD CONSTRAINT `notesattachments_ibfk_1` FOREIGN KEY (`NoteDetailID`) REFERENCES `notedetails` (`NoteDetailID`);

--
-- Constraints for table `notesreportedissues`
--
ALTER TABLE `notesreportedissues`
  ADD CONSTRAINT `notesreportedissues_ibfk_1` FOREIGN KEY (`NoteDetailID`) REFERENCES `notedetails` (`NoteDetailID`),
  ADD CONSTRAINT `notesreportedissues_ibfk_2` FOREIGN KEY (`ReportedByID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `notesreportedissues_ibfk_3` FOREIGN KEY (`AgainstDownloadID`) REFERENCES `downloadnotes` (`DownloadNoteID`);

--
-- Constraints for table `notesreviews`
--
ALTER TABLE `notesreviews`
  ADD CONSTRAINT `notesreviews_ibfk_1` FOREIGN KEY (`NoteDetailID`) REFERENCES `notedetails` (`NoteDetailID`),
  ADD CONSTRAINT `notesreviews_ibfk_2` FOREIGN KEY (`ReviewedByID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `notesreviews_ibfk_3` FOREIGN KEY (`AgainstDownloadsID`) REFERENCES `downloadnotes` (`DownloadNoteID`);

--
-- Constraints for table `userpofiledetails`
--
ALTER TABLE `userpofiledetails`
  ADD CONSTRAINT `userpofiledetails_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `userpofiledetails_ibfk_2` FOREIGN KEY (`GenderID`) REFERENCES `referencedata` (`ReferenceDataID`),
  ADD CONSTRAINT `userpofiledetails_ibfk_4` FOREIGN KEY (`PhoneNumber-CountryID`) REFERENCES `countries` (`CountryID`),
  ADD CONSTRAINT `userpofiledetails_ibfk_5` FOREIGN KEY (`CountryID`) REFERENCES `countries` (`CountryID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`UserRoleID`) REFERENCES `userroles` (`UserRoleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
