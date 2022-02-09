-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2020 at 03:09 PM
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
  `avg_total_marks` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_average_scores`
--

INSERT INTO `sms_average_scores` (`avg_code`, `student_no`, `avg_class`, `avg_class_arm`, `avg_term`, `avg_session`, `avg_total_marks`) VALUES
('170371111', '17037', 1, 1, 1, 1, '516'),
('170371112', '17037', 1, 1, 2, 1, NULL),
('170372321', '17037', 2, 3, 1, 2, '291'),
('170381111', '17038', 1, 1, 1, 1, '393'),
('170381112', '17038', 1, 1, 2, 1, NULL),
('170391111', '17039', 1, 1, 1, 1, '362'),
('170391112', '17039', 1, 1, 2, 1, NULL),
('170401111', '17040', 1, 1, 1, 1, '294'),
('170401112', '17040', 1, 1, 2, 1, NULL),
('170411111', '17041', 1, 1, 1, 1, '489'),
('170411112', '17041', 1, 1, 2, 1, NULL),
('170421112', '17042', 1, 1, 2, 1, NULL);

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
(1, 'HONESTY', 'ACTIVE'),
(2, 'INTEGRITY', 'ACTIVE'),
(3, 'ATTENTIVENESS', 'ACTIVE'),
(4, 'NEATNESS', 'ACTIVE'),
(5, 'PUNCTUALITY', 'ACTIVE'),
(6, 'RELIABILITY', 'ACTIVE'),
(7, 'PERSEVERANCE', 'ACTIVE'),
(8, 'RELATIONSHIP WITH STAFF', 'ACTIVE'),
(9, 'SENSE OF RESPONSIBILITY', 'ACTIVE'),
(10, 'POLITENESS', 'ACTIVE'),
(11, 'INITIATIVE', 'ACTIVE'),
(12, 'SELF CONTROL', 'ACTIVE'),
(13, 'RELATIONSHIP WITH STUDENTS', 'ACTIVE'),
(14, 'LEADERSHIP', 'ACTIVE'),
(15, 'HANDWRITING', 'ACTIVE'),
(16, 'VERBAL', 'ACTIVE'),
(17, 'GAMES', 'ACTIVE'),
(18, 'MUSIC SKILLS', 'ACTIVE'),
(19, 'DRAWING & PAINTING', 'ACTIVE'),
(20, 'HANDLING TOOL', 'ACTIVE');

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

--
-- Dumping data for table `sms_cognitive_student`
--

INSERT INTO `sms_cognitive_student` (`cog_student_id`, `cog_student_reg`, `cognitive_id`, `cog_student_item`, `cog_student_class`, `cog_student_session`, `cog_student_term`, `cog_student_status`) VALUES
('17037101111', '17037', 10, 5, 1, 1, 1, 'ACTIVE'),
('17037102312', '17037', 10, 4, 2, 2, 1, 'ACTIVE'),
('1703711111', '17037', 1, 3, 1, 1, 1, 'ACTIVE'),
('17037111111', '17037', 11, 5, 1, 1, 1, 'ACTIVE'),
('17037112312', '17037', 11, 5, 2, 2, 1, 'ACTIVE'),
('17037121111', '17037', 12, 4, 1, 1, 1, 'ACTIVE'),
('17037122312', '17037', 12, 4, 2, 2, 1, 'ACTIVE'),
('1703712312', '17037', 1, 3, 2, 2, 1, 'ACTIVE'),
('17037131111', '17037', 13, 3, 1, 1, 1, 'ACTIVE'),
('17037132312', '17037', 13, 4, 2, 2, 1, 'ACTIVE'),
('17037141111', '17037', 14, 1, 1, 1, 1, 'ACTIVE'),
('17037142312', '17037', 14, 3, 2, 2, 1, 'ACTIVE'),
('17037151111', '17037', 15, 3, 1, 1, 1, 'ACTIVE'),
('17037152312', '17037', 15, 4, 2, 2, 1, 'ACTIVE'),
('17037161111', '17037', 16, 3, 1, 1, 1, 'ACTIVE'),
('17037162312', '17037', 16, 5, 2, 2, 1, 'ACTIVE'),
('17037171111', '17037', 17, 4, 1, 1, 1, 'ACTIVE'),
('17037172312', '17037', 17, 4, 2, 2, 1, 'ACTIVE'),
('1703721111', '17037', 2, 3, 1, 1, 1, 'ACTIVE'),
('1703722312', '17037', 2, 4, 2, 2, 1, 'ACTIVE'),
('1703731111', '17037', 3, 1, 1, 1, 1, 'ACTIVE'),
('1703732312', '17037', 3, 3, 2, 2, 1, 'ACTIVE'),
('1703741111', '17037', 4, 4, 1, 1, 1, 'ACTIVE'),
('1703742312', '17037', 4, 3, 2, 2, 1, 'ACTIVE'),
('1703751111', '17037', 5, 5, 1, 1, 1, 'ACTIVE'),
('1703752312', '17037', 5, 5, 2, 2, 1, 'ACTIVE'),
('1703761111', '17037', 6, 4, 1, 1, 1, 'ACTIVE'),
('1703762312', '17037', 6, 4, 2, 2, 1, 'ACTIVE'),
('1703771111', '17037', 7, 3, 1, 1, 1, 'ACTIVE'),
('1703772312', '17037', 7, 3, 2, 2, 1, 'ACTIVE'),
('1703781111', '17037', 8, 4, 1, 1, 1, 'ACTIVE'),
('1703782312', '17037', 8, 1, 2, 2, 1, 'ACTIVE'),
('1703791111', '17037', 9, 4, 1, 1, 1, 'ACTIVE'),
('1703792312', '17037', 9, 3, 2, 2, 1, 'ACTIVE'),
('17038101111', '17038', 10, 4, 1, 1, 1, 'ACTIVE'),
('1703811111', '17038', 1, 3, 1, 1, 1, 'ACTIVE'),
('17038111111', '17038', 11, 3, 1, 1, 1, 'ACTIVE'),
('17038121111', '17038', 12, 3, 1, 1, 1, 'ACTIVE'),
('17038131111', '17038', 13, 3, 1, 1, 1, 'ACTIVE'),
('17038141111', '17038', 14, 4, 1, 1, 1, 'ACTIVE'),
('17038151111', '17038', 15, 3, 1, 1, 1, 'ACTIVE'),
('17038161111', '17038', 16, 3, 1, 1, 1, 'ACTIVE'),
('17038171111', '17038', 17, 3, 1, 1, 1, 'ACTIVE'),
('17038181111', '17038', 18, 5, 1, 1, 1, 'ACTIVE'),
('17038191111', '17038', 19, 4, 1, 1, 1, 'ACTIVE'),
('17038201111', '17038', 20, 4, 1, 1, 1, 'ACTIVE'),
('1703821111', '17038', 2, 3, 1, 1, 1, 'ACTIVE'),
('1703831111', '17038', 3, 4, 1, 1, 1, 'ACTIVE'),
('1703841111', '17038', 4, 4, 1, 1, 1, 'ACTIVE'),
('1703851111', '17038', 5, 3, 1, 1, 1, 'ACTIVE'),
('1703861111', '17038', 6, 1, 1, 1, 1, 'ACTIVE'),
('1703871111', '17038', 7, 3, 1, 1, 1, 'ACTIVE'),
('1703881111', '17038', 8, 4, 1, 1, 1, 'ACTIVE'),
('1703891111', '17038', 9, 5, 1, 1, 1, 'ACTIVE'),
('17039101111', '17039', 10, 4, 1, 1, 1, 'ACTIVE'),
('1703911111', '17039', 1, 4, 1, 1, 1, 'ACTIVE'),
('17039111111', '17039', 11, 4, 1, 1, 1, 'ACTIVE'),
('17039121111', '17039', 12, 5, 1, 1, 1, 'ACTIVE'),
('17039131111', '17039', 13, 3, 1, 1, 1, 'ACTIVE'),
('17039141111', '17039', 14, 1, 1, 1, 1, 'ACTIVE'),
('17039151111', '17039', 15, 2, 1, 1, 1, 'ACTIVE'),
('17039161111', '17039', 16, 4, 1, 1, 1, 'ACTIVE'),
('17039171111', '17039', 17, 4, 1, 1, 1, 'ACTIVE'),
('1703921111', '17039', 2, 4, 1, 1, 1, 'ACTIVE'),
('1703931111', '17039', 3, 4, 1, 1, 1, 'ACTIVE'),
('1703941111', '17039', 4, 3, 1, 1, 1, 'ACTIVE'),
('1703951111', '17039', 5, 3, 1, 1, 1, 'ACTIVE'),
('1703961111', '17039', 6, 3, 1, 1, 1, 'ACTIVE'),
('1703971111', '17039', 7, 1, 1, 1, 1, 'ACTIVE'),
('1703981111', '17039', 8, 2, 1, 1, 1, 'ACTIVE'),
('1703991111', '17039', 9, 3, 1, 1, 1, 'ACTIVE'),
('17040101111', '17040', 10, 4, 1, 1, 1, 'ACTIVE'),
('1704011111', '17040', 1, 5, 1, 1, 1, 'ACTIVE'),
('17040111111', '17040', 11, 3, 1, 1, 1, 'ACTIVE'),
('17040121111', '17040', 12, 1, 1, 1, 1, 'ACTIVE'),
('17040131111', '17040', 13, 3, 1, 1, 1, 'ACTIVE'),
('17040141111', '17040', 14, 4, 1, 1, 1, 'ACTIVE'),
('17040151111', '17040', 15, 4, 1, 1, 1, 'ACTIVE'),
('17040161111', '17040', 16, 3, 1, 1, 1, 'ACTIVE'),
('17040171111', '17040', 17, 3, 1, 1, 1, 'ACTIVE'),
('1704021111', '17040', 2, 4, 1, 1, 1, 'ACTIVE'),
('1704031111', '17040', 3, 3, 1, 1, 1, 'ACTIVE'),
('1704041111', '17040', 4, 4, 1, 1, 1, 'ACTIVE'),
('1704051111', '17040', 5, 1, 1, 1, 1, 'ACTIVE'),
('1704061111', '17040', 6, 2, 1, 1, 1, 'ACTIVE'),
('1704071111', '17040', 7, 4, 1, 1, 1, 'ACTIVE'),
('1704081111', '17040', 8, 5, 1, 1, 1, 'ACTIVE'),
('1704091111', '17040', 9, 5, 1, 1, 1, 'ACTIVE'),
('17041101111', '17041', 10, 3, 1, 1, 1, 'ACTIVE'),
('1704111111', '17041', 1, 4, 1, 1, 1, 'ACTIVE'),
('17041111111', '17041', 11, 4, 1, 1, 1, 'ACTIVE'),
('17041121111', '17041', 12, 3, 1, 1, 1, 'ACTIVE'),
('17041131111', '17041', 13, 1, 1, 1, 1, 'ACTIVE'),
('17041141111', '17041', 14, 2, 1, 1, 1, 'ACTIVE'),
('17041151111', '17041', 15, 3, 1, 1, 1, 'ACTIVE'),
('17041161111', '17041', 16, 4, 1, 1, 1, 'ACTIVE'),
('17041171111', '17041', 17, 2, 1, 1, 1, 'ACTIVE'),
('17041181111', '17041', 18, 3, 1, 1, 1, 'ACTIVE'),
('17041191111', '17041', 19, 4, 1, 1, 1, 'ACTIVE'),
('17041201111', '17041', 20, 2, 1, 1, 1, 'ACTIVE'),
('1704121111', '17041', 2, 5, 1, 1, 1, 'ACTIVE'),
('1704131111', '17041', 3, 4, 1, 1, 1, 'ACTIVE'),
('1704141111', '17041', 4, 4, 1, 1, 1, 'ACTIVE'),
('1704151111', '17041', 5, 4, 1, 1, 1, 'ACTIVE'),
('1704161111', '17041', 6, 5, 1, 1, 1, 'ACTIVE'),
('1704171111', '17041', 7, 4, 1, 1, 1, 'ACTIVE'),
('1704181111', '17041', 8, 3, 1, 1, 1, 'ACTIVE'),
('1704191111', '17041', 9, 4, 1, 1, 1, 'ACTIVE');

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
(1, 'MOUNT SAINT GABRIEL MAKURDI', '        No 46 Ernest Attah Street Wadata, Makurdi Benue State.', '07089831214', 'anandetheophizy04@gmail.com', 0x2e2e2f696d61676575706c6f61642f6c6f676f2e6a7067, 'ACTIVE');

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

--
-- Dumping data for table `sms_scores`
--

INSERT INTO `sms_scores` (`score_code`, `score_student_regno`, `score_subject_code`, `score_class`, `score_class_arm`, `score_CA1`, `score_CA2`, `score_CA3`, `score_exam`, `score_total`, `score_grade`, `score_term`, `score_session`, `score_by`, `score_date`) VALUES
('17037AGRIC278591111', '17037', 'AGRIC27859', 1, 1, '10', '10', '10', '65', '95', 6, 1, 1, 'THEO', '2020/02/01'),
('17037AGRIC278592321', '17037', 'AGRIC27859', 2, 3, '10', '9', '10', '60', '89', 6, 1, 2, 'THEO', '2020/02/10'),
('17037BUS936581111', '17037', 'BUS93658', 1, 1, '10', '10', '10', '60', '90', 6, 1, 1, 'THEO', '2020/02/03'),
('17037CIVIL549251111', '17037', 'CIVIL54925', 1, 1, '9', '9', '6', '67', '91', 6, 1, 1, 'THEO', '2020/02/04'),
('17037CIVIL549252321', '17037', 'CIVIL54925', 2, 3, '7', '7', '9', '65', '88', 6, 1, 2, 'THEO', '2020/02/10'),
('17037ENG750361111', '17037', 'ENG75036', 1, 1, '10', '7', '5', '50', '72', 5, 1, 1, 'THEO', '2020/01/31'),
('17037ENG750361112', '17037', 'ENG75036', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 'THEO', '2020/02/03'),
('17037INT916162321', '17037', 'INT91616', 2, 3, '7', '9', '8', '55', '79', 6, 1, 2, 'THEO', '2020/02/10'),
('17037LIT293321111', '17037', 'LIT29332', 1, 1, '10', '7', '9', '58', '84', 6, 1, 1, 'THEO', '2020/02/04'),
('17037MATH940222321', '17037', 'MATH94022', 2, 3, '4', '4', '5', '22', '35', 1, 1, 2, 'THEO', '2020/02/10'),
('17037SOC719431111', '17037', 'SOC71943', 1, 1, '10', '9', '8', '57', '84', 6, 1, 1, 'THEO', '2020/02/03'),
('17038AGRIC278591111', '17038', 'AGRIC27859', 1, 1, '9', '5', '6', '20', '40', 2, 1, 1, 'THEO', '2020/01/31'),
('17038AGRIC278591112', '17038', 'AGRIC27859', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 'Admin', '2020/02/27'),
('17038BUS936581111', '17038', 'BUS93658', 1, 1, '10', '10', '5', '65', '90', 6, 1, 1, 'THEO', '2020/02/03'),
('17038CIVIL549251111', '17038', 'CIVIL54925', 1, 1, '5', '6', '9', '23', '43', 2, 1, 1, 'THEO', '2020/02/04'),
('17038ENG750361111', '17038', 'ENG75036', 1, 1, '10', '7', '8', '45', '70', 5, 1, 1, 'THEO', '2020/01/31'),
('17038ENG750361112', '17038', 'ENG75036', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 'THEO', '2020/02/03'),
('17038LIT293321111', '17038', 'LIT29332', 1, 1, '10', '6', '7', '60', '83', 6, 1, 1, 'THEO', '2020/02/04'),
('17038SOC719431111', '17038', 'SOC71943', 1, 1, '6', '9', '7', '45', '67', 5, 1, 1, 'THEO', '2020/02/03'),
('17039AGRIC278591111', '17039', 'AGRIC27859', 1, 1, '4', '8', '7', '25', '44', 2, 1, 1, 'THEO', '2020/01/31'),
('17039AGRIC278591112', '17039', 'AGRIC27859', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 'Admin', '2020/02/27'),
('17039BUS936581111', '17039', 'BUS93658', 1, 1, '10', '5', '5', '60', '80', 6, 1, 1, 'THEO', '2020/02/03'),
('17039CIVIL549251111', '17039', 'CIVIL54925', 1, 1, '8', '6', '2', '40', '56', 4, 1, 1, 'THEO', '2020/02/04'),
('17039ENG750361111', '17039', 'ENG75036', 1, 1, '9', '5', '7', '15', '36', 1, 1, 1, 'THEO', '2020/01/31'),
('17039ENG750361112', '17039', 'ENG75036', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 'THEO', '2020/02/03'),
('17039LIT293321111', '17039', 'LIT29332', 1, 1, '6', '6', '8', '50', '70', 5, 1, 1, 'THEO', '2020/02/04'),
('17039SOC719431111', '17039', 'SOC71943', 1, 1, '10', '6', '8', '52', '76', 6, 1, 1, 'THEO', '2020/02/03'),
('17040AGRIC278591111', '17040', 'AGRIC27859', 1, 1, '5', '7', '8', '8', '28', 1, 1, 1, 'THEO', '2020/01/31'),
('17040AGRIC278591112', '17040', 'AGRIC27859', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 'Admin', '2020/02/27'),
('17040BUS936581111', '17040', 'BUS93658', 1, 1, '5', '10', '10', '35', '60', 4, 1, 1, 'THEO', '2020/02/03'),
('17040CIVIL549251111', '17040', 'CIVIL54925', 1, 1, '2', '0', '8', '23', '33', 1, 1, 1, 'THEO', '2020/02/04'),
('17040ENG750361111', '17040', 'ENG75036', 1, 1, '0', '3', '6', '23', '32', 1, 1, 1, 'THEO', '2020/01/31'),
('17040ENG750361112', '17040', 'ENG75036', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 'THEO', '2020/02/03'),
('17040LIT293321111', '17040', 'LIT29332', 1, 1, '10', '10', '9', '60', '89', 6, 1, 1, 'THEO', '2020/02/04'),
('17040SOC719431111', '17040', 'SOC71943', 1, 1, '6', '5', '9', '32', '52', 4, 1, 1, 'THEO', '2020/02/03'),
('17041AGRIC278591111', '17041', 'AGRIC27859', 1, 1, '10', '9', '7', '68', '94', 6, 1, 1, 'THEO', '2020/02/26'),
('17041AGRIC278591112', '17041', 'AGRIC27859', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 'Admin', '2020/02/27'),
('17041BUS936581111', '17041', 'BUS93658', 1, 1, '7', '9', '9', '67', '92', 6, 1, 1, 'THEO', '2020/02/26'),
('17041CIVIL549251111', '17041', 'CIVIL54925', 1, 1, '9', '8', '10', '62', '89', 6, 1, 1, 'THEO', '2020/02/26'),
('17041ENG750361111', '17041', 'ENG75036', 1, 1, '9', '9', '8', '63', '89', 6, 1, 1, 'THEO', '2020/02/26'),
('17041LIT293321111', '17041', 'LIT29332', 1, 1, '8', '6', '10', '69', '93', 6, 1, 1, 'THEO', '2020/02/26'),
('17041SOC719431111', '17041', 'SOC71943', 1, 1, '3', '4', '5', '20', '32', 1, 1, 1, 'THEO', '2020/02/26'),
('17042AGRIC278591112', '17042', 'AGRIC27859', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 'Admin', '2020/02/27');

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
('17036', 'Terna', 'Tom', 'Iorsenge', 'Male', '08/01/2005', 'Nigerian', 'Benue State', 'Kwande', 3, 1, 1, 0, 'AB-', 1, 1, 'Iorsenge Tyo', 'Adikpo', '0000000000', 'bbb@gmaiol.com', '', 'ACTIVE'),
('17037', 'Sesugh', 'Perez', 'Ula', '  Male', '20/07/2020', 'Nigerian', 'Benue State', 'Vandeikya', 2, 3, 1, 0, '  O+', 1, 1, 'Tsav', 'Balli', '08888888888', 'ggggggggg@gmail.com', 0x2e2e2f696d61676575706c6f61642f61646d696e31312e6a7067, 'ACTIVE'),
('17038', 'Jacob', 'Akar', 'Tsenongu', 'Male', '25/12/1992', 'Nigerian', 'Benue State', 'Ushongo', 1, 1, 2, 0, '     B', 1, 1, 'Stephen Gbaa', 'Gboko', '07089831214', 'theo@gmaiol.com', 0x2e2e2f696d61676575706c6f61642f6465732e6a7067, 'ACTIVE'),
('17039', 'Ronald', 'perez', 'Yua', '    Male', '22/2/1990', 'Nigerian', 'Lagos', 'Ikorodu', 1, 1, 1, 0, '    O+', 1, 1, 'Josh', 'Ikorudu Lagis', '98852663', 'bbb@gmail.com', 0x2e2e2f696d61676575706c6f61642f646573202d20436f70792e6a7067, 'ACTIVE'),
('17040', 'Damilola', 'N/A', 'Adebayo', ' Female', '22/2/1990', 'Nigerian', 'Osun', 'Osun North', 1, 1, 1, 0, ' A+', 1, 1, 'Adebayo', 'osun', '777777', 'uuuu@gmail.com', '', 'ACTIVE'),
('17041', 'Tester', 'avaa', 'Tor', '   Male', '11/01/1988', 'Nigerian', 'Plateau', 'Liyom', 1, 1, 1, 0, '   B+', 1, 1, 'James', 'Gboko', '99999999999', 'anantheophizy04@gmail.com', 0x2e2e2f696d61676575706c6f61642f61646d696e31312e6a7067, 'ACTIVE'),
('17042', 'Abur', 'Ternenge', 'Peter', '  Male', '11/01/1988', 'Ghanian', 'Accra', 'North', 1, 1, 0, 0, 'AB+', 0, 0, 'Apiah', 'Accra Ghabna', '9089899', 'bbbl@gmail.com', 0x2e2e2f696d61676575706c6f61642f6661627269636174696f6e322e6a7067, 'ACTIVE');

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
(1, 'FIRST TERM', 'ACTIVE'),
(2, 'SECOND TERM', 'ACTIVE'),
(3, 'THIRD TERM', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(105) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(45) NOT NULL,
  `login_name` varchar(50) DEFAULT NULL,
  `login_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `role`, `login_name`, `login_status`) VALUES
('17036', '$2y$10$.mC4DJMgaBhf.YHIWczebur014NgY9WrDrSzjc5wf6o6AbkOnV4b6', 'Student', 'Iorsenge', 0),
('17039', '$2y$10$VmWt1WdY/pJBCZmfJlbUWu0AI2M4ovIS1ajvOY8AdWe.ggbU1TqHq', 'Student', 'Msoo', 1),
('17041', '$2y$10$xPjXhxFfbu.Ij6r2Oxs5suCu1tqAStfVWA7I9GDJPxmLzt5CH3PZG', 'Student', 'Tor', 0),
('17042', '$2y$10$yOBEdej8pE3egV4yIeINH.lOLNYE.zuCf8ie4Iin3U2mUCL9Pajze', 'Student', 'Peter', 0),
('Admin', '$2y$10$DzPF6am18q8Vv/6.AWJwZeT6MFDhrNBhhL/zCNhhgIwRi1eIBijXS', 'Admin', 'Admin', 1),
('IPI-2055', '$2y$10$cUOiTMpTXgioNibmZTG89eN0pHdh7CrSaIvFJTXWTFi2pK7q.NbzG', 'Staff', 'Anande', 0);

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
  MODIFY `cog_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
