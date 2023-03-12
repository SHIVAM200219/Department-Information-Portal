-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2023 at 12:03 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `associated_faculties`
--

CREATE TABLE `associated_faculties` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(28) NOT NULL,
  `EMAIL` varchar(28) NOT NULL,
  `PHONE` varchar(28) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `associated_faculties`
--

INSERT INTO `associated_faculties` (`ID`, `NAME`, `EMAIL`, `PHONE`) VALUES
(1234571, 'Shivam Kumar', 'shivam.ks@iitg.ac.in', '06203011287'),
(2345654, 'Harsh', 'vcxsfg@gmail.com', '654324567654'),
(2345655, 'sai', 'afsdhjk@gmail.com', '05456765678'),
(2345656, 'Ravi Saini', 'ravisaini@gmail.com', '09865778898');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bid` int(28) NOT NULL,
  `bname` varchar(56) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bid`, `bname`) VALUES
(1, 'Harry Potter'),
(2, 'The Jungle Book'),
(3, 'The Diary of a Young Girl'),
(4, 'Panchtantra'),
(5, 'A Passage to India'),
(6, 'To Kill a Mockingbird');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `CId` varchar(28) NOT NULL,
  `CName` varchar(28) DEFAULT NULL,
  `InsId` int(11) DEFAULT NULL,
  `DId` varchar(28) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CId`, `CName`, `InsId`, `DId`) VALUES
('CS221', 'Disrete Math', 1, '2345'),
('DA214', 'DBMS', 2, '1234'),
('DA221', 'Probability', 4, '1234'),
('EE101', 'Electrical Circuit', 5, '4567'),
('MA101', 'Mathematics-I', 3, '3456'),
('ME101', 'Mechanics', 6, '5678');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DID` char(11) NOT NULL,
  `DNAME` varchar(28) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DID`, `DNAME`) VALUES
('1234', 'DSAI'),
('2345', 'CSE'),
('3456', 'MNC'),
('4567', 'EEE'),
('5678', 'Mech');

-- --------------------------------------------------------

--
-- Table structure for table `enrolledin`
--

CREATE TABLE `enrolledin` (
  `CId` varchar(28) DEFAULT NULL,
  `RollNo` varchar(28) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrolledin`
--

INSERT INTO `enrolledin` (`CId`, `RollNo`) VALUES
('CS221', '210150011'),
('CS221', '210150022'),
('DA214', '210150011'),
('DA214', '210150022'),
('DA221', '210150011'),
('DA221', '210150022'),
('EE101', '210101004'),
('EE101', '210101005'),
('EE101', '210102008'),
('EE101', '210150011'),
('EE101', '210150022'),
('EE101', '210102008'),
('EE101', '210102880'),
('MA101', '210150011'),
('MA101', '210102008'),
('MA101', '210102880'),
('MA101', '210150022'),
('ME101', '210102008'),
('ME101', '210101004'),
('ME101', '210101005'),
('ME101', '210102880'),
('ME101', '210150011'),
('ME101', '210150022');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `InsId` int(28) NOT NULL,
  `InsName` varchar(28) DEFAULT NULL,
  `DId` varchar(28) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`InsId`, `InsName`, `DId`) VALUES
(1, 'Ashish Anand', '2345'),
(2, 'Debanga Raj Neog', '1234'),
(3, 'Rupam Bharman', '3456'),
(4, 'Rythm Grover', '1234'),
(5, 'Rohit Sinha', '4567'),
(6, 'Krishna Murthy', '5678');

-- --------------------------------------------------------

--
-- Table structure for table `reserves`
--

CREATE TABLE `reserves` (
  `bid` int(28) NOT NULL,
  `sid` int(28) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserves`
--

INSERT INTO `reserves` (`bid`, `sid`) VALUES
(5, 1),
(4, 2),
(3, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `RollNo` varchar(28) NOT NULL,
  `Name` varchar(28) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`RollNo`, `Name`) VALUES
('210101004', 'Abhishek Kumar'),
('210101005', 'Anil Kumar'),
('210102008', 'Aditya Bhushan'),
('210102065', 'Priyanshu Kumar Raj'),
('210102880', 'Aditya Gupta'),
('210150011', 'Harsh Raj'),
('210150022', 'Shivam Kumar Singh');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `sid` int(28) NOT NULL,
  `sname` varchar(56) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sid`, `sname`) VALUES
(1, 'Aditya'),
(2, 'Priyanshu'),
(3, 'Shivam'),
(4, 'Deepak'),
(5, 'Naveen');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `first_name` varchar(28) NOT NULL,
  `last_name` varchar(28) DEFAULT NULL,
  `gender` varchar(28) NOT NULL,
  `dob` date NOT NULL,
  `email` char(28) NOT NULL,
  `password` char(28) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`first_name`, `last_name`, `gender`, `dob`, `email`, `password`) VALUES
('Shivam', 'Kumar', 'male', '1977-12-02', 'shivam.ks@iitg.ac.in', 'Kumar@200219'),
('Aditya', 'kumar', 'male', '1975-06-02', 'adityasharma6225@gmail.com', 'Aditya@6225'),
('Ravi', 'Saini', 'male', '1977-12-09', 'ravisaini@gmail.com', 'Ravi@123'),
('Aditya', 'Gupta', 'male', '1977-12-09', 'aditya@gmail.com', 'Aditya@123'),
('Naveen', 'Kumar', 'male', '1997-12-03', 'naveen@gmail.com', 'Naveen@123');

-- --------------------------------------------------------

--
-- Table structure for table `works_in`
--

CREATE TABLE `works_in` (
  `ID` int(11) NOT NULL,
  `DID` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `works_in`
--

INSERT INTO `works_in` (`ID`, `DID`) VALUES
(1234571, '1234'),
(2345654, '1234'),
(2345655, '4567'),
(2345656, '4567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `associated_faculties`
--
ALTER TABLE `associated_faculties`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CId`),
  ADD KEY `InsId` (`InsId`),
  ADD KEY `DId` (`DId`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DID`);

--
-- Indexes for table `enrolledin`
--
ALTER TABLE `enrolledin`
  ADD KEY `RollNo` (`RollNo`),
  ADD KEY `CId` (`CId`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`InsId`),
  ADD KEY `DId` (`DId`);

--
-- Indexes for table `reserves`
--
ALTER TABLE `reserves`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`RollNo`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `works_in`
--
ALTER TABLE `works_in`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DID` (`DID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `associated_faculties`
--
ALTER TABLE `associated_faculties`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2345657;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bid` int(28) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `InsId` int(28) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `sid` int(28) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`InsId`) REFERENCES `instructor` (`InsId`),
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`DId`) REFERENCES `department` (`DID`);

--
-- Constraints for table `enrolledin`
--
ALTER TABLE `enrolledin`
  ADD CONSTRAINT `enrolledin_ibfk_1` FOREIGN KEY (`RollNo`) REFERENCES `student` (`RollNo`),
  ADD CONSTRAINT `enrolledin_ibfk_2` FOREIGN KEY (`CId`) REFERENCES `course` (`CId`);

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`DId`) REFERENCES `department` (`DID`);

--
-- Constraints for table `reserves`
--
ALTER TABLE `reserves`
  ADD CONSTRAINT `reserves_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `books` (`bid`),
  ADD CONSTRAINT `reserves_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `students` (`sid`);

--
-- Constraints for table `works_in`
--
ALTER TABLE `works_in`
  ADD CONSTRAINT `works_in_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `associated_faculties` (`ID`),
  ADD CONSTRAINT `works_in_ibfk_2` FOREIGN KEY (`DID`) REFERENCES `department` (`DID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
