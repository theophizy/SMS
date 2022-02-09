-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2020 at 07:29 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms_v001`
--

-- --------------------------------------------------------

--
-- Table structure for table `sms_average_scores`
--

CREATE TABLE `sms_average_scores` (
  `avg_code` varchar(90) NOT NULL,
  `student_no` varchar(90) DEFAULT NULL,
  `avg_class` int(11) DEFAULT NULL,
  `avg_class_arm` int(11) DEFAULT NULL,
  `avg_term` int(11) DEFAULT NULL,
  `avg_session` int(11) DEFAULT NULL,
  `avg_total_marks` varchar(10) DEFAULT NULL,
  `student_average` double NOT NULL,
  `attendance` double NOT NULL,
  `days_school_opened` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_class`
--

CREATE TABLE `sms_class` (
  `class_code` bigint(20) NOT NULL,
  `class_name` varchar(45) DEFAULT NULL,
  `class_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_class`
--

INSERT INTO `sms_class` (`class_code`, `class_name`, `class_status`) VALUES
(1, 'JSS1', 'ACTIVE'),
(2, 'JSS2', 'ACTIVE'),
(3, 'JSS3', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `sms_classarm`
--

CREATE TABLE `sms_classarm` (
  `class_arm_code` bigint(20) NOT NULL,
  `class_arm_name` varchar(15) DEFAULT NULL,
  `class_arm_status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_classarm`
--

INSERT INTO `sms_classarm` (`class_arm_code`, `class_arm_name`, `class_arm_status`) VALUES
(1, 'A', 'ACTIVE'),
(2, 'B', 'ACTIVE'),
(3, 'C', 'ACTIVE'),
(4, 'D', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `sms_class_subjects`
--

CREATE TABLE `sms_class_subjects` (
  `class_sub_code` varchar(90) NOT NULL,
  `class_sub_class_code` varchar(45) DEFAULT NULL,
  `class_sub_subject_code` varchar(45) DEFAULT NULL,
  `class_sub_class_arm` varchar(25) DEFAULT NULL,
  `class_sub_status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_class_subjects`
--

INSERT INTO `sms_class_subjects` (`class_sub_code`, `class_sub_class_code`, `class_sub_subject_code`, `class_sub_class_arm`, `class_sub_status`) VALUES
('AGRIC2785911', '1', 'AGRIC27859', '1', 'ACTIVE'),
('AGRIC2785912', '1', 'AGRIC27859', '2', 'ACTIVE'),
('AGRIC2785923', '2', 'AGRIC27859', '3', 'ACTIVE'),
('BUS9365811', '1', 'BUS93658', '1', 'ACTIVE'),
('BUS9365812', '1', 'BUS93658', '2', 'ACTIVE'),
('CIVIL5492511', '1', 'CIVIL54925', '1', 'ACTIVE'),
('CIVIL5492523', '2', 'CIVIL54925', '3', 'ACTIVE'),
('ENG7503611', '1', 'ENG75036', '1', 'ACTIVE'),
('ENG7503612', '1', 'ENG75036', '2', 'ACTIVE'),
('INT9161623', '2', 'INT91616', '3', 'ACTIVE'),
('LIT2933211', '1', 'LIT29332', '1', 'ACTIVE'),
('LIT2933212', '1', 'LIT29332', '2', 'ACTIVE'),
('MATH9402223', '2', 'MATH94022', '3', 'ACTIVE'),
('PHY9532312', '1', 'PHY95323', '2', 'ACTIVE'),
('SOC7194311', '1', 'SOC71943', '1', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `sms_cognitive`
--

CREATE TABLE `sms_cognitive` (
  `cog_id` bigint(20) NOT NULL,
  `cog_name` varchar(145) DEFAULT NULL,
  `cog_status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_cognitive`
--

INSERT INTO `sms_cognitive` (`cog_id`, `cog_name`, `cog_status`) VALUES
(1, 'Honesty', 'ACTIVE'),
(2, 'Integrity', 'ACTIVE'),
(3, 'Attentiveness', 'ACTIVE'),
(4, 'Neatness', 'ACTIVE'),
(5, 'Punctuality', 'ACTIVE'),
(6, 'Reliable', 'ACTIVE'),
(7, 'Perseverance', 'ACTIVE'),
(8, 'Relationship with staff', 'ACTIVE'),
(9, 'Sense of responsibility', 'ACTIVE'),
(10, 'Politness', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `sms_cognitive_student`
--

CREATE TABLE `sms_cognitive_student` (
  `cog_student_id` varchar(45) NOT NULL,
  `cog_student_reg` varchar(15) NOT NULL,
  `cognitive_id` int(11) DEFAULT NULL,
  `cog_student_item` int(11) DEFAULT NULL,
  `cog_student_class` int(11) DEFAULT NULL,
  `cog_student_session` int(11) NOT NULL,
  `cog_student_term` int(11) NOT NULL,
  `cog_student_status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_exam_type`
--

CREATE TABLE `sms_exam_type` (
  `exam_code` bigint(20) NOT NULL,
  `exam_name` varchar(45) DEFAULT NULL,
  `exam_marks` int(11) DEFAULT NULL,
  `exam_status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_exam_type`
--

INSERT INTO `sms_exam_type` (`exam_code`, `exam_name`, `exam_marks`, `exam_status`) VALUES
(1, 'CA1', 10, 'ACTIVE'),
(2, 'CA2', 10, 'ACTIVE'),
(3, 'CA3', 10, 'ACTIVE'),
(4, 'EXAM', 70, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `sms_formaster`
--

CREATE TABLE `sms_formaster` (
  `formaster_code` varchar(50) NOT NULL,
  `formaster_staffid` varchar(45) DEFAULT NULL,
  `formaster_class_code` varchar(45) DEFAULT NULL,
  `formaster_class_arm` varchar(25) DEFAULT NULL,
  `formaster_status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_grade`
--

CREATE TABLE `sms_grade` (
  `grade_code` bigint(20) NOT NULL,
  `grade_min_mark` int(5) DEFAULT NULL,
  `grade_max_mark` int(5) DEFAULT NULL,
  `grade_name` varchar(25) DEFAULT NULL,
  `grade_remark` varchar(90) DEFAULT NULL,
  `grade_status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_grade`
--

INSERT INTO `sms_grade` (`grade_code`, `grade_min_mark`, `grade_max_mark`, `grade_name`, `grade_remark`, `grade_status`) VALUES
(1, 0, 39, 'F', 'FAIL', 'ACTIVE'),
(2, 40, 45, 'E', 'POOR', 'ACTIVE'),
(3, 46, 49, 'D', 'FAIR', 'ACTIVE'),
(4, 50, 64, 'C', 'GOOD', 'ACTIVE'),
(5, 65, 74, 'B', 'VERY GOOD', 'ACTIVE'),
(6, 75, 100, 'A', 'EXCELLENT', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `sms_house`
--

CREATE TABLE `sms_house` (
  `house_code` bigint(20) NOT NULL,
  `house_name` varchar(90) DEFAULT NULL,
  `house_status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_school_setup`
--

CREATE TABLE `sms_school_setup` (
  `school_id` bigint(20) NOT NULL,
  `school_name` varchar(245) DEFAULT NULL,
  `school_address` text,
  `school_phone` varchar(15) DEFAULT NULL,
  `school_email` varchar(90) DEFAULT NULL,
  `school_logo` blob,
  `school_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_school_setup`
--

INSERT INTO `sms_school_setup` (`school_id`, `school_name`, `school_address`, `school_phone`, `school_email`, `school_logo`, `school_status`) VALUES
(1, 'MOUNT SAINT GABRIEL MAKURDI', '           No 46 Ernest Attah Street Wadata, Makurdi Benue State.', '07089831214', 'anandetheophizy04@gmail.com', 0x2e2e2f696d61676575706c6f61642f6c6f676f2e6a7067, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `sms_scores`
--

CREATE TABLE `sms_scores` (
  `score_code` varchar(240) NOT NULL,
  `score_student_regno` varchar(90) DEFAULT NULL,
  `score_subject_code` varchar(100) DEFAULT NULL,
  `score_class` bigint(20) DEFAULT NULL,
  `score_class_arm` bigint(20) DEFAULT NULL,
  `score_CA1` varchar(5) DEFAULT NULL,
  `score_CA2` varchar(5) DEFAULT NULL,
  `score_CA3` varchar(5) DEFAULT NULL,
  `score_exam` varchar(5) DEFAULT NULL,
  `score_total` varchar(5) DEFAULT NULL,
  `score_grade` int(11) DEFAULT NULL,
  `score_term` int(11) DEFAULT NULL,
  `score_session` int(11) DEFAULT NULL,
  `score_by` varchar(100) DEFAULT NULL,
  `score_date` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_session`
--

CREATE TABLE `sms_session` (
  `session_code` bigint(20) NOT NULL,
  `session_description` varchar(45) DEFAULT NULL,
  `session_status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_session`
--

INSERT INTO `sms_session` (`session_code`, `session_description`, `session_status`) VALUES
(1, '2017/2018', 'ACTIVE'),
(2, '2018/2019', 'ACTIVE'),
(3, '2019/2020', 'ACTIVE'),
(4, '2020/2021', 'ACTIVE'),
(5, '2021/2022', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `sms_staff_subject`
--

CREATE TABLE `sms_staff_subject` (
  `staff_subject_code` varchar(90) NOT NULL,
  `staff_subject_staffid` varchar(45) DEFAULT NULL,
  `staff_subject_sub_code` varchar(25) DEFAULT NULL,
  `staff_subject_status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_students`
--

CREATE TABLE `sms_students` (
  `student_regno` varchar(90) NOT NULL,
  `first_name` varchar(70) DEFAULT NULL,
  `middle_name` varchar(70) DEFAULT NULL,
  `last_name` varchar(70) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `date_birth` varchar(15) DEFAULT NULL,
  `nationality` varchar(90) DEFAULT NULL,
  `state_origin` varchar(50) DEFAULT NULL,
  `lga` varchar(90) DEFAULT NULL,
  `student_class` int(15) DEFAULT NULL,
  `student_classarm` int(5) DEFAULT NULL,
  `student_class_admitted` int(45) DEFAULT NULL,
  `student_house` bigint(20) DEFAULT NULL,
  `blood_group` varchar(6) DEFAULT NULL,
  `term_admitted` int(20) DEFAULT NULL,
  `session_admitted` int(20) NOT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_address` text,
  `guardian_phone` varchar(15) DEFAULT NULL,
  `guardian_email` varchar(250) DEFAULT NULL,
  `image` blob,
  `student_status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_students`
--

INSERT INTO `sms_students` (`student_regno`, `first_name`, `middle_name`, `last_name`, `sex`, `date_birth`, `nationality`, `state_origin`, `lga`, `student_class`, `student_classarm`, `student_class_admitted`, `student_house`, `blood_group`, `term_admitted`, `session_admitted`, `guardian_name`, `guardian_address`, `guardian_phone`, `guardian_email`, `image`, `student_status`) VALUES
('17039', 'Ronald', 'perez', 'Msoo', ' Male', '26 /02/1989', 'Nigerian', 'Lagos', 'Ikorodu', 1, 1, 1, 0, ' O+', 1, 1, 'Josh', 'Ikorudu Lagis', '98852663', '', 0x2e2e2f696d61676575706c6f61642f6465732e6a7067, 'ACTIVE'),
('17041', 'Tester', 'avaa', 'Tor', 'Male', '28/02/1990', 'Nigerian', 'Plateau', 'Liyom', 1, 1, 0, 0, 'B+', 0, 1, 'James', 'Gboko', '99999999999', 'anantheophizy04$gmail.com', '', 'ACTIVE'),
('17042', 'Abur', 'Ternenge', 'Peter', 'Male', '10/12/1990', 'Ghanian', 'Accra', 'North', 1, 1, 0, 0, '', 0, 1, 'Apiah', 'Accra Ghabna', '9089899', '', '', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `sms_subject`
--

CREATE TABLE `sms_subject` (
  `subject_id` varchar(90) NOT NULL,
  `subject_code` varchar(45) NOT NULL,
  `subject_name` varchar(90) DEFAULT NULL,
  `subject_status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_subject`
--

INSERT INTO `sms_subject` (`subject_id`, `subject_code`, `subject_name`, `subject_status`) VALUES
('AGRIC27859', 'AGRIC', 'AGRICULTURAL SCIENCE', 'ACTIVE'),
('BUS93658', 'BUS', 'BUSINESS STUDIES', 'ACTIVE'),
('CIVIL54925', 'CIVIL', 'CIVIL EDUCATION', 'ACTIVE'),
('CRS08526', 'CRS', 'CHRISTIAN RELIGIOUS STUDIES', 'ACTIVE'),
('ENG75036', 'ENG', 'ENGLISH', 'ACTIVE'),
('INT91616', 'INT', 'INTEGRATED SCIENCE', 'ACTIVE'),
('INTRO30047', 'INTRO', 'INTRODUCTORY TECHNOLOGY', 'ACTIVE'),
('LIT29332', 'LIT', 'LITERATURE-IN-ENGLISH', 'ACTIVE'),
('MATH94022', 'MATH', 'MATHEMATICS', 'ACTIVE'),
('PHY95323', 'PHY', 'PHYSICS', 'ACTIVE'),
('SOC71943', 'SOC', 'SOCIAL STUDIES', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `sms_term`
--

CREATE TABLE `sms_term` (
  `term_code` bigint(20) NOT NULL,
  `term_name` varchar(45) DEFAULT NULL,
  `term_status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_term`
--

INSERT INTO `sms_term` (`term_code`, `term_name`, `term_status`) VALUES
(1, 'First Term', 'ACTIVE'),
(2, 'Second Term', 'ACTIVE'),
(3, 'Third Term', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(105) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(45) NOT NULL,
  `login_name` varchar(50) DEFAULT NULL,
  `login_status` int(2) NOT NULL,
  `user_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `role`, `login_name`, `login_status`, `user_status`) VALUES
('17039', '$2y$10$/KlF2V2epab01TM3.h.iL.Tabzz2Uw6ceuy9pUqlqnTtXOZLpWbxe', 'Student', 'Msoo', 0, 'ACTIVE'),
('17041', '$2y$10$9Yo5Vf/Hlo3hoUMDyyZKGOFcK2VmOCyHDcMR1bUdnZL5CLxN80gAC', 'Student', 'Tor', 0, 'ACTIVE'),
('17042', '$2y$10$0SPPTMP97tsBSseptOUvgOVgWAUASvuDK7gBPc9pOgtrrRftXcA7G', 'Student', 'Peter', 0, 'ACTIVE'),
('Admin', '$2y$10$r8jdlAMiE5D4Zy0sKrsBHe9C.EpiBRJuLq.FUSX47CFiS8va3fXSG', 'Admin', 'Admin', 0, 'ACTIVE'),
('IPI-2055', '$2y$10$cUOiTMpTXgioNibmZTG89eN0pHdh7CrSaIvFJTXWTFi2pK7q.NbzG', 'Staff', 'Akuma', 0, 'ACTIVE'),
('IPI-2056', '$2y$10$/OAyXCvmX.7oaf2sYDaur.UM87QkUuufz81gr6EggACzRGDr1LdkC', 'Staff', 'Sesughter', 0, 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sms_average_scores`
--
ALTER TABLE `sms_average_scores`
  ADD PRIMARY KEY (`avg_code`);

--
-- Indexes for table `sms_class`
--
ALTER TABLE `sms_class`
  ADD PRIMARY KEY (`class_code`),
  ADD KEY `class_code` (`class_code`);

--
-- Indexes for table `sms_classarm`
--
ALTER TABLE `sms_classarm`
  ADD PRIMARY KEY (`class_arm_code`);

--
-- Indexes for table `sms_class_subjects`
--
ALTER TABLE `sms_class_subjects`
  ADD PRIMARY KEY (`class_sub_code`);

--
-- Indexes for table `sms_cognitive`
--
ALTER TABLE `sms_cognitive`
  ADD PRIMARY KEY (`cog_id`);

--
-- Indexes for table `sms_cognitive_student`
--
ALTER TABLE `sms_cognitive_student`
  ADD PRIMARY KEY (`cog_student_id`);

--
-- Indexes for table `sms_exam_type`
--
ALTER TABLE `sms_exam_type`
  ADD PRIMARY KEY (`exam_code`);

--
-- Indexes for table `sms_formaster`
--
ALTER TABLE `sms_formaster`
  ADD PRIMARY KEY (`formaster_code`);

--
-- Indexes for table `sms_grade`
--
ALTER TABLE `sms_grade`
  ADD PRIMARY KEY (`grade_code`);

--
-- Indexes for table `sms_house`
--
ALTER TABLE `sms_house`
  ADD PRIMARY KEY (`house_code`);

--
-- Indexes for table `sms_school_setup`
--
ALTER TABLE `sms_school_setup`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `sms_scores`
--
ALTER TABLE `sms_scores`
  ADD PRIMARY KEY (`score_code`);

--
-- Indexes for table `sms_session`
--
ALTER TABLE `sms_session`
  ADD PRIMARY KEY (`session_code`);

--
-- Indexes for table `sms_staff_subject`
--
ALTER TABLE `sms_staff_subject`
  ADD PRIMARY KEY (`staff_subject_code`);

--
-- Indexes for table `sms_students`
--
ALTER TABLE `sms_students`
  ADD PRIMARY KEY (`student_regno`);

--
-- Indexes for table `sms_subject`
--
ALTER TABLE `sms_subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `sms_term`
--
ALTER TABLE `sms_term`
  ADD PRIMARY KEY (`term_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sms_class`
--
ALTER TABLE `sms_class`
  MODIFY `class_code` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sms_classarm`
--
ALTER TABLE `sms_classarm`
  MODIFY `class_arm_code` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sms_cognitive`
--
ALTER TABLE `sms_cognitive`
  MODIFY `cog_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sms_exam_type`
--
ALTER TABLE `sms_exam_type`
  MODIFY `exam_code` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sms_grade`
--
ALTER TABLE `sms_grade`
  MODIFY `grade_code` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sms_house`
--
ALTER TABLE `sms_house`
  MODIFY `house_code` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_school_setup`
--
ALTER TABLE `sms_school_setup`
  MODIFY `school_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_session`
--
ALTER TABLE `sms_session`
  MODIFY `session_code` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sms_term`
--
ALTER TABLE `sms_term`
  MODIFY `term_code` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
