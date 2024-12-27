-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 01, 2017 at 02:16 PM
-- Server version: 5.6.28-76.1-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webde278_analytics_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminid` double NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `logindate` datetime NOT NULL,
  `username` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL DEFAULT '',
  `access_id` int(11) NOT NULL,
  `password` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_type` int(2) NOT NULL COMMENT '1->Super Admin, 2->Vendor',
  `Created_date` datetime NOT NULL,
  `Modify_date` datetime NOT NULL,
  `Created_Id` int(11) NOT NULL,
  `Modify_Id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active,2-deleted',
  `ip_address` varchar(45) NOT NULL,
  UNIQUE KEY `adminid` (`adminid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `firstname`, `lastname`, `logindate`, `username`, `access_id`, `password`, `email`, `phone`, `address`, `image`, `user_type`, `Created_date`, `Modify_date`, `Created_Id`, `Modify_Id`, `status`, `ip_address`) VALUES
(20, 'admin', 'admin', '2017-04-25 09:50:00', 'admin', 1, '0e7517141fb53f21ee439b355b5a1d0a', 'ghanshyam.vrinsoft%40gmail.com', '', '', 'VEN1488633299.png', 1, '0000-00-00 00:00:00', '2017-03-09 00:04:04', 0, 0, 1, '180.211.105.202');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `roleid` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_analytics`
--

CREATE TABLE IF NOT EXISTS `tbl_analytics` (
  `analyticsid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_language_id` int(11) NOT NULL,
  `analyticstitle` varchar(255) DEFAULT NULL,
  `statuscheck` int(11) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`analyticsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_analytics`
--

INSERT INTO `tbl_analytics` (`analyticsid`, `fk_language_id`, `analyticstitle`, `statuscheck`, `createdatetime`) VALUES
(1, 1, 'DCMA14', 1, '2017-03-09 12:04:11'),
(2, 1, 'GASP', 1, '2017-03-09 12:04:25'),
(3, 1, 'Schedule+Quality', 1, '2017-03-09 12:04:49'),
(4, 1, 'Schedule+Analyser', 2, '2017-03-09 12:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_analytics_image`
--

CREATE TABLE IF NOT EXISTS `tbl_analytics_image` (
  `breakdownimgid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_analyticsid` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumbimage` varchar(255) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`breakdownimgid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_analytics_image`
--

INSERT INTO `tbl_analytics_image` (`breakdownimgid`, `fk_analyticsid`, `image`, `thumbimage`, `createdatetime`) VALUES
(1, 1, 'product11491449126.jpg', '', '2017-03-09 12:04:11'),
(2, 2, 'product11491449138.jpg', '', '2017-03-09 12:04:25'),
(3, 3, 'product11491449151.jpg', '', '2017-03-09 12:04:49'),
(4, 4, 'product11489061128.jpg', 'productthumb1489061128.jpg', '2017-03-09 12:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assessments_category`
--

CREATE TABLE IF NOT EXISTS `tbl_assessments_category` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_assessments_category`
--

INSERT INTO `tbl_assessments_category` (`categoryid`, `categoryname`, `status`, `createdby`, `createdatetime`, `updatedby`, `updatedatetime`) VALUES
(1, 'EPC', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'EVM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Planning', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Procurement', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assessments_tests`
--

CREATE TABLE IF NOT EXISTS `tbl_assessments_tests` (
  `assessmentsid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_language_id` int(11) NOT NULL,
  `fk_category_id` int(11) NOT NULL,
  `questions` varchar(250) DEFAULT NULL,
  `option1` varchar(250) DEFAULT NULL,
  `option2` varchar(250) DEFAULT NULL,
  `option3` varchar(250) DEFAULT NULL,
  `option4` varchar(250) DEFAULT NULL,
  `rightanswer` varchar(64) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rightanswertext` varchar(255) NOT NULL,
  `statuscheck` int(11) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `createdatetime` datetime DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`assessmentsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `tbl_assessments_tests`
--

INSERT INTO `tbl_assessments_tests` (`assessmentsid`, `fk_language_id`, `fk_category_id`, `questions`, `option1`, `option2`, `option3`, `option4`, `rightanswer`, `image`, `rightanswertext`, `statuscheck`, `createdby`, `createdatetime`, `updatedby`, `updatedatetime`, `ip_address`) VALUES
(1, 1, 4, 'what+is+your+name+%3F', 'abc', 'xyz', 'gfj', 'es', '2', 'product11489121485.jpg', 'xyz', 2, NULL, NULL, NULL, NULL, NULL),
(2, 1, 4, 'Select+the+answer+for+the+circled+box', '6', '1', '4', '9', '3', 'product11489298322.jpg', '4', 2, NULL, NULL, NULL, NULL, NULL),
(3, 1, 1, 'This+is+dummy+data+%3F', 'yes', 'no', 'i+dont+know', 'perheps', '1', 'product11489489225.jpg', 'yes', 2, NULL, NULL, NULL, NULL, NULL),
(4, 1, 2, 'Are+you+married+%3F', 'yes+', 'no', 'married', 'unmarried', '3', 'product11489489378.jpg', 'married', 2, NULL, NULL, NULL, NULL, NULL),
(5, 1, 3, 'are+you+current+employee+of+this+organisation+%3F', 'yes', 'no', 'past', 'future', '1', 'product11489489495.jpg', 'yes', 2, NULL, NULL, NULL, NULL, NULL),
(6, 1, 3, 'Select+the+industry%27s+definition+of+Best+Practices+to+building+a+high%E2%80%90quality+%26+reliable+schedule.', 'Capturing+all+activities.+Sequencing+all+activities.+Assigning+resources+to+all+activities.+Establishing+the+duration+of+all+activities.+Verifying+that+the+schedule+can+be+traced+horizontally+and+vertically.+Confirming+that+the+critical+path+is+valid', 'Capturing+all+activities.+Sequencing+all+activities.+Assigning+resources+to+all+activities.Establishing+the+duration+of+all+activities.+Verifying+that+the+schedule+can+be+traced+horizontally+and+vertically.+Confirming+that+the+critical+path+is+valid.', 'Capturing+all+activities.+Sequencing+all+activities.+Assigning+resources+to+all+activities.+Establishing+the+duration+of+all+activities.+Confirming+that+the+critical+path+is+valid.+Ensuring+reasonable+total+float.+', 'Capturing+all+activities.+Sequencing+all+activities.+Assigning+resources+to+all+activities.+Establishing+the+duration+of+all+activities.+Verifying+that+the+schedule+can+be+traced+horizontally+and+vertically.+Confirming+that+the+critical+path+is+valid', '1', 'product11491761404.jpg', 'Capturing+all+activities.+Sequencing+all+activities.+Assigning+resources+to+all+activities.+Establishing+the+duration+of+all+activities.+Verifying+that+the+schedule+can+be+traced+horizontally+and+vertically.+Confirming+that+the+critical+path+is+valid.+Ens', 1, NULL, NULL, NULL, NULL, NULL),
(7, 1, 3, '+What+is+the+definition+for+Integrated+Master+Schedule%3F', 'As+a+document+that+integrates+the+planned+work%2C+the+resources+necessary+to+accomplish+that+work%2C+and+the+associated+budget%2C+the+IMS+should+be+the+focal+point+of+program+management.', 'As+a+model+of+time%2C+the+master+schedule+incorporates+key+variables+such+as+nonworking+calendar+periods%2C+contingency%2C+resource+constraints%2C+and+preferred+sequences+of+work+activities+to+determine+the+duration+and+the+start+and+finish+dates+of+', 'The+Master+Schedule+involves+compiling+all+necessary+stages+throughout+the+project+as+stakeholders+learn+more+details', '+B+%26+C+', '1', 'product11491761564.jpg', 'As+a+document+that+integrates+the+planned+work%2C+the+resources+necessary+to+accomplish+that+work%2C+and+the+associated+budget%2C+the+IMS+should+be+the+focal+point+of+program+management.', 1, NULL, NULL, NULL, NULL, NULL),
(8, 1, 3, '+Planning+%26+Scheduling+are+separate+processes%3F', 'true+', 'false', 'null', 'null', '1', 'product11491761726.jpg', 'true+', 1, NULL, NULL, NULL, NULL, NULL),
(9, 1, 3, 'Project+planning+is+the+basis+for+controlling+and+managing+project+performance%2C+including+managing+the+relationship+between+cost+and+time.+', 'true', 'false+', 'null', 'null', '1', 'product11491761898.jpg', 'true', 1, NULL, NULL, NULL, NULL, NULL),
(10, 1, 3, '+What+is+the+definition+of+Lags%3F+', '+A+lag+in+a+schedule+denotes+the+passage+of+time+between+two+activities', 'An+induced+amount+of+time+between+the+predecessor+%26+successor+to+emulate+a+push+in+the+network', '+An+implied+amount+of+time+between+the+predecessor+%26+successor+to+emulate+a+push+in+the+network.', '+A+delineation+of+time+to+the+succeeding+activities.', '1', 'product11491762036.jpg', '+A+lag+in+a+schedule+denotes+the+passage+of+time+between+two+activities', 1, NULL, NULL, NULL, NULL, NULL),
(11, 1, 3, '+What+is+the+correct+definition+of+CPM%3F', 'The+critical+path+is+defined+as+the+longest+logical+path+through+the+CPM+network+and+consists+of+those+activities+that+determine+the+shortest+time+for+project+completion.', 'The+critical+path+method+is+used+to+derive+the+critical+activities%E2%80%94that+is%2C+activities+that+will+be+delayed+without+delaying+the+end+date+of+the+program.', 'Critical+activities+have+the+least+amount+of+float+and%2C+therefore%2C+any+delay+in+them+generally+causes+the+same+amount+of+delay+in+the+program%E2%80%99s+end+date', '+Both+A+%26+C', '1', 'product11491762194.jpg', 'The+critical+path+is+defined+as+the+longest+logical+path+through+the+CPM+network+and+consists+of+those+activities+that+determine+the+shortest+time+for+project+completion.', 1, NULL, NULL, NULL, NULL, NULL),
(12, 1, 3, 'How+many+methods+are+there+for+calculating+Critical+Path%3F', '4', '1', '2', '3', '1', 'product11491762253.jpg', '4', 1, NULL, NULL, NULL, NULL, NULL),
(13, 1, 3, '+Check+all+that+apply+for+the+most+frequent+methods+used+for+determining+Critical+Path%3F+', '+Lowest+Total+Float', '+Negative+Total+Float', '+The+longest+path+calculation', '+All+of+the+above', '4', 'product11491762370.jpg', '+All+of+the+above', 1, NULL, NULL, NULL, NULL, NULL),
(14, 1, 3, '+What+is+AACE%27s+RP+49R%E2%80%9006%27s+definition+of+Total+Float%3F', '+The+amount+of+time+an+activity+can+be+delayed+without+delaying+the+early+finish+of+the+project+or+any+constrained+activity.+', '+Network+of+activities+logically+tied+that+calculate+a+forward+and+backward+pass+to+establish+Total+Float.+', '+The+amount+of+time+an+activity+can+slip+from+its+early+Start+without+delaying+the+project', '+The+difference+between+an+activity%27s+late+dates+and+early+dates.', '1', 'product11491762477.jpg', '+The+amount+of+time+an+activity+can+be+delayed+without+delaying+the+early+finish+of+the+project+or+any+constrained+activity.+', 1, NULL, NULL, NULL, NULL, NULL),
(15, 1, 3, '+What+is+the+Critical+Path+Test%3F', 'Its+intent+is+to+identify+a+current+critical+path+activity%2C+to+grossly+extend+its+remaining+duration%2C+and+note+if+a+corresponding+extension+occurs+to+the+project+completion+date.', 'The+project+schedule+extended+to+identify+how+it+will+affect+the+activity+or+activities+with+the+latest+early+finish+date.', 'The+analysis+software+purposely+extends+activities+to+identify+how+it+will+affect+the+activity+or+activities+with+the+latest+early+finish+date.+', '+Both+A+%26+C', '1', 'product11491762622.jpg', 'Its+intent+is+to+identify+a+current+critical+path+activity%2C+to+grossly+extend+its+remaining+duration%2C+and+note+if+a+corresponding+extension+occurs+to+the+project+completion+date.', 1, NULL, NULL, NULL, NULL, NULL),
(16, 1, 3, '+What+is+Rolling+Wave+Planning%3F', 'The+incremental+conversion+of+work+from+planning+packages+to+detailed+work+packages.', 'Planning+with+portions+of+effort+that+align+to+significant+program+increments%2C+blocks%2C+or+updates+is+sometimes+referred+to+as+block+planning+', '+As+the+project+moves+into+subsequent+phases+and+more+scope+information+becomes+available.', '+Schedules+are+presented+in+an+activity+listing+format+without+time+scaled+graphical+representation+of+work+to+accomplish.', '1', 'product11491762726.jpg', 'The+incremental+conversion+of+work+from+planning+packages+to+detailed+work+packages.', 1, NULL, NULL, NULL, NULL, NULL),
(17, 1, 3, '+Acceptance+of+the+level+of+criticality+in+software%E2%80%90calculated+critical+path+activities+should+not+be+made+automatically', 'true+', 'false', 'null', 'null', '1', 'product11491762824.jpg', 'true+', 1, NULL, NULL, NULL, NULL, NULL),
(18, 1, 3, 'When+is+the+optimal+time+to+resource+load+activities+into+the+schedule%3F', '+Resource+loading+should+occur+as+the+activities+are+being+captured+for+planning.+', '+Resources+must+be+loaded+prior+to+logically+sequencing+the+activity+network.+', '+Validation+of+the+critial+path+must+be+reasonable+prior+to+resource+loading', '+Upon+completion+of+logically+sequencing+the+activity+network%2C+the+estimated+work%2C+durations%2C+%26+resources+can+be+applied', '4', 'product11491762941.jpg', '+Upon+completion+of+logically+sequencing+the+activity+network%2C+the+estimated+work%2C+durations%2C+%26+resources+can+be+applied', 1, NULL, NULL, NULL, NULL, NULL),
(19, 1, 3, '+EPC+Level+3+is+the+first+level+where+the+full+use+of+critical+path+method+%28CPM%29+techniques+could+be+shown+effectively.+', 'true+', 'false+', 'null', 'null', '1', 'product11491763133.jpg', 'true+', 1, NULL, NULL, NULL, NULL, NULL),
(20, 1, 3, 'EPC+Level+4+are+detailed+work+schedules+and+generally+would+be+prepared+outside+of+the+CPM+software%2C+with+correlation+to+the+CPM+schedule+activities+and+scope+of+work.+', 'true', 'false+', 'null', 'null', '1', 'product11491763226.jpg', 'true', 1, NULL, NULL, NULL, NULL, NULL),
(21, 1, 3, 'The+Critical+Path+Length+Index+%28CPLI%29+is+calculated+as+CPLI%3D%28Critical+Path+%2B%2F%E2%80%90+Total+Float%29+%2F+Critical+Path+Length.+', 'true', 'false', 'null', 'null', '2', 'product11491763295.jpg', 'false', 1, NULL, NULL, NULL, NULL, NULL),
(22, 1, 3, '+Forensic+Scheduling+Analysis+uses+which+method+for+1st+Layer%3A+Timing+', '+Prospective+analyses', '+Retrospective+analyses', '+A+%26+B+', '+None+of+the+Above+', '3', 'product11491763380.jpg', '+A+%26+B+', 1, NULL, NULL, NULL, NULL, NULL),
(23, 1, 3, 'The+as%E2%80%90planned+vs.+as%E2%80%90built+is+an+example+of+this+specific+method+used+in+Dynamic+Logic+Observation.+', 'true+', 'false+', 'null', 'null', '2', 'product11491763471.jpg', 'false+', 1, NULL, NULL, NULL, NULL, NULL),
(24, 1, 3, '+Methods+for+Observational+Dynamic+Logic+are%3A+', 'Contemporaneous+As-Is+', 'Contemporaneous+Split', 'Modified+%2F+Recreated+Updates+', 'All+of+the+Above', '4', 'product11491763583.jpg', 'All+of+the+Above', 1, NULL, NULL, NULL, NULL, NULL),
(25, 1, 3, '+The+Time+Impact+Analysis+can+also+be+classified+as+an+additive+modeling+method', 'true+', 'false+', 'null', 'null', '1', 'product11491763653.jpg', 'true+', 1, NULL, NULL, NULL, NULL, NULL),
(26, 1, 2, '+The+principles+of+an+EVMS+are%3A', 'Plan+all+work+scope.+Break+down+the+program+work+scope.+Integrate+program+work+scope%2C+schedule%2C+and+cost+objectives+into+a+performance+measurement+baseline+plan.+Use+actual+costs+incurred+and+recorded.+Objectively+assess+accomplishments.+Analyze+', 'Plan+all+work+scope.+Break+down+the+program+work+scope.+Integrate+program+work+scope%2C+schedule%2C+and+cost+objectives+into+a+performance+measurement+baseline+plan.+Use+actual+costs+incurred+and+recorded.+Objectively+assess+accomplishments.+Analyze+', 'Plan+all+work+scope.+Break+down+the+program+work+scope.+Integrate+program+work+scope%2C+schedule%2C+and+cost+objectives+into+a+performance+measurement+baseline+plan.+Use+actual+costs+incurred+and+recorded.+Analyze+significant+variances+from+the+plan%', 'Plan+all+work+scope.+Break+down+the+program+work+scope.+Integrate+program+work+scope%2C+schedule%2C+and+cost+objectives+into+a+performance+measurement+baseline+plan.+', '1', 'product11491765493.jpg', 'Plan+all+work+scope.+Break+down+the+program+work+scope.+Integrate+program+work+scope%2C+schedule%2C+and+cost+objectives+into+a+performance+measurement+baseline+plan.+Use+actual+costs+incurred+and+recorded.+Objectively+assess+accomplishments.+Analyze+signi', 1, NULL, NULL, NULL, NULL, NULL),
(27, 1, 2, 'EARNED+VALUE+-+The+value+of+completed+work+expressed+in+terms+of+the+budget+assigned+to+that+work%2C+also+referred+to+as+Budgeted+Cost+for+Work+Performed+%28EVWP%29.', 'true', 'flase', 'null', 'null', '2', 'product11491765604.jpg', 'flase', 1, NULL, NULL, NULL, NULL, NULL),
(28, 1, 2, 'PLANNED+VALUE+%E2%80%93+The+time-phased+budget+plan+for+work+currently+scheduled%2C+also+referred+to+as+Budgeted+Cost+for+Work+Scheduled+%28BCWP%29.+', 'true', 'false', 'null', 'null', '2', 'product11491765684.jpg', 'false', 1, NULL, NULL, NULL, NULL, NULL),
(29, 1, 2, '+Earned+value+is+a+direct+measurement+of+the+quantity+of+work+accomplished.+', 'true', 'false', 'null', 'null', '1', 'product11491765753.jpg', 'true', 1, NULL, NULL, NULL, NULL, NULL),
(30, 1, 2, '+The+most+common+methods+of+Earned+Value+Methodology+are%3A+', '+Dicrete+Effort+', '+Apportioned+Effort+', '+Level+of+Effort', '+All+of+the+above', '4', 'product11491765878.jpg', '+All+of+the+above', 1, NULL, NULL, NULL, NULL, NULL),
(31, 1, 2, '+How+many+equations+are+used+for+calculating+EAC%3F+', '9', '3', '1', '5', '1', 'product11491765955.jpg', '9', 1, NULL, NULL, NULL, NULL, NULL),
(32, 1, 2, 'List+ALL+the+correct+equations+for+EAC.+', '+EAC+%3D+AC+%2B+%28BAC+%E2%80%90+EV%29+', 'All+of+the+above', '+EAC+%3D+AC+%2B+%28BAC+%E2%80%90+EV%29+%2F+CPI', '+EAC+%3D+AC+%2B+%28BAC+%E2%80%90+EV%29+%2F+%28CPI+x+SPI%29', '2', 'product11491766193.jpg', 'All+of+the+above', 1, NULL, NULL, NULL, NULL, NULL),
(33, 1, 2, '+Estimate+at+Completion+is+calculated+as+EAC+%3D+AC+%2B+ETC', 'true', 'false', 'null', 'null', '1', 'product11491766249.jpg', 'true', 1, NULL, NULL, NULL, NULL, NULL),
(34, 1, 2, '+List+ALL+correct+Analysis+of+EACs+Using+To+Complete+Performance+Index+%28TCPI%29', 'TCPIBAC+%3D+%28BAC+%E2%80%90+EV%29+%2F+%28BAC+%E2%80%93+AC%29', 'TCPIEAC+%3D+%28ETC+%E2%80%90+EV%29+%2F+%28EAC+%E2%80%93+AC%29', '+TCPIEAC+%3D+%28BAC+%E2%80%90+EV%29+%2F+%28EAC+%E2%80%93+AC%29', '+A+%26+C', '4', 'product11491766363.jpg', '+A+%26+C', 1, NULL, NULL, NULL, NULL, NULL),
(35, 1, 2, 'Earned+Schedule+calculates+Schedule+Performance+Index+SPI+%28t%29+as%3A', '+ES+%E2%80%90+AT', '+ES+%2F+AT', 'BCWP+%28t%29+%2F+ACWP+%28t%29', '+None+of+the+above', '2', 'product11491766460.jpg', '+ES+%2F+AT', 1, NULL, NULL, NULL, NULL, NULL),
(36, 1, 4, 'Procurement+Question+1+%5Bclick+image+to+zoom%5D', '2-Preliminary+Bid+Tab', '+4-Mechanical+Equipment+Data+Sheet+', '+6-Technical+Bid+Tab+', '8-Receive+Bids', '2', 'product11491767744.jpg', '+4-Mechanical+Equipment+Data+Sheet+', 1, NULL, NULL, NULL, NULL, NULL),
(37, 1, 4, 'Procurement+Question+2+%5Bclick+image+to+zoom%5D', '+2-Preliminary+Bid+Tab', '+10-Initial+VDs+', '+8-Receive+Bids+', '+3-Code+3+VD+', '3', 'product11491768022.jpg', '+8-Receive+Bids+', 1, NULL, NULL, NULL, NULL, NULL),
(38, 1, 4, 'Procurement+Question+3+%5Bclick+image+to+zoom%5D', '+2-Preliminary+Bid+Tab+', '+5-Recieve+at+Site+', '+7-Issue+for+Purchase', '+6-Technical+Bid+Tab+', '1', 'product11491768293.jpg', '+2-Preliminary+Bid+Tab+', 1, NULL, NULL, NULL, NULL, NULL),
(39, 1, 4, 'Procurement+Question+4+%5Bclick+image+to+zoom%5D', '+9-Preliminary+VDs', '+5-Recieve+at+Site', '+7-Issue+for+Purchase', '+6-Technical+Bid+Tab+', '1', 'product11491768629.jpg', '+9-Preliminary+VDs', 1, NULL, NULL, NULL, NULL, NULL),
(40, 1, 4, 'Procurement+Question+5+%5Bclick+image+to+zoom%5D', '+3-Code+3+VD+', '+4-Mechanical+Equipment+Data+Sheet+', '+6-Technical+Bid+Tab', '+7-Issue+for+Purchase+', '3', 'product11491768914.jpg', '+6-Technical+Bid+Tab', 1, NULL, NULL, NULL, NULL, NULL),
(41, 1, 4, 'Procurement+Question+6+%5Bclick+image+to+zoom%5D', '4-Mechanical+Equipment+Data+Sheet+', '3-Code+3+VD+', '+2-Preliminary+Bid+Tab', '+7-Issue+for+Purchase', '4', 'product11491769088.jpg', '+7-Issue+for+Purchase', 1, NULL, NULL, NULL, NULL, NULL),
(42, 1, 4, 'Procurement+Question+7+%5Bclick+image+to+zoom%5D', '+2-Preliminary+Bid+Tab', '+5-Recieve+at+Site', '+3-Code+3+VD+', '+1-Award+PO+', '4', 'product11491769237.jpg', '+1-Award+PO+', 1, NULL, NULL, NULL, NULL, NULL),
(43, 1, 4, 'Procurement+Question+8+%5Bclick+image+to+zoom%5D', '+8-Receive+Bids+', '+10-Initial+VDs+', '+9-Preliminary+VDs+', '+6-Technical+Bid+Tab+', '2', 'product11491769391.jpg', '+10-Initial+VDs+', 1, NULL, NULL, NULL, NULL, NULL),
(44, 1, 4, 'Procurement+Question+9+%5Bclick+image+to+zoom%5D', '+2-Preliminary+Bid+Tab+', '+4-Mechanical+Equipment+Data+Sheet+', '3-Code+3+VD', '5-Recieve+at+Site+', '3', 'product11491769514.jpg', '3-Code+3+VD', 1, NULL, NULL, NULL, NULL, NULL),
(45, 1, 4, 'Procurement+Question+10+%5Bclick+image+to+zoom%5D', '7-Issue+for+Purchase+', '+10-Initial+VDs+', '+5-Recieve+at+Site+', '+8-Receive+Bids', '3', 'product11491769684.jpg', '+5-Recieve+at+Site+', 1, NULL, NULL, NULL, NULL, NULL),
(46, 1, 1, 'QT1+', '2-Instrument+Index+IFC', '7-Feasiblity+Reports', '6-P%26IDs+IF', '8-90%25+Model+Review', '2', 'product11491770135.jpg', '7-Feasiblity+Reports', 2, NULL, NULL, NULL, NULL, NULL),
(47, 1, 1, 'EPC+Question+1+%5Bclick+image+to+zoom%5D', '+2-Instrument+Index+IFC+', '+7-Feasiblity+Reports+', '6-P%26IDs+IFC', '8-90%25+Model+Review+', '2', 'product11491770357.jpg', '+7-Feasiblity+Reports+', 1, NULL, NULL, NULL, NULL, NULL),
(48, 1, 1, 'EPC+Question+2+%5Bclick+image+to+zoom%5D', '18-Preliminary+PFDs+', '7-Feasiblity+Reports', '3-Preliminary+Heat+%26+Material+Balance+', '11-Electrical+Load+List', '3', 'product11491770477.jpg', '3-Preliminary+Heat+%26+Material+Balance+', 1, NULL, NULL, NULL, NULL, NULL),
(49, 1, 1, 'EPC+Question+3+%5Bclick+image+to+zoom%5D', '+10-Preliminary+Equipment+List+', '+3-Preliminary+Heat+%26+Material+Balance+', '+4-RCV+Approved+VD+', '+6-P%26IDs+IFC', '1', 'product11491770618.jpg', '+10-Preliminary+Equipment+List+', 1, NULL, NULL, NULL, NULL, NULL),
(50, 1, 1, 'EPC+Question+4+%5Bclick+image+to+zoom%5D', '18-Preliminary+PFDs+', '+15-P%26IDs+IFD', '14-Civil%2FStructural+Construction', '+7-Feasiblity+Reports', '1', 'product11491770721.jpg', '18-Preliminary+PFDs+', 1, NULL, NULL, NULL, NULL, NULL),
(51, 1, 1, 'EPC+Question+5+%5Bclick+image+to+zoom%5D', '9-Electrical+One+Line+Diagrams+', '13-60%25+Model+Review+', '15-P%26IDs+IFD+', '10-Preliminary+Equipment+List+', '3', 'product11491770822.jpg', '15-P%26IDs+IFD+', 1, NULL, NULL, NULL, NULL, NULL),
(52, 1, 1, 'EPC+Question+6+%5Bclick+image+to+zoom%5D', '11-Electrical+Load+List', '+13-60%25+Model+Review', '+15-P%26IDs+IFD', '+16-Instrument+Construction', '2', 'product11491770976.jpg', '+13-60%25+Model+Review', 1, NULL, NULL, NULL, NULL, NULL),
(53, 1, 1, 'EPC+Question+7+%5Bclick+image+to+zoom%5D', '+2-Instrument+Index+IFC', '3-Preliminary+Heat+%26+Material+Balance+', '+4-RCV+Approved+VD+', '+6-P%26IDs+IFC', '4', 'product11491771077.jpg', '+6-P%26IDs+IFC', 1, NULL, NULL, NULL, NULL, NULL),
(54, 1, 1, 'EPC+Question+8+%5Bclick+image+to+zoom%5D', '2-Instrument+Index+IFC+', '+1-UG+Isometric+DWs+', '+4-RCV+Approved+VD+', '+6-P%26IDs+IFC+', '2', 'product11491771159.jpg', '+1-UG+Isometric+DWs+', 1, NULL, NULL, NULL, NULL, NULL),
(55, 1, 1, 'EPC+Question+9+%5Bclick+image+to+zoom%5D', '+7-Feasiblity+Reports+', '+13-60%25+Model+Review+', '+8-90%25+Model+Review+', '9-Electrical+One+Line+Diagrams+', '3', 'product11491771250.jpg', '+8-90%25+Model+Review+', 1, NULL, NULL, NULL, NULL, NULL),
(56, 1, 1, 'EPC+Question+10+%5Bclick+image+to+zoom%5D', '20-RCV+Initial+VD+', '+15-P%26IDs+IFD+', '+21-Isometric+IFCs', '+9-Electrical+One+Line+Diagrams', '3', 'product11491771354.jpg', '+21-Isometric+IFCs', 1, NULL, NULL, NULL, NULL, NULL),
(57, 1, 1, 'EPC+Question+11+%5Bclick+image+to+zoom%5D', '10-Preliminary+Equipment+List+', '20-RCV+Initial+V', '+21-Isometric+IFCs', '+7-Feasiblity+Reports+Q12+Find+Correct+Answer+', '2', 'product11491771449.jpg', '20-RCV+Initial+V', 1, NULL, NULL, NULL, NULL, NULL),
(58, 1, 1, 'EPC+Question+12+%5Bclick+image+to+zoom%5D', '+7-Feasiblity+Reports', '+6-P%26IDs+IFC+', '4-RCV+Approved+VD+', '+8-90%25+Model+Review+', '3', 'product11491771545.jpg', '4-RCV+Approved+VD+', 1, NULL, NULL, NULL, NULL, NULL),
(59, 1, 1, 'EPC+Question+13+%5Bclick+image+to+zoom%5D', '+19-Delivery+ETA+', '+1-UG+Isometric+DWs+', '+3-Preliminary+Heat+%26+Material+Balance+', '+4-RCV+Approved+VD+', '1', 'product11491771647.jpg', '+19-Delivery+ETA+', 1, NULL, NULL, NULL, NULL, NULL),
(60, 1, 1, 'EPC+Question+14+%5Bclick+image+to+zoom%5D', '+5-Piping+Construction+', '+16-Instrument+Construction+', '17-Mechanical+Construction+', '+14-Civil%2FStructural+Construction+', '1', 'product11491771721.jpg', '+5-Piping+Construction+', 1, NULL, NULL, NULL, NULL, NULL),
(61, 1, 1, 'EPC+Question+15+%5Bclick+image+to+zoom%5D', '5-Piping+Construction+', '+16-Instrument+Construction+', '14-Civil%2FStructural+Construction', '+11-Electrical+Load+List+', '3', 'product11491771819.jpg', '14-Civil%2FStructural+Construction', 1, NULL, NULL, NULL, NULL, NULL),
(62, 1, 1, 'EPC+Question+16+%5Bclick+image+to+zoom%5D', '6-P%26IDs+IFC+', '2-Instrument+Index+IFC+', '+3-Preliminary+Heat+%26+Material+Balance+', '+7-Feasiblity+Reports+', '2', 'product11491771918.jpg', '2-Instrument+Index+IFC+', 1, NULL, NULL, NULL, NULL, NULL),
(63, 1, 1, 'EPC+Question+17+%5Bclick+image+to+zoom%5D', '+13-60%25+Model+Review+', '+15-P%26IDs+IFD', '+18-Preliminary+PFDs', '+11-Electrical+Load+List+', '4', 'product11491772010.jpg', '+11-Electrical+Load+List+', 1, NULL, NULL, NULL, NULL, NULL),
(64, 1, 1, 'EPC+Question+18+%5Bclick+image+to+zoom%5D', '+8-90%25+Model+Review+', '+9-Electrical+One+Line+Diagrams+', '+10-Preliminary+Equipment+List+', '+11-Electrical+Load+List+', '2', 'product11491772101.jpg', '+9-Electrical+One+Line+Diagrams+', 1, NULL, NULL, NULL, NULL, NULL),
(65, 1, 1, 'EPC+Question+19+%5Bclick+image+to+zoom%5D', '+14-Civil%2FStructural+Construction+', '16-Instrument+Construction+', '+17-Mechanical+Construction', '+19-Delivery+ETA+', '3', 'product11491772195.jpg', '+17-Mechanical+Construction', 1, NULL, NULL, NULL, NULL, NULL),
(66, 1, 1, 'EPC+Question+20+%5Bclick+image+to+zoom%5D', '14-Civil%2FStructural+Construction+', '+19-Delivery+ETA', '+16-Instrument+Construction+', '17-Mechanical+Construction+', '3', 'product11491772272.jpg', '+16-Instrument+Construction+', 1, NULL, NULL, NULL, NULL, NULL),
(67, 1, 1, 'EPC+Question+21+%5Bclick+image+to+zoom%5D', '+16-Instrument+Construction+', '+17-Mechanical+Construction+', '+12-Commissioning+', '+14-Civil%2FStructural+Construction', '3', 'product11491772350.jpg', '+12-Commissioning+', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE IF NOT EXISTS `tbl_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `bannergroupid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bannergroupid` (`bannergroupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_breakdown`
--

CREATE TABLE IF NOT EXISTS `tbl_breakdown` (
  `breakdownid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_language_id` int(11) NOT NULL,
  `breakdowntitle` varchar(255) DEFAULT NULL,
  `statuscheck` int(11) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`breakdownid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_breakdown`
--

INSERT INTO `tbl_breakdown` (`breakdownid`, `fk_language_id`, `breakdowntitle`, `statuscheck`, `createdatetime`) VALUES
(1, 1, 'Onshore+WBS', 1, '2017-03-09 12:14:33'),
(2, 1, 'OffShore+WBS', 1, '2017-03-09 12:16:32'),
(3, 1, 'Subsea+WBS', 1, '2017-03-09 12:18:11'),
(4, 1, 'PBS+%26+DBS', 1, '2017-03-09 12:18:33'),
(5, 1, 'OBS', 1, '2017-03-09 12:18:52'),
(6, 1, 'CBS', 1, '2017-03-09 12:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_breakdown_image`
--

CREATE TABLE IF NOT EXISTS `tbl_breakdown_image` (
  `breakdownimgid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_breakdownid` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumbimage` varchar(255) DEFAULT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`breakdownimgid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_breakdown_image`
--

INSERT INTO `tbl_breakdown_image` (`breakdownimgid`, `fk_breakdownid`, `image`, `thumbimage`, `createdatetime`) VALUES
(1, 1, 'product11491424143.jpg', '', '2017-03-09 12:14:33'),
(2, 2, 'product11491424217.jpg', '', '2017-03-09 12:16:32'),
(3, 3, 'product11491425063.jpg', '', '2017-03-09 12:18:11'),
(4, 4, 'product11491425084.jpg', '', '2017-03-09 12:18:33'),
(5, 5, 'product11491425100.jpg', '', '2017-03-09 12:18:52'),
(6, 6, 'product11491425575.jpg', '', '2017-03-09 12:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_language_id` int(11) NOT NULL,
  `categoryparentid` int(11) NOT NULL,
  `categoryname` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `parentcategoryid` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `posttypeid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  `brandtype_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cms`
--

CREATE TABLE IF NOT EXISTS `tbl_cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cmsparentid` int(11) NOT NULL,
  `fk_language_id` int(11) NOT NULL,
  `cms_page_name` varchar(80) NOT NULL,
  `cms_page_content` varchar(1500) NOT NULL,
  `meta_title` varchar(80) NOT NULL,
  `meta_description` varchar(1000) NOT NULL,
  `meta_keyword` varchar(1000) NOT NULL,
  `status` int(2) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_cms`
--

INSERT INTO `tbl_cms` (`id`, `cmsparentid`, `fk_language_id`, `cms_page_name`, `cms_page_content`, `meta_title`, `meta_description`, `meta_keyword`, `status`, `createdby`, `createdatetime`, `updatedby`, `updatedatetime`, `ip_address`) VALUES
(1, 0, 0, 'About+Us', '%3Cp%3E%3Cspan+style%3D%22font-size%3A18px%3B%22%3E%3Cspan+style%3D%22font-family%3A+verdana%2Cgeneva%2Csans-serif%3B%22%3E%3Cstrong%3EAdvanced+Project+Analytics%3C%2Fstrong%3E%3C%2Fspan%3E%3C%2Fspan%3E%3C%2Fp%3E%0A%0A%3Cp%3EVersion+1.0%3C%2Fp%3E%0A%0A%3Cp%3ECopyright+%26copy%3B+2017+-+Advanced+Planning+Analytics%2C%26nbsp%3B+All+Rights+Reserved.%3C%2Fp%3E%0A%0A%3Cp%3EAdvanced+Planning+Analytics%3Cbr+%2F%3E%0A%3Cu%3E%3Ca+href%3D%22http%3A%2F%2Fwww.advancedplanninganalytics.com%2F%22%3Ewww.advancedplanninganalytics.com%3C%2Fa%3E+%3C%2Fu%3E%3C%2Fp%3E%0A', '', '', '', 1, 0, '0000-00-00 00:00:00', 20, '2017-04-09 21:20:55', ''),
(2, 0, 0, 'Help', '%3Cp%3E%3Cstrong%3E%3Cspan+style%3D%22font-size%3A18px%3B%22%3E%3Cspan+style%3D%22font-family%3A+verdana%2Cgeneva%2Csans-serif%3B%22%3ESupport+%26amp%3B+Feedback%3C%2Fspan%3E%3C%2Fspan%3E%3C%2Fstrong%3E%3C%2Fp%3E%0A%0A%3Cp%3EFor+technical+support%2C+questions+or+feedback+on+this+application%2C+please+contact%3C%2Fp%3E%0A%0A%3Cp%3E%3Ca+href%3D%22mailto%3ACesar.ramos%40advancedplanninganalytics.com%22%3ECesar.ramos%40advancedplanninganalytics.com%3C%2Fa%3E%3C%2Fp%3E%0A%0A%3Cp%3ECopyright+%26copy%3B+2017+-+Advanced+Planning+Analytics%2C%26nbsp%3B+All+Rights+Reserved.%3C%2Fp%3E%0A', '', '', '', 1, 0, '0000-00-00 00:00:00', 20, '2017-04-09 21:23:49', ''),
(3, 0, 0, 'Privacy+Policy', '%3Cp%3E%3Cspan+style%3D%22font-size%3A18px%3B%22%3E%3Cspan+style%3D%22font-family%3A+verdana%2Cgeneva%2Csans-serif%3B%22%3E%3Cstrong%3EPrivacy+Policy%3C%2Fstrong%3E%3C%2Fspan%3E%3C%2Fspan%3E%3C%2Fp%3E%0A%0A%3Ch2+class%3D%22wsite-content-title%22%3Ewww.advancedplanninganalytics.com%3C%2Fh2%3E%0A%0A%3Cp%3EThis+privacy+policy+has+been+compiled+to+better+serve+those+who+are+concerned+with+how+their+%26%2339%3BPersonally+Identifiable+Information%26%2339%3B+%28PII%29+is+being+used+online.+PII%2C+as+described+in+US+privacy+law+and+information+security%2C+is+information+that+can+be+used+on+its+own+or+with+other+information+to+identify%2C+contact%2C+or+locate+a+single+person%2C+or+to+identify+an+individual+in+context.+Please+read+our+privacy+policy+carefully+to+get+a+clear+understanding+of+how+we+collect%2C+use%2C+protect+or+otherwise+handle+your+Personally+Identifiable+Information+in+accordance+with+our+website.%3Cbr+%2F%3E%0A%3Cbr+%2F%3E%0A%3Cstrong%3EWhat+personal+information+do+we+collect+from+the+people+that+visit+our+blog%2C+website+or+app%3F%3C%2Fstrong%3E%3Cbr+%2F%3E%0AWhen+ordering+or+registering+on+our+site%2C+as+appropriate%2C+you+may+be+asked+to+enter+your+name%2C+email+address%2C+mailing+address%2C+phone+number%2C+credit+card+information+or+other+details+to+help+you+with+your+experience.%3Cbr+%2F%3E%0A%3Cbr+%2F%3E%0A%3Cstrong%3EWhen+do+we+collect+information%3F%3C%2Fstrong%3E%3Cbr+%2F%3E%0AWe+collect+information+from+you+when+you+register+on+our+site%2C+place+an+order%2C+', '', '', '', 1, 0, '0000-00-00 00:00:00', 20, '2017-04-09 21:30:07', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` int(2) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `name`, `email`, `mobile`, `message`, `status`, `created_date`, `modified_date`, `ip_address`) VALUES
(1, 'Hsjs', 'vishal.dhamecha%40vrinsoft.com', '997346465', 'Jdjsk%0ADjdj+sjjdd%0AAkf', 1, '2017-04-21 01:35:58', '2017-04-21 01:35:58', ''),
(2, 'Vishal+Dhamecha', 'vishal%40gmail.com', '87848454', 'Bxjdjdjkss', 1, '2017-04-21 03:28:41', '2017-04-21 03:28:41', ''),
(3, 'Ghanshyam', 'ghanshyams011%40gmail.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-21 03:35:49', '2017-04-21 03:35:49', ''),
(4, 'Ghanshyam', 'ghanshyams011%40gmail.com', '9998749341', 'This+is+the+testing+api', 1, '2017-04-21 04:33:46', '2017-04-21 04:33:46', ''),
(5, 'nirali', 'nirali.vrinsoft%40gmail.com', '898989898989', 'Test', 1, '2017-04-21 05:24:44', '2017-04-21 05:24:44', ''),
(6, 'Cesar', 'hourcc%40yahoo.com', '8325976578', 'Testing', 1, '2017-04-22 21:51:51', '2017-04-22 21:51:51', ''),
(7, 'tx', 'nirali.vrinsoft%40gmail.com', '', 'test', 1, '2017-04-24 05:22:56', '2017-04-24 05:22:56', ''),
(8, 'test', 'krishna.vrinsofts%40gmail.com', '1425388', 'test+from+admin', 1, '2017-04-24 08:39:20', '2017-04-24 08:39:20', ''),
(9, 'test', 'test%40gmail.com', '558', 'gg', 1, '2017-04-24 10:18:27', '2017-04-24 10:18:27', ''),
(10, 'Vishal', 'vishal.dhamecha%40vrinsofts.com', '2424', 'Hehsj', 1, '2017-04-24 23:48:02', '2017-04-24 23:48:02', ''),
(11, 'This+Is+Test', 'vishal%40gmail.com', '5454', 'Hdhsjshs', 1, '2017-04-24 23:49:00', '2017-04-24 23:49:00', ''),
(12, 'Hot+It', 'gg%40gmail.com', '5454', 'Hdhshsus', 1, '2017-04-24 23:54:31', '2017-04-24 23:54:31', ''),
(13, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:31:56', '2017-04-25 00:31:56', ''),
(14, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:31:59', '2017-04-25 00:31:59', ''),
(15, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:54:23', '2017-04-25 00:54:23', ''),
(16, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:54:25', '2017-04-25 00:54:25', ''),
(17, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:54:30', '2017-04-25 00:54:30', ''),
(18, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:55:24', '2017-04-25 00:55:24', ''),
(19, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:55:33', '2017-04-25 00:55:33', ''),
(20, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:56:01', '2017-04-25 00:56:01', ''),
(21, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:56:02', '2017-04-25 00:56:02', ''),
(22, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:56:03', '2017-04-25 00:56:03', ''),
(23, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:56:16', '2017-04-25 00:56:16', ''),
(24, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:56:28', '2017-04-25 00:56:28', ''),
(25, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:56:29', '2017-04-25 00:56:29', ''),
(26, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:56:30', '2017-04-25 00:56:30', ''),
(27, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:57:18', '2017-04-25 00:57:18', ''),
(28, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:57:33', '2017-04-25 00:57:33', ''),
(29, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:59:04', '2017-04-25 00:59:04', ''),
(30, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 00:59:45', '2017-04-25 00:59:45', ''),
(31, 'Ghanshyam', 'hitesh.vala%40vrinsofts.com', '9998749341', 'This+is+the+testing+api.', 1, '2017-04-25 01:00:14', '2017-04-25 01:00:14', ''),
(32, 'Hello', 'vishal.vrinsoft%40gmail.com', '8484', 'Behsjsj', 1, '2017-04-25 09:51:52', '2017-04-25 09:51:52', ''),
(33, 'Cr', 'hourcc%40gmail.com', '', 'Testing', 1, '2017-04-27 12:42:04', '2017-04-27 12:42:04', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emailtemplate`
--

CREATE TABLE IF NOT EXISTS `tbl_emailtemplate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `templatename` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `htmllayout` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evm`
--

CREATE TABLE IF NOT EXISTS `tbl_evm` (
  `evmid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_language_id` int(11) NOT NULL,
  `evmttitle` varchar(255) DEFAULT NULL,
  `statuscheck` int(11) DEFAULT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`evmid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_evm`
--

INSERT INTO `tbl_evm` (`evmid`, `fk_language_id`, `evmttitle`, `statuscheck`, `createdatetime`) VALUES
(1, 1, 'EVM+Summary', 1, '2017-03-14 14:26:14'),
(2, 1, 'Test+2', 2, '2017-03-16 04:41:52'),
(3, 1, 'test+3', 2, '2017-03-16 04:42:14'),
(4, 1, 'test+4', 2, '2017-03-16 04:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evm_image`
--

CREATE TABLE IF NOT EXISTS `tbl_evm_image` (
  `evmimgid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_evmid` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumbimage` varchar(250) DEFAULT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`evmimgid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_evm_image`
--

INSERT INTO `tbl_evm_image` (`evmimgid`, `fk_evmid`, `image`, `thumbimage`, `createdatetime`) VALUES
(1, 1, 'product11491449349.jpg', '', '2017-03-14 14:26:14'),
(2, 2, 'product11489639312.jpg', 'productthumb1489639312.jpg', '2017-03-16 04:41:52'),
(3, 3, 'product11489639334.jpg', 'productthumb1489639334.jpg', '2017-03-16 04:42:14'),
(4, 4, 'product11489639373.jpg', '', '2017-03-16 04:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forensic`
--

CREATE TABLE IF NOT EXISTS `tbl_forensic` (
  `forensicid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_language_id` int(11) NOT NULL,
  `forensictitle` varchar(250) DEFAULT NULL,
  `statuscheck` int(11) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`forensicid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_forensic`
--

INSERT INTO `tbl_forensic` (`forensicid`, `fk_language_id`, `forensictitle`, `statuscheck`, `createdatetime`) VALUES
(1, 1, 'Overview', 1, '2017-03-09 12:06:56'),
(2, 1, 'Observed', 1, '2017-03-09 12:07:17'),
(3, 1, 'Modeled', 1, '2017-03-09 12:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forensic_image`
--

CREATE TABLE IF NOT EXISTS `tbl_forensic_image` (
  `forensicimgid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_forensicid` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumbimage` varchar(255) DEFAULT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`forensicimgid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_forensic_image`
--

INSERT INTO `tbl_forensic_image` (`forensicimgid`, `fk_forensicid`, `image`, `thumbimage`, `createdatetime`) VALUES
(1, 1, 'product11491450637.jpg', '', '2017-03-09 12:06:56'),
(2, 2, 'product11491450648.jpg', '', '2017-03-09 12:07:17'),
(3, 3, 'product11491450659.jpg', '', '2017-03-09 12:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fragnets`
--

CREATE TABLE IF NOT EXISTS `tbl_fragnets` (
  `fragnetid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_language_id` int(11) NOT NULL,
  `fragnettitle` varchar(250) DEFAULT NULL,
  `statuscheck` int(11) DEFAULT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fragnetid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_fragnets`
--

INSERT INTO `tbl_fragnets` (`fragnetid`, `fk_language_id`, `fragnettitle`, `statuscheck`, `createdatetime`) VALUES
(1, 1, 'OnShore', 1, '2017-03-09 12:01:00'),
(2, 1, 'OffShore', 1, '2017-03-09 12:01:19'),
(3, 1, 'Subsea', 1, '2017-03-09 12:01:40'),
(4, 1, 'Oilfield', 1, '2017-03-09 12:02:14'),
(5, 1, 'Commission', 1, '2017-03-09 12:02:46'),
(6, 1, 'Turnaround', 1, '2017-03-09 12:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fragnets_image`
--

CREATE TABLE IF NOT EXISTS `tbl_fragnets_image` (
  `fragnetimgid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_fragnetid` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumbimage` varchar(255) DEFAULT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fragnetimgid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_fragnets_image`
--

INSERT INTO `tbl_fragnets_image` (`fragnetimgid`, `fk_fragnetid`, `image`, `thumbimage`, `createdatetime`) VALUES
(1, 1, 'product11491424778.jpg', '', '2017-03-09 12:01:00'),
(2, 2, 'product11491440470.jpg', '', '2017-03-09 12:01:19'),
(3, 3, 'product11491443946.jpg', '', '2017-03-09 12:01:40'),
(4, 4, 'product11491444164.jpg', '', '2017-03-09 12:02:14'),
(5, 5, 'product11491444179.jpg', '', '2017-03-09 12:02:46'),
(6, 6, 'product11491444192.jpg', '', '2017-03-09 12:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_language`
--

CREATE TABLE IF NOT EXISTS `tbl_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `languagename` varchar(100) NOT NULL,
  `shortcode` varchar(50) NOT NULL,
  `fixdefault` int(2) NOT NULL,
  `image` varchar(500) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_layout`
--

CREATE TABLE IF NOT EXISTS `tbl_layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `location` varchar(100) NOT NULL,
  `orderby` int(11) NOT NULL,
  `moduleid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` int(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `layoutid` int(11) NOT NULL,
  `menugroupid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menugroup`
--

CREATE TABLE IF NOT EXISTS `tbl_menugroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menugroupname` varchar(255) NOT NULL,
  `layoutid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE IF NOT EXISTS `tbl_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `actionid` int(11) NOT NULL COMMENT 'i.e. 1-Add data,2-deletion,3-editing',
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE IF NOT EXISTS `tbl_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulename` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `orderby` int(10) NOT NULL,
  `sectionname` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `layoutid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules_permission`
--

CREATE TABLE IF NOT EXISTS `tbl_modules_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_admin_id` int(11) NOT NULL COMMENT '(manager,customer)',
  `fk_permission_id` int(11) NOT NULL,
  `p_field1` int(2) NOT NULL COMMENT '0 - No , 1 - Yes (View)',
  `p_field2` int(2) NOT NULL COMMENT '0 - No , 1 - Yes (ADD)',
  `p_field3` int(2) NOT NULL COMMENT '0 - No , 1 - Yes (EDIT)',
  `p_field4` int(2) NOT NULL COMMENT '0 - No , 1 - Yes(DELETE)',
  `status` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedatetime` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `updatedby` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=176 ;

--
-- Dumping data for table `tbl_modules_permission`
--

INSERT INTO `tbl_modules_permission` (`id`, `fk_admin_id`, `fk_permission_id`, `p_field1`, `p_field2`, `p_field3`, `p_field4`, `status`, `createdatetime`, `updatedatetime`, `createdby`, `updatedby`) VALUES
(39, 1, 1, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-10-01 06:21:25', 1, 1),
(40, 1, 2, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(41, 1, 3, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(42, 1, 4, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(43, 1, 5, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(44, 1, 6, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(45, 1, 7, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(46, 1, 8, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(47, 1, 9, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(48, 1, 10, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-10-08 03:00:50', 1, 1),
(49, 1, 11, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(50, 1, 12, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(51, 1, 13, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(52, 1, 14, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(53, 1, 15, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(54, 1, 16, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(55, 1, 17, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-10-10 22:49:55', 1, 1),
(56, 1, 18, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(57, 1, 19, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(77, 19, 1, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(78, 19, 2, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(79, 19, 3, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(80, 19, 4, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(81, 19, 5, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(82, 19, 6, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(83, 19, 7, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(84, 19, 8, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(85, 19, 9, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(86, 19, 10, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(87, 19, 11, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(88, 19, 12, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(89, 19, 13, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(90, 19, 14, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(91, 19, 15, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(92, 19, 16, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(93, 19, 17, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(94, 19, 18, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(95, 19, 19, 1, 1, 1, 1, 1, '2016-10-02 03:33:06', '2016-10-02 03:33:06', 1, 1),
(96, 1, 20, 1, 1, 1, 1, 1, '2016-08-02 09:47:00', '2016-09-15 00:00:00', 1, 1),
(97, 1, 1, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-10-01 06:21:25', 1, 1),
(98, 1, 2, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(99, 1, 3, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(100, 1, 4, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(101, 1, 5, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(102, 1, 6, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(103, 1, 7, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(104, 1, 8, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(105, 1, 9, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(106, 1, 10, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-10-08 03:00:50', 1, 1),
(107, 1, 11, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(108, 1, 12, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(109, 1, 13, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(110, 1, 14, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(111, 1, 15, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(112, 1, 16, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(113, 1, 17, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-10-10 22:49:55', 1, 1),
(114, 1, 18, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(115, 1, 19, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(116, 19, 1, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(117, 19, 2, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(118, 19, 3, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(119, 19, 4, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(120, 19, 5, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(121, 19, 6, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(122, 19, 7, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(123, 19, 8, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(124, 19, 9, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(125, 19, 10, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(126, 19, 11, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(127, 19, 12, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(128, 19, 13, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(129, 19, 14, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(130, 19, 15, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(131, 19, 16, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(132, 19, 17, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(133, 19, 18, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(134, 19, 19, 1, 1, 1, 1, 1, '2016-10-02 03:33:06', '2016-10-02 03:33:06', 1, 1),
(135, 1, 20, 1, 1, 1, 1, 1, '2016-08-02 09:47:00', '2016-09-15 00:00:00', 1, 1),
(136, 1, 1, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-10-01 06:21:25', 1, 1),
(137, 1, 2, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(138, 1, 3, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(139, 1, 4, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(140, 1, 5, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(141, 1, 6, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(142, 1, 7, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(143, 1, 8, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(144, 1, 9, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(145, 1, 10, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-10-08 03:00:50', 1, 1),
(146, 1, 11, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(147, 1, 12, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(148, 1, 13, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(149, 1, 14, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(150, 1, 15, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(151, 1, 16, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(152, 1, 17, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-10-10 22:49:55', 1, 1),
(153, 1, 18, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(154, 1, 19, 1, 1, 1, 1, 1, '2016-09-28 05:59:58', '2016-09-28 05:59:58', 1, 1),
(155, 19, 1, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(156, 19, 2, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(157, 19, 3, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(158, 19, 4, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(159, 19, 5, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(160, 19, 6, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(161, 19, 7, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(162, 19, 8, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(163, 19, 9, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(164, 20, 17, 1, 0, 0, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(165, 20, 16, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(166, 20, 9, 1, 0, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(167, 20, 13, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(168, 20, 14, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(169, 20, 12, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(170, 20, 11, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(171, 20, 10, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(172, 20, 1, 1, 1, 1, 1, 1, '2016-10-02 03:33:05', '2016-10-02 03:33:05', 1, 1),
(173, 20, 41, 1, 1, 1, 1, 1, '2016-10-02 03:33:06', '2016-10-02 03:33:06', 1, 1),
(174, 20, 20, 1, 1, 1, 1, 1, '2016-08-02 09:47:00', '2016-09-15 00:00:00', 1, 1),
(175, 20, 15, 1, 1, 1, 1, 1, '2017-02-16 00:00:00', '2017-02-16 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newletter`
--

CREATE TABLE IF NOT EXISTS `tbl_newletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsparentid` int(11) NOT NULL,
  `fk_language_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `posttype` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `activatefrom` datetime NOT NULL,
  `activateto` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission`
--

CREATE TABLE IF NOT EXISTS `tbl_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulename` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `tbl_permission`
--

INSERT INTO `tbl_permission` (`id`, `modulename`, `status`, `createdby`, `createdatetime`, `updatedby`, `updatedatetime`) VALUES
(1, 'Product', 1, 1, '2016-09-23 01:25:19', 1, '2016-10-04 04:26:50'),
(2, 'Language', 1, 1, '2016-09-23 01:25:28', 1, '2016-09-23 01:25:28'),
(3, 'Banner', 1, 1, '2016-09-23 01:25:33', 1, '2016-09-23 01:25:33'),
(4, 'Blog', 1, 1, '2016-09-23 01:25:39', 1, '2016-09-23 01:25:39'),
(5, 'Discount', 1, 1, '2016-09-26 22:39:58', 1, '2016-09-26 22:39:58'),
(6, 'City', 1, 1, '2016-09-26 22:40:08', 1, '2016-09-26 22:40:08'),
(7, 'State', 1, 1, '2016-09-26 22:40:14', 1, '2016-09-26 22:40:14'),
(8, 'Country', 1, 1, '2016-09-26 22:40:21', 1, '2016-09-26 22:40:21'),
(9, 'Customers', 1, 1, '2016-09-26 22:40:51', 1, '2016-09-26 22:40:51'),
(10, 'Shipping', 1, 1, '2016-09-26 22:41:00', 1, '2016-09-26 22:41:00'),
(11, 'Template', 1, 1, '2016-09-26 22:41:11', 1, '2016-09-26 22:41:11'),
(12, 'Post Type', 1, 1, '2016-09-26 22:41:20', 1, '2016-09-26 22:41:20'),
(13, 'News Letter', 1, 1, '2016-09-26 22:41:29', 1, '2016-09-26 22:41:29'),
(14, 'Testimonial', 1, 1, '2016-09-26 22:41:50', 1, '2016-09-26 22:41:50'),
(15, 'CMS', 1, 1, '2016-09-26 22:41:58', 1, '2016-09-26 22:41:58'),
(16, 'Product Attribute', 1, 1, '2016-09-26 22:42:26', 1, '2016-09-26 22:42:26'),
(17, 'Category', 1, 1, '2016-09-26 22:42:33', 1, '2016-09-26 22:42:33'),
(18, 'Zipcode', 1, 1, '2016-09-26 23:20:18', 1, '2016-09-26 23:20:18'),
(19, 'Label', 1, 1, '2016-09-27 01:39:50', 1, '2016-09-27 01:39:50'),
(20, 'Currency', 1, 1, '2016-10-07 22:18:03', 1, '2016-10-07 22:18:03'),
(21, 'Product', 1, 1, '2016-09-23 01:25:19', 1, '2016-10-04 04:26:50'),
(22, 'Language', 1, 1, '2016-09-23 01:25:28', 1, '2016-09-23 01:25:28'),
(23, 'Banner', 1, 1, '2016-09-23 01:25:33', 1, '2016-09-23 01:25:33'),
(24, 'Blog', 1, 1, '2016-09-23 01:25:39', 1, '2016-09-23 01:25:39'),
(25, 'Discount', 1, 1, '2016-09-26 22:39:58', 1, '2016-09-26 22:39:58'),
(26, 'City', 1, 1, '2016-09-26 22:40:08', 1, '2016-09-26 22:40:08'),
(27, 'State', 1, 1, '2016-09-26 22:40:14', 1, '2016-09-26 22:40:14'),
(28, 'Country', 1, 1, '2016-09-26 22:40:21', 1, '2016-09-26 22:40:21'),
(29, 'Customers', 1, 1, '2016-09-26 22:40:51', 1, '2016-09-26 22:40:51'),
(30, 'Shipping', 1, 1, '2016-09-26 22:41:00', 1, '2016-09-26 22:41:00'),
(31, 'Template', 1, 1, '2016-09-26 22:41:11', 1, '2016-09-26 22:41:11'),
(32, 'Post Type', 1, 1, '2016-09-26 22:41:20', 1, '2016-09-26 22:41:20'),
(33, 'News Letter', 1, 1, '2016-09-26 22:41:29', 1, '2016-09-26 22:41:29'),
(34, 'Testimonial', 1, 1, '2016-09-26 22:41:50', 1, '2016-09-26 22:41:50'),
(35, 'CMS', 1, 1, '2016-09-26 22:41:58', 1, '2016-09-26 22:41:58'),
(36, 'Product Attribute', 1, 1, '2016-09-26 22:42:26', 1, '2016-09-26 22:42:26'),
(37, 'Category', 1, 1, '2016-09-26 22:42:33', 1, '2016-09-26 22:42:33'),
(38, 'Zipcode', 1, 1, '2016-09-26 23:20:18', 1, '2016-09-26 23:20:18'),
(39, 'Label', 1, 1, '2016-09-27 01:39:50', 1, '2016-09-27 01:39:50'),
(40, 'Currency', 1, 1, '2016-10-07 22:18:03', 1, '2016-10-07 22:18:03'),
(41, 'test', 1, 1, '2017-02-17 00:00:00', 1, '2017-02-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE IF NOT EXISTS `tbl_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(50) NOT NULL,
  `modulesid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `validfrom` datetime NOT NULL,
  `validto` datetime NOT NULL,
  `createdby` datetime NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` datetime NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projectwheel`
--

CREATE TABLE IF NOT EXISTS `tbl_projectwheel` (
  `wheelid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_wheelcategoryid` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `adress` varchar(250) DEFAULT NULL,
  `description` text,
  `email` varchar(100) DEFAULT NULL,
  `office` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`wheelid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tbl_projectwheel`
--

INSERT INTO `tbl_projectwheel` (`wheelid`, `fk_wheelcategoryid`, `title`, `adress`, `description`, `email`, `office`, `mobile`, `fax`, `status`, `createddate`) VALUES
(1, 1, 'Titlerer', 'fsdfsdf', 'fdsfsdfs', 'fsdfsdfsd@gmail.com', '23423423', '2344234234', '23423432', 2, '2017-03-14 10:42:25'),
(2, 2, 'fwerewr', 'rewrwer', 'rwerwer', 'rwer4534r34@gmail.com', '233423423', '432423', '423423', 2, '2017-03-14 13:18:36'),
(3, 1, 'Titlerer1', 'abc', 'abc', 'ghanshyam.vrinsoft@gmail.com', '9998749341', '9998749341', '9998749341', 2, '2017-03-14 13:23:48'),
(4, 1, 'Gate+2+%26+3+Feed+Phase+2+%2F+Phase+3', '', 'Lorem+Ipsum+is+simply+dummy+text+of+the+printing+and+typesetting+industry.+Lorem+Ipsum+has+been+the+industry%27s+standard+dummy+text+ever+since+the+1500s', 'test@gmail.com', '+1 852 65311 55', '+98754656231', '+1 852 1212 125', 2, '2017-04-01 09:20:10'),
(5, 1, 'Gate+4+Detail+Design+Phase+4', '', 'Lorem+Ipsum+is+simply+dummy+text+of+the+printing+and+typesetting+industry.+Lorem+Ipsum+has+been+the+industry%27s+standard+dummy+text+ever+since+the+1500s', 'test1@gmail.com', '+1 852 65311 551', '+987546562311', '+1 852 1212 1251', 2, '2017-04-01 09:37:44'),
(6, 2, 'Contractors+Document+Level+5', 'gota+%2C+S.G.Highway', 'This+data+is+added+for+testing+so%2C+please+do+not+assume+thats+real+data+its+just+for+testing.', 'a@gmail.com', '079288891', '9985577899', '125-4569-7595-784-12', 2, '2017-04-03 05:08:12'),
(7, 2, 'Contractors+Document+Level+4', 'kalupur+railway+station', 'djaljllasf+sdfsdflsf+sdfpsdf+sf+sf+ds+fs+df+sdf+', 'b@gmail.com', '79797946', '4644946464', '13149979446', 2, '2017-04-03 05:08:40'),
(8, 1, 'Gate+5+Detail+Design+Phase+4', 'sg+highway', 'Project+deliverables+scop+of+work+initiates+the+following+work', 'c@gmail.com', '+1 888 476 5848', '+1 832 597 6578', '+1 866 291 1068', 2, '2017-04-03 05:38:28'),
(9, 1, 'Gate+6+Detail+Design+Phase+4', 'gota', 'this+is+dummy+text+lorem+lipsum+ipsum.', 'd@gmail.com', '131346464', '9985577899', '5635635353', 2, '2017-04-03 05:39:51'),
(10, 2, 'Contractors+Document+Level+6', 'dfsfsfsfsf', 'fsdfsdfsfsf+sfsfsdf+sfsfs', 'l@gmail.com', '4644646', '543645345345', '4544564', 2, '2017-04-03 05:42:38'),
(11, 2, 'Contractors+Document+Level+7', 'dgdfgdfgd', 'dgdfgdgdgd+dgdfggdg', 'f@gmail.com', '46466', '580088220', '4569646', 2, '2017-04-03 05:43:39'),
(12, 1, 'Gate+0+%5BConcept+Selection%5D+Phase+0+%2F+Phase+1', '', 'Concept+Development%09%09%0AConcept+Selection%09%09%0AFeasibility+Reports%09%09%0APreliminary+PEP%09%09%0APreliminary+Process+Design+Basis%09%09%0AProcess+Alternatives+Evaluations+Summary%09%0APreliminary+Process+Simulation+and+Heat+and+Material+Balance+Data%0APreliminary+Process+Flow+Diagrams+%28PFDs%29%09%0APreliminary+Equipment+List%09%09%0APreliminary+Major+Equipment+Conditions+of+Service+List%0APreliminary+Capital+and+Operating+Cost+Estimate+%28%2B50%25+%2F-30%25%29%0APreliminary+Summary+of+Raw+Materials+and+Utility+Requirements%0AProcess+Risk+Summary.%0A', '', '', '', '', 1, '2017-04-06 11:58:27'),
(13, 1, 'Gate+2+%26+3++%5BFEED%5D+Phase+2+%2F+Phase+3', '', 'Process+design+basis%0AMaterial+%26+Energy+Balance+%28M%26EB%29%09%0AProcess+Flow+Diagrams+%28PFDs%29%09%0AProcess+descriptions%0AUtility+balances+and+Utility+Flow+Diagrams+%28UFDs%29%0APreliminary+Piping+%26+Instrumentation+Diagrams+%28P%26IDs%29%09%0AProcess+control+description%0APreliminary+line%2Fpipe+list%0APreliminary+instrument+list%0AProcess+equipment+list%0APreliminary+Tie-in+list%0AEquipment+process+datasheets%09%0AInstrument+process+datasheets%09%0AHydraulic+design+reports.%0A30%25+Model+Review%0A', '', '', '', '', 1, '2017-04-06 12:10:32'),
(14, 1, 'Gate+4++%5BDetail+Design+1%5D+Phase+4+%2F+%5BDetail+Design+1%5D', '', 'General+arrangement+drawings%09%0ABuilding+requirements%0AGeneral+description+of+the+project+site%09%0ABudget+pricing+from+vendors+on+major+pieces+of+equipment%0AProcess+design+philosophiesRelief+system+design+basis%09%0ARelief+scenario+datasheets+and+relief+valve+process+datasheets%0AMaterial+Selection+Diagrams+%28MSDs%29+%26+piping+specifications%0ATie-in+list%09%0AIdentification+of+power+source+and+location%0ASingle+line+diagrams%0AProcess+specialty+items+list%0ARaw+material+and+product+storage+and+handling+requirements%0AProcess+effluent+and+emissions+summary%09%0AProcess+risk+analysis+%28PHA%2C+HAZOP%2C+etc.%29%09%0APreliminary+operating+procedures%09%0APreliminary+product+and+in-process+QC+sampling%2Ftesting+plan%0APreliminary+project+schedule.%0A60%25+Model+Review%0A', '', '', '', '', 1, '2017-04-06 12:12:29'),
(15, 1, 'Gate+4.5++%5BDetail+Design+2%5DPhase+4.5+%2F+%5BDetail+Design+2%5D', '', 'Site+Prep+IFC%0AInfrastructure+IFC%0ACivil+Excavation%2FBackfil+IFC%0AUnderground+Pipe+IFC%0ACivil+Foundations+IFC%0AStructural+Steel+IFC%0AMechanical+Equipment+Plan%0ALarge+Bore+Isometrics+IFC%0ASmall+Bore+Isometrics+IFC%0AElectrical+DWGs%0AInstrumentation+DWGs%0ASoft+Craft+Contract+Cycles%0A90%25+Model+Review', '', '', '', '', 1, '2017-04-06 12:17:27'),
(16, 1, 'Gate+5++%5BConstruction%5D+Phase+5', '', 'Site+Prep%0AInfrastructure%0ACivil+Excavation%2FBackfill%0AUnderground+Pipe%0ACivil+Foundations%0AStructural+Steel%0AMechanical+Equipment+Installation%0ALarge+Bore+Pipe%0ASmall+Bore+Pipe%0AElectrical%0AInstrumentation%0ASoft+Crafts%0A', '', '', '', '', 1, '2017-04-06 12:49:05'),
(17, 1, 'Gate+6+%5BCommissing%2FHandover%5D+Phase+6+%2F+Phase+7', '', 'Turnover+%2F+Pre-Commissioning+Work%3A%0A-Final+Equipment+Alignment%0A-Hydrotest%0A-Re-instate+Pipe%0A-Simple+Loop+Checks%0A%0ACommissioning+Work%3A%0A-Livening+of+Utilities+Systems%0A-Chemical+Cleaning%0A-Compressors+run-in%0A-Turbines+run-in%2Fturbine-driven+equipment%0A-Dry-out+furnaces%0A-Water+circulation%0A-Loading+of+chemicals%2C+catalysts%2C+desiccants%2C+fix+beds%0A-Purging+with+Nitrogen+to+air-free%0A-Commissioning+of+UPS+systems+%5Bbatteries%5D%0A-Integrated+communication+between+DCS+%26+ESD%0A-Functional+testing+of+control+loops', '', '', '', '', 1, '2017-04-06 12:50:53'),
(18, 2, 'Project+Master+Schedule+%5BLevel+1%5D', '', 'The+EPC+Level+1+schedule+summarizes+the+overall+project+for+client+and+management.+EPC+Level+1+schedules+show+start+and+finish+dates+for+the+major+project+phases+and+key+milestones+%28such+as+design%2C+procurement%2C+construction%2C+and+commissioning+and+start%E2%80%90up%29.+Significant+contract+milestones+and+project%E2%80%90specific+milestones+or+activities+are+included+in+EPC+Level+1+schedules+as+required+by+the+project+execution+plan.', '', '', '', '', 1, '2017-04-06 13:27:19'),
(19, 2, 'Contract+Master+Schedule+%5BLevel+2%5D', '', 'EPC+Level+2+schedules+contain+more+detailed+activities+for+each+of+the+summary+phases+previously+identified+in+the+Level+1+schedule.+This+often+includes+a+breakout+of+the+various+trades+or+disciplines+responsible+for+the+activities+in+each+phase%2C+the+critical+procurement+activities%2C+the+major+elements+of+construction%2C+and+general+commissioning+and+start%E2%80%90up+requirements.+Generally+in+the+EPC+Level+2%2C+this+is+the+first+level+of+scheduled+detail+where+logical+links+or+task+relationships+may+be+shown.', '', '', '', '', 1, '2017-04-06 13:27:56'),
(20, 2, 'Contractor+Control+Schedule+%5BLevel+3%5D', '', 'EPC++Level++3++is++the++first++level++where++the++full++use++of++critical++path++method++%28CPM%29++techniques++could++be++shown+effectively.+In+addition+to+start+and+finish+dates+for+each+grouping+of+deliverables+or+activities+within+each+phase+of+the+project%2C+EPC+Level+3+schedules+include+major+review+and+approval+dates+as+well.++Most+EPC+schedule+models+are+not+developed+below+Level+3+in+terms+of+CPM+activity+detail%2C+with+the+intent+to+keep+the+schedule+broad+enough+to+be+described+for+any+specific+project.+%0AEPC+schedule+levels+are+normally+limited+to+Levels+1+through+3%2C+however+sometimes+an+%E2%80%9Cexternal%E2%80%9D+schedule+data+would+be+prepared+and+these+external+schedules+are+called+%E2%80%9CLevel+4.%E2%80%9D', '', '', '', '', 1, '2017-04-06 13:28:38'),
(21, 2, 'Contractors+Document+%26+Drawing+Schedule+%5BLevel+4%5D', '', 'EPC+Level+4+are+detailed+work+schedules+and+generally+would+be+prepared+outside+of+the+CPM+software%2C+with+correlation+to+the+CPM+schedule+activities+and+scope+of+work.+The+theory+is%2C+that+if+there+is+too+much+detail+within++the+CPM+network%2C+the+schedule+would+not+only+lose+its+flexibility+as+a+value%E2%80%90added+tool+to+manage+the+job%2C+but+schedule+maintenance+would+become+difficult%2C+due+to+the+greater+effort+needed+to+maintain+the+CPM+logic+after+each+progress+update.+A+variety+of+software+tools+can+be+employed+to+develop+work+schedules+at+Level+4+and+below%3A+spreadsheets%2C+databases%2C+and+word+processing+are+all+utilized.', '', '', '', '', 1, '2017-04-06 13:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projectwheelcategory`
--

CREATE TABLE IF NOT EXISTS `tbl_projectwheelcategory` (
  `wheelcategoryid` int(11) NOT NULL AUTO_INCREMENT,
  `wheeltype` varchar(150) DEFAULT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`wheelcategoryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_projectwheelcategory`
--

INSERT INTO `tbl_projectwheelcategory` (`wheelcategoryid`, `wheeltype`, `createddate`) VALUES
(1, 'Project+Wheel+Front', '2017-03-03 08:54:49'),
(2, 'Project+Wheel+Back', '2017-03-03 08:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_risk`
--

CREATE TABLE IF NOT EXISTS `tbl_risk` (
  `riskid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_language_id` int(11) NOT NULL,
  `risktitle` varchar(250) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `thumbimage` varchar(255) NOT NULL,
  `statuscheck` int(11) DEFAULT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`riskid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_risk`
--

INSERT INTO `tbl_risk` (`riskid`, `fk_language_id`, `risktitle`, `image`, `thumbimage`, `statuscheck`, `createdatetime`) VALUES
(1, 1, 'Risk+Summary1', 'risk1491793308.jpg', 'riskthumb1489066456.jpg', 1, '2017-03-09 13:34:16'),
(2, 1, 'Off-Shore', 'risk1489066708.jpg', 'riskthumb1489066708.jpg', 2, '2017-03-09 13:38:29'),
(3, 1, 'Subsea', 'risk1489066810.jpg', 'riskthumb1489066810.jpg', 2, '2017-03-09 13:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(100) NOT NULL,
  `permissionid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session`
--

CREATE TABLE IF NOT EXISTS `tbl_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(50) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `last_activity` int(11) NOT NULL,
  `user_data` text NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL COMMENT 'Email operated as mailing function for ADMIN',
  `websiteName` varchar(100) NOT NULL,
  `aws_accesskey` varchar(255) NOT NULL,
  `aws_secretkey` varchar(255) NOT NULL,
  `img_store_locate` int(2) NOT NULL COMMENT '0=server, 1=s3',
  `fax` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `mail_type` int(11) NOT NULL,
  `smtpport` int(11) NOT NULL,
  `smtphost` text NOT NULL,
  `smtpusername` varchar(255) NOT NULL,
  `smtppassword` varchar(255) NOT NULL,
  `copyright_text` varchar(255) NOT NULL,
  `facebook_url` varchar(255) NOT NULL,
  `twitter_url` varchar(255) NOT NULL,
  `googleplus_url` varchar(255) NOT NULL,
  `allow_free_chapter` int(11) NOT NULL,
  `chapter_payment` float(16,0) NOT NULL,
  `banner` longtext NOT NULL,
  `banner_text` longtext NOT NULL,
  `android_link` longtext NOT NULL,
  `iphone_link` longtext NOT NULL,
  `currency` varchar(50) NOT NULL,
  `Modify_Id` int(11) NOT NULL,
  `update_date` datetime NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`Id`, `email`, `websiteName`, `aws_accesskey`, `aws_secretkey`, `img_store_locate`, `fax`, `phone`, `mail_type`, `smtpport`, `smtphost`, `smtpusername`, `smtppassword`, `copyright_text`, `facebook_url`, `twitter_url`, `googleplus_url`, `allow_free_chapter`, `chapter_payment`, `banner`, `banner_text`, `android_link`, `iphone_link`, `currency`, `Modify_Id`, `update_date`, `ip_address`) VALUES
(1, 'vishal.dhamecha@vrinsofts.com', 'Advance planning analytics app', 'AKIAJ3QERXY2LQZVZNXQ', 'XWD4EJaKMV5zwNt6I6ZsW1TCnFWYiBXoclmOmcUS', 0, '123456789', '021-756-221', 1, 587, 'smtp.gmail.com', 'contato@ebmconsultoria.com', 'Vu&JP%9C', 'Copyright @ 2017 Advance planning analytics app', 'https://www.facebook.com/', 'https://www.twitter.com', 'http://www.instagram.com/', 2, 50, 'banner_1483711405.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'https://play.google.com/store?hl=en', 'https://itunes.apple.com/in/genre/ios/id36?mt=8', 'RS', 20, '2017-04-25 09:51:27', '180.211.105.202');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_template`
--

CREATE TABLE IF NOT EXISTS `tbl_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `templateparentid` int(11) NOT NULL,
  `fk_language_id` int(11) NOT NULL,
  `templatename` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tbl_template`
--

INSERT INTO `tbl_template` (`id`, `templateparentid`, `fk_language_id`, `templatename`, `description`, `status`, `createdby`, `createdatetime`, `updatedby`, `updatedatetime`) VALUES
(1, 0, 1, 'Email Template', 'Email Template Provide the Information About the Email subscription.																								', 1, 1, '2016-09-15 01:54:44', 1, '2016-09-29 02:06:50'),
(17, 0, 15, 'Se7ven Themeforest', 'Bootstrap 4.0&nbsp; Latest Template\n', 1, 1, '2016-09-29 06:00:13', 1, '2016-09-29 06:00:13'),
(18, 1, 2, 'Plantilla de correo electrÃ³nico', '&nbsp; Plantilla de correo electr&oacute;nico Proporcionar la informaci&oacute;n sobre la suscripci&oacute;n de correo electr&oacute;nico.\n', 1, 1, '2016-10-04 02:52:32', 1, '2016-10-04 02:52:38'),
(19, 1, 3, 'E-Mail-Vorlage', '\n&nbsp;\n\n\n\nE-Mail-Vorlage Geben Sie die Informationen &uuml;ber die E-Mail-Abonnement.\n', 1, 1, '2016-10-04 02:53:06', 1, '2016-10-04 02:53:06'),
(20, 17, 3, 'Se7ven Themeforest', '\n&nbsp;\n\n\n\nBootstrap 4.0 Neueste Vorlage\n', 1, 1, '2016-10-04 02:53:50', 1, '2016-10-04 02:53:50'),
(21, 17, 2, 'Se7ven ThemeForests', '\nBootstrap 4.0 plantilla m&aacute;s reciente\n', 1, 1, '2016-10-04 02:54:27', 1, '2016-10-04 02:54:27'),
(22, 0, 1, 'Email Template', 'Email Template Provide the Information About the Email subscription.																								', 1, 1, '2016-09-15 01:54:44', 1, '2016-09-29 02:06:50'),
(23, 0, 15, 'Se7ven Themeforest', 'Bootstrap 4.0&nbsp; Latest Template\n', 1, 1, '2016-09-29 06:00:13', 1, '2016-09-29 06:00:13'),
(24, 1, 2, 'Plantilla de correo electrÃ³nico', '&nbsp; Plantilla de correo electr&oacute;nico Proporcionar la informaci&oacute;n sobre la suscripci&oacute;n de correo electr&oacute;nico.\n', 1, 1, '2016-10-04 02:52:32', 1, '2016-10-04 02:52:38'),
(25, 1, 3, 'E-Mail-Vorlage', '\n&nbsp;\n\n\n\nE-Mail-Vorlage Geben Sie die Informationen &uuml;ber die E-Mail-Abonnement.\n', 1, 1, '2016-10-04 02:53:06', 1, '2016-10-04 02:53:06'),
(26, 17, 3, 'Se7ven Themeforest', '\n&nbsp;\n\n\n\nBootstrap 4.0 Neueste Vorlage\n', 1, 1, '2016-10-04 02:53:50', 1, '2016-10-04 02:53:50'),
(27, 17, 2, 'Se7ven ThemeForests', '\nBootstrap 4.0 plantilla m&aacute;s reciente\n', 1, 1, '2016-10-04 02:54:27', 1, '2016-10-04 02:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userassessment`
--

CREATE TABLE IF NOT EXISTS `tbl_userassessment` (
  `userassessmentid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_category_id` int(11) NOT NULL,
  `fk_assessmentsid` int(11) NOT NULL,
  `fk_userresultid` int(11) DEFAULT NULL,
  `useremail` varchar(255) DEFAULT NULL,
  `fk_userid` int(11) NOT NULL,
  `useranswer` int(11) DEFAULT NULL,
  `usertempid` varchar(125) DEFAULT NULL,
  `statuscheck` int(11) DEFAULT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userassessmentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=704 ;

--
-- Dumping data for table `tbl_userassessment`
--

INSERT INTO `tbl_userassessment` (`userassessmentid`, `fk_category_id`, `fk_assessmentsid`, `fk_userresultid`, `useremail`, `fk_userid`, `useranswer`, `usertempid`, `statuscheck`, `createddate`) VALUES
(10, 1, 32, 51, NULL, 141, 1, 'temp12345', 1, '2017-03-01 12:15:29'),
(11, 1, 1, NULL, NULL, 141, 1, 'temp123', 1, '2017-03-02 04:36:50'),
(12, 1, 32, 52, NULL, 149, 2, 'temp836355713', 1, '2017-03-02 05:15:43'),
(13, 1, 33, 52, NULL, 149, 2, 'temp836355713', 1, '2017-03-02 05:15:57'),
(14, 1, 35, 52, NULL, 149, 2, 'temp836355713', 1, '2017-03-02 05:16:07'),
(15, 4, 2, NULL, NULL, 9, 1, 'temp591061040', 1, '2017-03-14 12:26:37'),
(16, 4, 2, NULL, NULL, 10, 3, 'temp1266000982', 1, '2017-03-14 12:38:07'),
(17, 4, 1, NULL, NULL, 10, 4, 'temp214407898', 1, '2017-03-14 12:41:18'),
(18, 4, 1, NULL, NULL, 10, 4, 'temp102972238', 1, '2017-03-14 12:42:13'),
(19, 4, 1, NULL, NULL, 10, 4, 'temp1054781698', 1, '2017-03-14 12:46:35'),
(20, 4, 1, NULL, NULL, 10, 4, 'temp326856023', 1, '2017-03-14 12:50:51'),
(21, 4, 2, NULL, NULL, 10, 4, 'temp250548925', 1, '2017-03-14 12:55:52'),
(22, 4, 1, NULL, NULL, 10, 1, 'temp1244117513', 1, '2017-03-14 12:59:22'),
(23, 4, 2, NULL, NULL, 10, 3, 'temp404346450', 1, '2017-03-14 13:01:39'),
(24, 4, 1, NULL, NULL, 10, 4, 'temp2002151132', 1, '2017-03-14 13:03:58'),
(25, 4, 1, NULL, NULL, 10, 4, 'temp647335497', 1, '2017-03-14 13:18:38'),
(26, 4, 1, NULL, NULL, 10, 4, 'temp1953564666', 1, '2017-03-14 13:19:24'),
(27, 4, 1, NULL, NULL, 10, 3, 'temp1370172534', 1, '2017-03-14 13:34:48'),
(28, 4, 1, NULL, NULL, 10, 3, 'temp774956552', 1, '2017-03-14 13:37:30'),
(29, 4, 1, NULL, NULL, 10, 4, 'temp1020249861', 1, '2017-03-14 13:47:23'),
(30, 4, 2, NULL, NULL, 10, 3, 'temp1020249861', 1, '2017-03-14 13:47:44'),
(31, 4, 1, NULL, NULL, 10, 3, 'temp1443486114', 1, '2017-03-14 13:53:14'),
(32, 4, 1, NULL, NULL, 10, 4, 'temp1512167450', 1, '2017-03-14 13:55:06'),
(33, 4, 2, NULL, NULL, 10, 1, 'temp1512167450', 1, '2017-03-14 13:55:24'),
(34, 3, 5, NULL, NULL, 10, 3, 'temp1736395295', 1, '2017-03-14 13:57:56'),
(35, 4, 1, NULL, NULL, 10, 4, 'temp503020066', 1, '2017-03-14 13:59:27'),
(36, 4, 1, NULL, NULL, 10, 4, 'temp1616189084', 1, '2017-03-14 14:01:46'),
(37, 4, 2, NULL, NULL, 10, 2, 'temp1616189084', 1, '2017-03-14 14:02:02'),
(38, 4, 1, 1, NULL, 10, 4, 'temp781577788', 1, '2017-03-14 14:04:50'),
(39, 4, 2, 1, NULL, 10, 4, 'temp781577788', 1, '2017-03-14 14:05:25'),
(40, 4, 1, NULL, NULL, 10, 4, 'temp478272646', 1, '2017-03-14 14:08:52'),
(41, 4, 2, NULL, NULL, 10, 3, 'temp478272646', 1, '2017-03-14 14:09:42'),
(42, 4, 1, NULL, NULL, 10, 2, 'temp1732134814', 1, '2017-03-14 14:15:04'),
(43, 4, 1, NULL, NULL, 10, 2, 'temp1158673491', 1, '2017-03-14 14:16:44'),
(44, 4, 1, NULL, NULL, 10, 4, 'temp309443904', 1, '2017-03-14 14:17:43'),
(45, 4, 2, NULL, NULL, 10, 3, 'temp309443904', 1, '2017-03-14 14:17:53'),
(46, 4, 1, NULL, NULL, 10, 2, 'temp1777850906', 1, '2017-03-14 14:18:26'),
(47, 4, 2, NULL, NULL, 10, 1, 'temp1777850906', 1, '2017-03-14 14:18:39'),
(48, 3, 5, NULL, NULL, 10, 1, 'temp243376826', 1, '2017-03-14 14:20:27'),
(49, 1, 3, NULL, NULL, 10, 1, 'temp2041897144', 1, '2017-03-15 05:07:58'),
(50, 2, 4, NULL, NULL, 11, 4, 'temp782161516', 1, '2017-03-15 10:24:51'),
(51, 4, 1, NULL, NULL, 11, 3, 'temp279701870', 1, '2017-03-15 10:25:18'),
(52, 4, 1, 2, NULL, 12, 1, 'temp678296582', 1, '2017-03-15 11:12:17'),
(53, 4, 2, 2, NULL, 12, 4, 'temp678296582', 1, '2017-03-15 11:12:28'),
(54, 4, 1, 3, NULL, 12, 1, 'temp1125140383', 1, '2017-03-15 11:31:58'),
(55, 4, 2, 3, NULL, 12, 2, 'temp1125140383', 1, '2017-03-15 11:32:01'),
(56, 4, 1, 4, NULL, 12, 1, 'temp2067138999', 1, '2017-03-15 11:32:28'),
(57, 4, 2, 4, NULL, 12, 1, 'temp2067138999', 1, '2017-03-15 11:32:31'),
(58, 4, 1, 5, NULL, 12, 3, 'temp1957690245', 1, '2017-03-15 11:34:10'),
(59, 4, 2, 5, NULL, 12, 1, 'temp1957690245', 1, '2017-03-15 11:34:14'),
(60, 4, 1, 6, NULL, 12, 1, 'temp117921266', 1, '2017-03-15 11:38:26'),
(61, 4, 2, 6, NULL, 12, 4, 'temp117921266', 1, '2017-03-15 11:38:29'),
(62, 4, 1, 7, NULL, 12, 2, 'temp853524444', 1, '2017-03-15 11:39:17'),
(63, 4, 2, 7, NULL, 12, 3, 'temp853524444', 1, '2017-03-15 11:39:22'),
(64, 4, 1, 8, NULL, 12, 1, 'temp576796487', 1, '2017-03-15 11:40:58'),
(65, 4, 1, 9, NULL, 12, 1, 'temp43279727', 1, '2017-03-15 11:42:27'),
(66, 4, 2, 9, NULL, 12, 1, 'temp43279727', 1, '2017-03-15 11:42:32'),
(67, 4, 1, 10, NULL, 12, 4, 'temp1817311922', 1, '2017-03-15 11:49:05'),
(68, 4, 2, 10, NULL, 12, 1, 'temp1817311922', 1, '2017-03-15 11:49:09'),
(69, 4, 1, 11, NULL, 12, 1, 'temp1205463736', 1, '2017-03-16 04:31:54'),
(70, 4, 2, 11, NULL, 12, 4, 'temp1205463736', 1, '2017-03-16 04:31:59'),
(71, 4, 1, 12, NULL, 15, 4, 'temp592054724', 1, '2017-03-16 07:01:14'),
(72, 4, 2, 12, NULL, 15, 4, 'temp592054724', 1, '2017-03-16 07:01:25'),
(73, 4, 1, NULL, NULL, 25, 1, 'temp1143013969', 1, '2017-03-21 14:56:56'),
(74, 1, 3, NULL, NULL, 26, 0, 'temp123', 1, '2017-03-22 05:10:29'),
(75, 1, 3, 13, NULL, 14, 1, 'temp355691422', 1, '2017-03-22 12:19:55'),
(76, 1, 3, NULL, NULL, 38, 0, '38', 1, '2017-03-22 12:37:57'),
(77, 1, 3, 14, NULL, 39, 0, '39', 1, '2017-03-22 13:06:00'),
(78, 1, 3, 15, NULL, 50, 0, '50', 1, '2017-03-27 04:43:35'),
(79, 1, 3, 16, NULL, 51, 0, '51', 1, '2017-03-27 09:25:35'),
(80, 1, 3, 17, NULL, 52, 0, '52', 1, '2017-03-27 09:33:10'),
(81, 1, 3, 18, NULL, 42, 1, 'temp999502879', 1, '2017-03-27 10:03:25'),
(82, 1, 3, 19, NULL, 42, 3, 'temp332512420', 1, '2017-03-27 10:03:40'),
(83, 1, 3, 20, NULL, 42, 1, 'temp83491070', 1, '2017-03-27 10:04:00'),
(84, 1, 3, 21, NULL, 53, 0, '53', 1, '2017-03-27 10:50:12'),
(85, 1, 3, 22, NULL, 54, 0, '54', 1, '2017-03-27 11:04:40'),
(86, 2, 4, 23, NULL, 38, 0, '38', 1, '2017-03-27 11:37:30'),
(87, 3, 5, NULL, NULL, 38, 0, '38', 1, '2017-03-27 11:38:48'),
(88, 4, 1, NULL, NULL, 38, 0, '38', 1, '2017-03-27 11:41:01'),
(89, 4, 2, NULL, NULL, 38, 0, '38', 1, '2017-03-27 11:41:04'),
(90, 1, 3, 24, NULL, 38, 0, 'temp1181761870', 1, '2017-03-27 12:01:00'),
(91, 4, 1, 25, NULL, 38, 0, 'temp1103960533', 1, '2017-03-27 12:02:23'),
(92, 4, 2, 25, NULL, 38, 0, 'temp1103960533', 1, '2017-03-27 12:02:32'),
(93, 1, 3, 26, NULL, 56, 0, 'temp829303593', 1, '2017-03-27 12:05:19'),
(94, 1, 3, 27, NULL, 56, 1, 'temp1172708957', 1, '2017-03-27 12:08:13'),
(95, 4, 1, 28, NULL, 56, 2, 'temp1796082033', 1, '2017-03-27 12:08:37'),
(96, 4, 2, 28, NULL, 56, 3, 'temp1796082033', 1, '2017-03-27 12:08:39'),
(97, 1, 3, 29, NULL, 56, 2, 'temp337802457', 1, '2017-03-27 12:14:08'),
(98, 1, 3, 30, NULL, 57, 1, 'temp1238653338', 1, '2017-03-27 12:27:26'),
(99, 2, 4, 31, NULL, 57, 2, 'temp1633111146', 1, '2017-03-27 12:27:31'),
(100, 4, 1, 32, NULL, 57, 2, 'temp289971421', 1, '2017-03-27 12:27:38'),
(101, 4, 2, 32, NULL, 57, 4, 'temp289971421', 1, '2017-03-27 12:27:42'),
(102, 3, 5, 33, NULL, 57, 1, 'temp1355823091', 1, '2017-03-27 12:27:48'),
(103, 1, 3, 34, NULL, 58, 4, 'temp1028996887', 1, '2017-03-28 11:03:08'),
(104, 1, 3, 35, NULL, 66, 1, 'temp435230505', 1, '2017-03-30 10:30:53'),
(105, 1, 3, 36, NULL, 66, 1, 'temp902364438', 1, '2017-03-30 10:33:11'),
(106, 3, 5, 37, NULL, 69, 1, 'temp1251627982', 1, '2017-03-30 14:00:01'),
(107, 3, 5, 38, NULL, 69, 1, 'temp1233246251', 1, '2017-03-31 06:17:18'),
(108, 1, 3, 39, NULL, 69, 2, 'temp1934952242', 1, '2017-03-31 06:17:27'),
(109, 1, 3, 40, NULL, 69, 3, 'temp480115729', 1, '2017-03-31 06:17:34'),
(110, 3, 5, 41, NULL, 69, 3, 'temp753419062', 1, '2017-03-31 06:17:40'),
(111, 1, 3, 42, NULL, 70, 1, 'temp606894675', 1, '2017-04-03 05:33:32'),
(112, 3, 5, 43, NULL, 77, 1, 'temp1922048309', 1, '2017-04-04 11:33:49'),
(113, 4, 1, 44, NULL, 70, 1, 'temp900690410', 1, '2017-04-05 04:32:48'),
(114, 4, 2, 44, NULL, 70, 1, 'temp900690410', 1, '2017-04-05 04:32:52'),
(115, 1, 3, 45, NULL, 70, 1, 'temp80778889', 1, '2017-04-05 05:40:17'),
(116, 1, 3, 46, NULL, 70, 1, 'temp289913091', 1, '2017-04-05 05:51:54'),
(117, 1, 3, 47, NULL, 70, 1, 'temp1431387384', 1, '2017-04-05 05:54:10'),
(118, 2, 4, 48, NULL, 70, 2, 'temp1321220073', 1, '2017-04-05 05:54:37'),
(119, 1, 3, 49, NULL, 70, 2, 'temp270110061', 1, '2017-04-05 06:08:07'),
(120, 3, 5, 50, NULL, 70, 3, 'temp1587690699', 1, '2017-04-05 06:08:31'),
(121, 1, 3, 51, NULL, 70, 2, 'temp91718560', 1, '2017-04-05 06:10:10'),
(122, 1, 3, 52, NULL, 70, 2, 'temp2097891432', 1, '2017-04-05 06:19:30'),
(123, 3, 5, 53, NULL, 70, 2, 'temp9346660', 1, '2017-04-05 06:23:33'),
(124, 1, 3, 54, NULL, 70, 2, 'temp2090616598', 1, '2017-04-05 06:24:59'),
(125, 1, 3, 55, NULL, 70, 2, 'temp1068490598', 1, '2017-04-05 06:28:52'),
(126, 1, 3, 56, NULL, 70, 2, 'temp152077460', 1, '2017-04-05 06:32:55'),
(127, 1, 3, 57, NULL, 70, 2, 'temp1285001904', 1, '2017-04-05 06:34:05'),
(128, 2, 4, 58, NULL, 70, 2, 'temp1458817976', 1, '2017-04-05 06:53:13'),
(129, 2, 4, 59, NULL, 70, 2, 'temp1470382159', 1, '2017-04-05 06:57:38'),
(130, 1, 3, 60, NULL, 70, 2, 'temp54098383', 1, '2017-04-05 07:08:35'),
(131, 4, 1, 61, NULL, 70, 3, 'temp1765895207', 1, '2017-04-05 07:15:33'),
(132, 4, 2, 61, NULL, 70, 3, 'temp1765895207', 1, '2017-04-05 07:15:35'),
(133, 4, 1, 62, NULL, 70, 1, 'temp1569866120', 1, '2017-04-05 07:19:51'),
(134, 4, 2, 62, NULL, 70, 3, 'temp1569866120', 1, '2017-04-05 07:19:54'),
(135, 4, 1, 63, NULL, 70, 3, 'temp1325068294', 1, '2017-04-05 07:22:19'),
(136, 4, 2, 63, NULL, 70, 3, 'temp1325068294', 1, '2017-04-05 07:22:21'),
(137, 4, 1, 64, NULL, 70, 3, 'temp7355714', 1, '2017-04-05 07:23:49'),
(138, 4, 2, 64, NULL, 70, 3, 'temp7355714', 1, '2017-04-05 07:23:51'),
(139, 4, 1, 65, NULL, 70, 1, 'temp489379050', 1, '2017-04-05 07:28:44'),
(140, 4, 2, 65, NULL, 70, 3, 'temp489379050', 1, '2017-04-05 07:28:48'),
(141, 4, 1, NULL, NULL, 70, 2, 'temp1819379858', 1, '2017-04-05 07:29:51'),
(142, 4, 2, NULL, NULL, 70, 2, 'temp1819379858', 1, '2017-04-05 07:29:54'),
(143, 4, 1, 66, NULL, 70, 2, 'temp2083451652', 1, '2017-04-05 07:30:08'),
(144, 4, 2, 66, NULL, 70, 2, 'temp2083451652', 1, '2017-04-05 07:30:16'),
(145, 4, 1, NULL, NULL, 70, 1, 'temp1201128745', 1, '2017-04-05 07:32:51'),
(146, 4, 2, NULL, NULL, 70, 2, 'temp1201128745', 1, '2017-04-05 07:33:13'),
(147, 4, 1, 67, NULL, 70, 1, 'temp2040388311', 1, '2017-04-05 08:17:17'),
(148, 4, 2, 67, NULL, 70, 1, 'temp2040388311', 1, '2017-04-05 08:17:20'),
(149, 4, 1, 68, NULL, 70, 1, 'temp2139606380', 1, '2017-04-05 08:17:30'),
(150, 4, 2, 68, NULL, 70, 1, 'temp2139606380', 1, '2017-04-05 08:17:32'),
(151, 4, 1, 69, NULL, 70, 1, 'temp841119580', 1, '2017-04-05 08:18:06'),
(152, 4, 2, 69, NULL, 70, 1, 'temp841119580', 1, '2017-04-05 08:18:08'),
(153, 4, 1, 70, NULL, 70, 2, 'temp2036249396', 1, '2017-04-05 08:24:27'),
(154, 4, 2, 70, NULL, 70, 2, 'temp2036249396', 1, '2017-04-05 08:24:29'),
(155, 4, 1, 71, NULL, 70, 2, 'temp412639072', 1, '2017-04-05 08:25:52'),
(156, 4, 2, 71, NULL, 70, 2, 'temp412639072', 1, '2017-04-05 08:25:54'),
(157, 4, 1, 72, NULL, 70, 1, 'temp699516137', 1, '2017-04-05 08:46:27'),
(158, 4, 2, 72, NULL, 70, 1, 'temp699516137', 1, '2017-04-05 08:46:29'),
(159, 4, 1, 73, NULL, 79, 1, 'temp1751609617', 1, '2017-04-05 09:19:27'),
(160, 4, 2, 73, NULL, 79, 1, 'temp1751609617', 1, '2017-04-05 09:19:30'),
(161, 4, 1, 74, NULL, 70, 1, 'temp1663735788', 1, '2017-04-05 09:24:59'),
(162, 4, 2, 74, NULL, 70, 1, 'temp1663735788', 1, '2017-04-05 09:25:02'),
(163, 4, 1, 75, NULL, 80, 1, 'temp932114706', 1, '2017-04-05 09:34:59'),
(164, 4, 2, 75, NULL, 80, 1, 'temp932114706', 1, '2017-04-05 09:35:01'),
(165, 3, 5, 76, NULL, 81, 1, 'temp1455475195', 1, '2017-04-05 17:33:26'),
(166, 3, 5, 77, NULL, 70, 1, 'temp1165038699', 1, '2017-04-07 06:49:50'),
(167, 4, 1, 78, NULL, 70, 1, 'temp147664911', 1, '2017-04-07 07:01:41'),
(168, 4, 2, 78, NULL, 70, 1, 'temp147664911', 1, '2017-04-07 07:01:43'),
(169, 3, 5, 79, NULL, 70, 1, 'temp1155784914', 1, '2017-04-07 07:01:55'),
(170, 3, 5, 80, NULL, 70, 1, 'temp1657091699', 1, '2017-04-07 07:06:33'),
(171, 1, 3, 81, NULL, 91, 1, 'temp269728645', 1, '2017-04-09 16:06:42'),
(172, 3, 5, 82, NULL, 91, 1, 'temp712053363', 1, '2017-04-09 18:08:12'),
(173, 3, 5, 83, NULL, 92, 1, 'temp1139987029', 1, '2017-04-09 18:12:31'),
(174, 3, 6, 83, NULL, 92, 1, 'temp1139987029', 1, '2017-04-09 18:13:07'),
(175, 3, 5, NULL, NULL, 92, 1, 'temp2006470393', 1, '2017-04-09 18:13:33'),
(176, 3, 5, 84, NULL, 92, 1, 'temp1294716251', 1, '2017-04-09 18:23:47'),
(177, 3, 6, 84, NULL, 92, 1, 'temp1294716251', 1, '2017-04-09 19:14:12'),
(178, 3, 7, 84, NULL, 92, 1, 'temp1294716251', 1, '2017-04-09 19:14:16'),
(179, 3, 8, 84, NULL, 92, 1, 'temp1294716251', 1, '2017-04-09 19:14:20'),
(180, 3, 9, 84, NULL, 92, 1, 'temp1294716251', 1, '2017-04-09 19:14:23'),
(181, 3, 10, 84, NULL, 92, 1, 'temp1294716251', 1, '2017-04-09 19:14:27'),
(182, 3, 11, 84, NULL, 92, 1, 'temp1294716251', 1, '2017-04-09 19:14:31'),
(183, 3, 5, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:14:50'),
(184, 3, 6, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:14:52'),
(185, 3, 7, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:14:56'),
(186, 3, 8, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:14:59'),
(187, 3, 9, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:02'),
(188, 3, 10, 85, NULL, 92, 4, 'temp668820076', 1, '2017-04-09 19:15:05'),
(189, 3, 11, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:07'),
(190, 3, 12, 85, NULL, 92, 2, 'temp668820076', 1, '2017-04-09 19:15:12'),
(191, 3, 13, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:15'),
(192, 3, 14, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:19'),
(193, 3, 15, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:21'),
(194, 3, 16, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:25'),
(195, 3, 17, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:29'),
(196, 3, 18, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:31'),
(197, 3, 19, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:36'),
(198, 3, 20, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:39'),
(199, 3, 21, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:41'),
(200, 3, 22, 85, NULL, 92, 2, 'temp668820076', 1, '2017-04-09 19:15:45'),
(201, 3, 23, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:48'),
(202, 3, 24, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:52'),
(203, 3, 25, 85, NULL, 92, 3, 'temp668820076', 1, '2017-04-09 19:15:55'),
(204, 1, 3, 86, NULL, 92, 1, 'temp1119141737', 1, '2017-04-09 19:20:42'),
(205, 4, 1, NULL, NULL, 92, 1, 'temp1819309941', 1, '2017-04-09 20:13:50'),
(206, 4, 2, NULL, NULL, 92, 1, 'temp1819309941', 1, '2017-04-09 20:14:33'),
(207, 4, 36, NULL, NULL, 92, 1, 'temp1819309941', 1, '2017-04-09 20:14:51'),
(208, 4, 37, NULL, NULL, 92, 1, 'temp1819309941', 1, '2017-04-09 20:15:02'),
(209, 4, 1, NULL, NULL, 92, 1, 'temp1710133178', 1, '2017-04-09 20:15:18'),
(210, 1, 3, 87, NULL, 92, 1, 'temp716454768', 1, '2017-04-09 20:36:55'),
(211, 1, 46, 87, NULL, 92, 2, 'temp716454768', 1, '2017-04-09 20:37:11'),
(212, 1, 3, 88, NULL, 92, 1, 'temp1080597898', 1, '2017-04-09 20:37:26'),
(213, 1, 46, 88, NULL, 92, 1, 'temp1080597898', 1, '2017-04-09 20:37:29'),
(214, 1, 3, NULL, NULL, 92, 1, 'temp784646539', 1, '2017-04-09 20:37:40'),
(215, 4, 1, NULL, NULL, 92, 1, 'temp790874402', 1, '2017-04-09 20:37:57'),
(216, 4, 2, NULL, NULL, 92, 1, 'temp790874402', 1, '2017-04-09 20:38:32'),
(217, 4, 36, NULL, NULL, 92, 1, 'temp790874402', 1, '2017-04-09 20:38:37'),
(218, 4, 37, NULL, NULL, 92, 1, 'temp790874402', 1, '2017-04-09 20:38:40'),
(219, 4, 38, NULL, NULL, 92, 1, 'temp790874402', 1, '2017-04-09 20:38:42'),
(220, 4, 39, NULL, NULL, 92, 1, 'temp790874402', 1, '2017-04-09 20:38:57'),
(221, 4, 40, NULL, NULL, 92, 1, 'temp790874402', 1, '2017-04-09 20:39:01'),
(222, 4, 41, NULL, NULL, 92, 1, 'temp790874402', 1, '2017-04-09 20:39:04'),
(223, 4, 1, 89, NULL, 92, 1, 'temp1779674418', 1, '2017-04-09 20:49:00'),
(224, 4, 2, 89, NULL, 92, 1, 'temp1779674418', 1, '2017-04-09 20:49:03'),
(225, 4, 36, 89, NULL, 92, 1, 'temp1779674418', 1, '2017-04-09 20:49:06'),
(226, 4, 37, 89, NULL, 92, 1, 'temp1779674418', 1, '2017-04-09 20:49:09'),
(227, 4, 38, 89, NULL, 92, 1, 'temp1779674418', 1, '2017-04-09 20:49:11'),
(228, 4, 39, 89, NULL, 92, 1, 'temp1779674418', 1, '2017-04-09 20:49:13'),
(229, 4, 40, 89, NULL, 92, 2, 'temp1779674418', 1, '2017-04-09 20:49:25'),
(230, 4, 41, 89, NULL, 92, 1, 'temp1779674418', 1, '2017-04-09 20:49:34'),
(231, 4, 42, 89, NULL, 92, 1, 'temp1779674418', 1, '2017-04-09 20:49:37'),
(232, 4, 43, 89, NULL, 92, 1, 'temp1779674418', 1, '2017-04-09 20:49:47'),
(233, 4, 44, 89, NULL, 92, 1, 'temp1779674418', 1, '2017-04-09 20:49:58'),
(234, 4, 45, 89, NULL, 92, 1, 'temp1779674418', 1, '2017-04-09 20:50:07'),
(235, 1, 3, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:01:25'),
(236, 1, 46, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:01:33'),
(237, 1, 47, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:01:41'),
(238, 1, 48, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:01:46'),
(239, 1, 49, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:01:51'),
(240, 1, 50, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:01:53'),
(241, 1, 51, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:01:57'),
(242, 1, 52, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:02:01'),
(243, 1, 53, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:02:06'),
(244, 1, 54, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:02:08'),
(245, 1, 55, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:02:14'),
(246, 1, 56, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:02:18'),
(247, 1, 57, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:02:21'),
(248, 1, 58, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:02:26'),
(249, 1, 59, 90, NULL, 92, 1, 'temp1800722090', 1, '2017-04-09 21:02:37'),
(250, 1, 3, NULL, NULL, 92, 1, 'temp227814350', 1, '2017-04-09 21:02:50'),
(251, 1, 46, NULL, NULL, 92, 1, 'temp227814350', 1, '2017-04-09 21:02:58'),
(252, 1, 3, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:16:51'),
(253, 1, 46, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:16:54'),
(254, 1, 47, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:16:59'),
(255, 1, 48, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:04'),
(256, 1, 49, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:06'),
(257, 1, 50, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:08'),
(258, 1, 51, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:10'),
(259, 1, 52, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:12'),
(260, 1, 53, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:15'),
(261, 1, 54, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:18'),
(262, 1, 55, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:21'),
(263, 1, 56, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:24'),
(264, 1, 57, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:26'),
(265, 1, 58, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:28'),
(266, 1, 59, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:34'),
(267, 1, 60, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:40'),
(268, 1, 61, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:42'),
(269, 1, 62, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:46'),
(270, 1, 63, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:49'),
(271, 1, 64, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:17:57'),
(272, 1, 65, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:18:00'),
(273, 1, 66, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:18:07'),
(274, 1, 67, 91, NULL, 92, 1, 'temp1867976205', 1, '2017-04-09 21:18:11'),
(275, 1, 3, NULL, NULL, 92, 1, 'temp1094814928', 1, '2017-04-10 03:02:18'),
(276, 1, 3, 92, NULL, 89, 1, 'temp1300906911', 1, '2017-04-10 10:21:15'),
(277, 1, 46, 92, NULL, 89, 1, 'temp1300906911', 1, '2017-04-10 10:21:19'),
(278, 1, 47, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:21:21'),
(279, 1, 48, 92, NULL, 89, 3, 'temp1300906911', 1, '2017-04-10 10:21:23'),
(280, 1, 49, 92, NULL, 89, 3, 'temp1300906911', 1, '2017-04-10 10:21:25'),
(281, 1, 50, 92, NULL, 89, 3, 'temp1300906911', 1, '2017-04-10 10:21:27'),
(282, 1, 51, 92, NULL, 89, 3, 'temp1300906911', 1, '2017-04-10 10:21:30'),
(283, 1, 52, 92, NULL, 89, 3, 'temp1300906911', 1, '2017-04-10 10:21:32'),
(284, 1, 53, 92, NULL, 89, 1, 'temp1300906911', 1, '2017-04-10 10:21:36'),
(285, 1, 54, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:21:40'),
(286, 1, 55, 92, NULL, 89, 1, 'temp1300906911', 1, '2017-04-10 10:21:42'),
(287, 1, 56, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:21:43'),
(288, 1, 57, 92, NULL, 89, 1, 'temp1300906911', 1, '2017-04-10 10:21:45'),
(289, 1, 58, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:21:47'),
(290, 1, 59, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:21:49'),
(291, 1, 60, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:21:51'),
(292, 1, 61, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:21:53'),
(293, 1, 62, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:21:55'),
(294, 1, 63, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:21:57'),
(295, 1, 64, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:21:59'),
(296, 1, 65, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:22:02'),
(297, 1, 66, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:22:05'),
(298, 1, 67, 92, NULL, 89, 2, 'temp1300906911', 1, '2017-04-10 10:24:18'),
(299, 1, 3, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:07'),
(300, 1, 46, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:09'),
(301, 1, 47, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:12'),
(302, 1, 48, 93, NULL, 89, 2, 'temp1730984385', 1, '2017-04-10 10:48:13'),
(303, 1, 49, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:15'),
(304, 1, 50, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:17'),
(305, 1, 51, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:18'),
(306, 1, 52, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:20'),
(307, 1, 53, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:22'),
(308, 1, 54, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:23'),
(309, 1, 55, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:25'),
(310, 1, 56, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:26'),
(311, 1, 57, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:28'),
(312, 1, 58, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:30'),
(313, 1, 59, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:31'),
(314, 1, 60, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:33'),
(315, 1, 61, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:36'),
(316, 1, 62, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:38'),
(317, 1, 63, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:40'),
(318, 1, 64, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:42'),
(319, 1, 65, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:44'),
(320, 1, 66, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:48'),
(321, 1, 67, 93, NULL, 89, 1, 'temp1730984385', 1, '2017-04-10 10:48:52'),
(322, 1, 3, NULL, NULL, 92, 1, 'temp241722013', 1, '2017-04-11 01:17:22'),
(323, 1, 46, NULL, NULL, 92, 1, 'temp241722013', 1, '2017-04-11 01:17:28'),
(324, 1, 47, NULL, NULL, 92, 1, 'temp241722013', 1, '2017-04-11 01:17:31'),
(325, 4, 1, NULL, NULL, 89, 2, 'temp98251645', 1, '2017-04-11 05:13:04'),
(326, 4, 1, NULL, NULL, 70, 2, 'temp1098567157', 1, '2017-04-11 06:00:47'),
(327, 1, 3, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:40'),
(328, 1, 46, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:42'),
(329, 1, 47, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:43'),
(330, 1, 48, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:44'),
(331, 1, 49, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:45'),
(332, 1, 50, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:46'),
(333, 1, 51, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:47'),
(334, 1, 52, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:48'),
(335, 1, 53, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:49'),
(336, 1, 54, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:50'),
(337, 1, 55, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:51'),
(338, 1, 56, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:54'),
(339, 1, 57, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:57'),
(340, 1, 58, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:58'),
(341, 1, 59, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:24:59'),
(342, 1, 60, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:25:00'),
(343, 1, 61, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:25:01'),
(344, 1, 62, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:25:02'),
(345, 1, 63, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:25:03'),
(346, 1, 64, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:25:04'),
(347, 1, 65, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:25:05'),
(348, 1, 66, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:25:06'),
(349, 1, 67, 94, NULL, 68, 1, 'temp1591298743', 1, '2017-04-11 06:25:07'),
(350, 1, 3, NULL, NULL, 70, 1, 'temp1660490998', 1, '2017-04-11 07:00:30'),
(351, 4, 1, NULL, NULL, 70, 2, 'temp877217673', 1, '2017-04-11 07:15:06'),
(352, 4, 1, NULL, NULL, 89, 1, 'temp573800595', 1, '2017-04-11 08:37:46'),
(353, 4, 2, NULL, NULL, 89, 2, 'temp573800595', 1, '2017-04-11 08:37:51'),
(354, 2, 4, NULL, NULL, 89, 2, 'temp954984880', 1, '2017-04-11 08:38:15'),
(355, 2, 26, NULL, NULL, 89, 1, 'temp954984880', 1, '2017-04-11 08:38:21'),
(356, 2, 27, NULL, NULL, 89, 1, 'temp954984880', 1, '2017-04-11 08:38:25'),
(357, 1, 1, NULL, NULL, 14, 1, 'temp123', 1, '2017-04-11 09:32:30'),
(358, 4, 1, NULL, NULL, 89, 2, 'temp1473520339', 1, '2017-04-11 10:03:13'),
(359, 3, 5, NULL, NULL, 3, 3, 'temp1028700440', 1, '2017-04-11 13:32:53'),
(360, 3, 6, NULL, NULL, 3, 1, 'temp1028700440', 1, '2017-04-11 13:32:59'),
(361, 1, 3, NULL, NULL, 3, 1, 'temp1898385764', 1, '2017-04-11 13:35:12'),
(362, 2, 4, NULL, NULL, 3, 1, 'temp125149417', 1, '2017-04-11 13:42:34'),
(363, 2, 26, NULL, NULL, 3, 1, 'temp125149417', 1, '2017-04-11 13:42:37'),
(364, 2, 27, NULL, NULL, 3, 1, 'temp125149417', 1, '2017-04-11 13:42:39'),
(365, 2, 28, NULL, NULL, 3, 1, 'temp125149417', 1, '2017-04-11 13:42:41'),
(366, 2, 29, NULL, NULL, 3, 1, 'temp125149417', 1, '2017-04-11 13:42:43'),
(367, 4, 1, NULL, NULL, 3, 1, 'temp1779711058', 1, '2017-04-11 13:42:56'),
(368, 4, 2, NULL, NULL, 3, 1, 'temp1779711058', 1, '2017-04-11 13:42:57'),
(369, 4, 36, NULL, NULL, 3, 1, 'temp1779711058', 1, '2017-04-11 13:42:58'),
(370, 3, 5, NULL, NULL, 3, 1, 'temp1836492308', 1, '2017-04-11 13:43:21'),
(371, 3, 6, NULL, NULL, 3, 1, 'temp1836492308', 1, '2017-04-11 13:43:24'),
(372, 3, 7, NULL, NULL, 3, 1, 'temp1836492308', 1, '2017-04-11 13:43:27'),
(373, 3, 8, NULL, NULL, 3, 1, 'temp1836492308', 1, '2017-04-11 13:43:29'),
(374, 3, 9, NULL, NULL, 3, 1, 'temp1836492308', 1, '2017-04-11 13:43:32'),
(375, 3, 10, NULL, NULL, 3, 1, 'temp1836492308', 1, '2017-04-11 13:43:33'),
(376, 3, 11, NULL, NULL, 3, 1, 'temp1836492308', 1, '2017-04-11 13:43:35'),
(377, 1, 3, NULL, NULL, 1, 1, 'temp388807538', 1, '2017-04-12 01:12:13'),
(378, 1, 46, NULL, NULL, 1, 1, 'temp388807538', 1, '2017-04-12 01:12:19'),
(379, 1, 47, NULL, NULL, 1, 1, 'temp388807538', 1, '2017-04-12 01:12:37'),
(380, 1, 48, NULL, NULL, 1, 1, 'temp388807538', 1, '2017-04-12 01:12:55'),
(381, 3, 5, NULL, NULL, 1, 1, 'temp888439906', 1, '2017-04-12 01:13:06'),
(382, 4, 1, NULL, NULL, 1, 1, 'temp1160521276', 1, '2017-04-12 01:13:20'),
(383, 4, 2, NULL, NULL, 1, 1, 'temp1160521276', 1, '2017-04-12 01:13:39'),
(384, 4, 36, NULL, NULL, 1, 1, 'temp1160521276', 1, '2017-04-12 01:13:51'),
(385, 4, 37, NULL, NULL, 1, 1, 'temp1160521276', 1, '2017-04-12 01:14:10'),
(386, 4, 38, NULL, NULL, 1, 1, 'temp1160521276', 1, '2017-04-12 01:14:16'),
(387, 4, 1, NULL, NULL, 1, 1, 'temp1676310502', 1, '2017-04-12 01:14:27'),
(388, 4, 2, NULL, NULL, 1, 1, 'temp1676310502', 1, '2017-04-12 01:14:34'),
(389, 4, 2, NULL, NULL, 1, 1, 'temp270985919', 1, '2017-04-12 01:18:04'),
(390, 4, 36, NULL, NULL, 1, 1, 'temp1479792635', 1, '2017-04-12 01:26:36'),
(391, 4, 37, NULL, NULL, 1, 1, 'temp1479792635', 1, '2017-04-12 01:26:38'),
(392, 4, 36, NULL, NULL, 1, 1, 'temp477288885', 1, '2017-04-12 01:29:18'),
(393, 4, 37, NULL, NULL, 1, 1, 'temp477288885', 1, '2017-04-12 01:29:23'),
(394, 1, 47, NULL, NULL, 1, 1, 'temp377068731', 1, '2017-04-12 01:48:16'),
(395, 2, 26, 95, NULL, 3, 1, 'temp785099936', 1, '2017-04-12 04:48:47'),
(396, 2, 27, 95, NULL, 3, 2, 'temp785099936', 1, '2017-04-12 04:48:50'),
(397, 2, 28, 95, NULL, 3, 2, 'temp785099936', 1, '2017-04-12 04:48:52'),
(398, 2, 29, 95, NULL, 3, 2, 'temp785099936', 1, '2017-04-12 04:48:54'),
(399, 2, 30, 95, NULL, 3, 3, 'temp785099936', 1, '2017-04-12 04:48:57'),
(400, 2, 31, 95, NULL, 3, 3, 'temp785099936', 1, '2017-04-12 04:49:01'),
(401, 2, 32, 95, NULL, 3, 2, 'temp785099936', 1, '2017-04-12 04:49:03'),
(402, 2, 33, 95, NULL, 3, 2, 'temp785099936', 1, '2017-04-12 04:49:05'),
(403, 2, 34, 95, NULL, 3, 1, 'temp785099936', 1, '2017-04-12 04:49:11'),
(404, 2, 35, 95, NULL, 3, 2, 'temp785099936', 1, '2017-04-12 04:49:14'),
(405, 1, 47, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:08:58'),
(406, 1, 48, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:01'),
(407, 1, 49, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:03'),
(408, 1, 50, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:04'),
(409, 1, 51, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:04'),
(410, 1, 52, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:05'),
(411, 1, 53, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:06'),
(412, 1, 54, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:06'),
(413, 1, 55, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:07'),
(414, 1, 56, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:07'),
(415, 1, 57, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:10'),
(416, 1, 58, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:11'),
(417, 1, 59, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:13'),
(418, 1, 60, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:15'),
(419, 1, 61, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:17'),
(420, 1, 62, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:18'),
(421, 1, 63, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:19'),
(422, 1, 64, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:20'),
(423, 1, 65, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:22'),
(424, 1, 66, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:23'),
(425, 1, 67, 96, NULL, 3, 1, 'temp1438829453', 1, '2017-04-12 05:09:24'),
(426, 1, 47, 97, NULL, 3, 2, 'temp929872458', 1, '2017-04-12 05:16:57'),
(427, 1, 48, 97, NULL, 3, 3, 'temp929872458', 1, '2017-04-12 05:17:00'),
(428, 1, 49, 97, NULL, 3, 1, 'temp929872458', 1, '2017-04-12 05:17:05'),
(429, 1, 50, 97, NULL, 3, 1, 'temp929872458', 1, '2017-04-12 05:17:11'),
(430, 1, 51, 97, NULL, 3, 3, 'temp929872458', 1, '2017-04-12 05:17:17'),
(431, 1, 52, 97, NULL, 3, 2, 'temp929872458', 1, '2017-04-12 05:17:20'),
(432, 1, 53, 97, NULL, 3, 4, 'temp929872458', 1, '2017-04-12 05:17:24'),
(433, 1, 54, 97, NULL, 3, 2, 'temp929872458', 1, '2017-04-12 05:17:27'),
(434, 1, 55, 97, NULL, 3, 3, 'temp929872458', 1, '2017-04-12 05:17:32'),
(435, 1, 56, 97, NULL, 3, 3, 'temp929872458', 1, '2017-04-12 05:17:35'),
(436, 1, 57, 97, NULL, 3, 2, 'temp929872458', 1, '2017-04-12 05:20:01'),
(437, 1, 58, 97, NULL, 3, 3, 'temp929872458', 1, '2017-04-12 05:20:04'),
(438, 1, 59, 97, NULL, 3, 1, 'temp929872458', 1, '2017-04-12 05:20:06'),
(439, 1, 60, 97, NULL, 3, 1, 'temp929872458', 1, '2017-04-12 05:20:18'),
(440, 1, 61, 97, NULL, 3, 3, 'temp929872458', 1, '2017-04-12 05:20:24'),
(441, 1, 62, 97, NULL, 3, 2, 'temp929872458', 1, '2017-04-12 05:20:27'),
(442, 1, 63, 97, NULL, 3, 4, 'temp929872458', 1, '2017-04-12 05:20:31'),
(443, 1, 64, 97, NULL, 3, 2, 'temp929872458', 1, '2017-04-12 05:20:33'),
(444, 1, 65, 97, NULL, 3, 3, 'temp929872458', 1, '2017-04-12 05:20:37'),
(445, 1, 66, 97, NULL, 3, 3, 'temp929872458', 1, '2017-04-12 05:20:39'),
(446, 1, 67, 97, NULL, 3, 3, 'temp929872458', 1, '2017-04-12 05:20:40'),
(447, 3, 6, 98, NULL, 3, 2, 'temp972141539', 1, '2017-04-12 05:30:56'),
(448, 3, 7, 98, NULL, 3, 3, 'temp972141539', 1, '2017-04-12 05:30:57'),
(449, 3, 8, 98, NULL, 3, 2, 'temp972141539', 1, '2017-04-12 05:30:59'),
(450, 3, 9, 98, NULL, 3, 3, 'temp972141539', 1, '2017-04-12 05:31:01'),
(451, 3, 10, 98, NULL, 3, 4, 'temp972141539', 1, '2017-04-12 05:31:03'),
(452, 3, 11, 98, NULL, 3, 4, 'temp972141539', 1, '2017-04-12 05:31:06'),
(453, 3, 12, 98, NULL, 3, 2, 'temp972141539', 1, '2017-04-12 05:31:07'),
(454, 3, 13, 98, NULL, 3, 2, 'temp972141539', 1, '2017-04-12 05:31:09'),
(455, 3, 14, 98, NULL, 3, 2, 'temp972141539', 1, '2017-04-12 05:31:11'),
(456, 3, 15, 98, NULL, 3, 2, 'temp972141539', 1, '2017-04-12 05:31:14'),
(457, 3, 16, 98, NULL, 3, 2, 'temp972141539', 1, '2017-04-12 05:31:16'),
(458, 3, 17, 98, NULL, 3, 2, 'temp972141539', 1, '2017-04-12 05:31:18'),
(459, 3, 18, 98, NULL, 3, 3, 'temp972141539', 1, '2017-04-12 05:31:20'),
(460, 3, 19, 98, NULL, 3, 3, 'temp972141539', 1, '2017-04-12 05:31:22'),
(461, 3, 20, 98, NULL, 3, 3, 'temp972141539', 1, '2017-04-12 05:31:24'),
(462, 3, 21, 98, NULL, 3, 3, 'temp972141539', 1, '2017-04-12 05:31:26'),
(463, 3, 22, 98, NULL, 3, 4, 'temp972141539', 1, '2017-04-12 05:31:28'),
(464, 3, 23, 98, NULL, 3, 2, 'temp972141539', 1, '2017-04-12 05:31:31'),
(465, 3, 24, 98, NULL, 3, 3, 'temp972141539', 1, '2017-04-12 05:31:33'),
(466, 3, 25, 98, NULL, 3, 3, 'temp972141539', 1, '2017-04-12 05:31:35'),
(467, 1, 47, NULL, NULL, 3, 1, 'temp2134799007', 1, '2017-04-12 06:54:55'),
(468, 3, 6, 99, NULL, 3, 3, 'temp1644531341', 1, '2017-04-12 08:19:15'),
(469, 3, 7, 99, NULL, 3, 1, 'temp1644531341', 1, '2017-04-12 08:19:21'),
(470, 3, 8, 99, NULL, 3, 1, 'temp1644531341', 1, '2017-04-12 08:19:23'),
(471, 3, 9, 99, NULL, 3, 1, 'temp1644531341', 1, '2017-04-12 08:19:25'),
(472, 3, 10, 99, NULL, 3, 1, 'temp1644531341', 1, '2017-04-12 08:19:27'),
(473, 3, 11, 99, NULL, 3, 4, 'temp1644531341', 1, '2017-04-12 08:19:30'),
(474, 3, 12, 99, NULL, 3, 1, 'temp1644531341', 1, '2017-04-12 08:19:32'),
(475, 3, 13, 99, NULL, 3, 1, 'temp1644531341', 1, '2017-04-12 08:19:34'),
(476, 3, 14, 99, NULL, 3, 1, 'temp1644531341', 1, '2017-04-12 08:19:35'),
(477, 3, 15, 99, NULL, 3, 1, 'temp1644531341', 1, '2017-04-12 08:19:39'),
(478, 3, 16, 99, NULL, 3, 1, 'temp1644531341', 1, '2017-04-12 08:19:41'),
(479, 3, 17, 99, NULL, 3, 1, 'temp1644531341', 1, '2017-04-12 08:19:49'),
(480, 3, 18, 99, NULL, 3, 2, 'temp1644531341', 1, '2017-04-12 08:19:52'),
(481, 3, 19, 99, NULL, 3, 1, 'temp1644531341', 1, '2017-04-12 08:20:04'),
(482, 3, 20, 99, NULL, 3, 1, 'temp1644531341', 1, '2017-04-12 08:20:08'),
(483, 3, 21, 99, NULL, 3, 2, 'temp1644531341', 1, '2017-04-12 08:20:10'),
(484, 3, 22, 99, NULL, 3, 2, 'temp1644531341', 1, '2017-04-12 08:20:13'),
(485, 3, 23, 99, NULL, 3, 2, 'temp1644531341', 1, '2017-04-12 08:20:16'),
(486, 3, 24, 99, NULL, 3, 2, 'temp1644531341', 1, '2017-04-12 08:20:18'),
(487, 3, 25, 99, NULL, 3, 2, 'temp1644531341', 1, '2017-04-12 08:20:20'),
(488, 4, 36, NULL, NULL, 3, 1, 'temp794484259', 1, '2017-04-12 09:42:56'),
(489, 4, 37, NULL, NULL, 3, 1, 'temp794484259', 1, '2017-04-12 09:42:58'),
(490, 1, 47, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:02'),
(491, 1, 48, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:20'),
(492, 1, 49, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:21'),
(493, 1, 50, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:22'),
(494, 1, 51, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:23'),
(495, 1, 52, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:24'),
(496, 1, 53, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:25'),
(497, 1, 54, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:26'),
(498, 1, 55, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:27'),
(499, 1, 56, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:28'),
(500, 1, 57, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:29'),
(501, 1, 58, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:29'),
(502, 1, 59, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:31'),
(503, 1, 60, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:32'),
(504, 1, 61, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:33'),
(505, 1, 62, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:34'),
(506, 1, 63, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:34'),
(507, 1, 64, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:35'),
(508, 1, 65, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:37'),
(509, 1, 66, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:38'),
(510, 1, 67, 100, NULL, 3, 1, 'temp1152676836', 1, '2017-04-12 10:28:39'),
(511, 1, 47, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:26'),
(512, 1, 48, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:26'),
(513, 1, 49, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:27'),
(514, 1, 50, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:29'),
(515, 1, 51, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:39'),
(516, 1, 52, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:40'),
(517, 1, 53, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:41'),
(518, 1, 54, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:42'),
(519, 1, 55, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:43'),
(520, 1, 56, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:44'),
(521, 1, 57, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:45'),
(522, 1, 58, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:46'),
(523, 1, 59, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:47'),
(524, 1, 60, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:48'),
(525, 1, 61, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:49'),
(526, 1, 62, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:50'),
(527, 1, 63, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:51'),
(528, 1, 64, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:52'),
(529, 1, 65, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:53'),
(530, 1, 66, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:55'),
(531, 1, 67, 101, NULL, 5, 1, 'temp65270212', 1, '2017-04-12 10:59:56'),
(532, 3, 6, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:47:56'),
(533, 3, 7, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:47:57'),
(534, 3, 8, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:47:59'),
(535, 3, 9, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:00'),
(536, 3, 10, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:01'),
(537, 3, 11, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:03'),
(538, 3, 12, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:04'),
(539, 3, 13, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:06'),
(540, 3, 14, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:07'),
(541, 3, 15, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:09'),
(542, 3, 16, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:10'),
(543, 3, 17, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:12'),
(544, 3, 18, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:13'),
(545, 3, 19, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:14'),
(546, 3, 20, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:16'),
(547, 3, 21, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:17'),
(548, 3, 22, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:18'),
(549, 3, 23, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:19'),
(550, 3, 24, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:20'),
(551, 3, 25, 102, NULL, 5, 1, 'temp613451485', 1, '2017-04-12 11:48:21'),
(552, 1, 47, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:42'),
(553, 1, 48, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:42'),
(554, 1, 49, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:43'),
(555, 1, 50, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:44'),
(556, 1, 51, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:44'),
(557, 1, 52, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:45'),
(558, 1, 53, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:46'),
(559, 1, 54, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:46'),
(560, 1, 55, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:47'),
(561, 1, 56, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:47'),
(562, 1, 57, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:49'),
(563, 1, 58, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:50'),
(564, 1, 59, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:51'),
(565, 1, 60, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:52'),
(566, 1, 61, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:52'),
(567, 1, 62, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:53'),
(568, 1, 63, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:54'),
(569, 1, 64, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:54'),
(570, 1, 65, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:55'),
(571, 1, 66, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:56'),
(572, 1, 67, 103, NULL, 3, 1, 'temp1672801622', 1, '2017-04-12 13:47:56'),
(573, 1, 47, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:09'),
(574, 1, 48, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:10'),
(575, 1, 49, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:12'),
(576, 1, 50, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:14'),
(577, 1, 51, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:14'),
(578, 1, 52, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:15'),
(579, 1, 53, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:16'),
(580, 1, 54, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:18'),
(581, 1, 55, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:19'),
(582, 1, 56, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:21'),
(583, 1, 57, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:23'),
(584, 1, 58, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:24'),
(585, 1, 59, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:25'),
(586, 1, 60, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:26'),
(587, 1, 61, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:27'),
(588, 1, 62, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:27'),
(589, 1, 63, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:28'),
(590, 1, 64, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:29'),
(591, 1, 65, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:30'),
(592, 1, 66, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:31'),
(593, 1, 67, 104, NULL, 4, 1, 'temp1368259719', 1, '2017-04-12 14:08:32'),
(594, 1, 47, NULL, NULL, 1, 1, 'temp2051520974', 1, '2017-04-12 16:08:25'),
(595, 1, 47, NULL, NULL, 5, 1, 'temp56608136', 1, '2017-04-13 08:23:46'),
(596, 1, 48, NULL, NULL, 5, 1, 'temp56608136', 1, '2017-04-13 08:23:48'),
(597, 1, 49, NULL, NULL, 5, 1, 'temp56608136', 1, '2017-04-13 08:23:50'),
(598, 1, 50, NULL, NULL, 5, 1, 'temp56608136', 1, '2017-04-13 08:23:51'),
(599, 1, 51, NULL, NULL, 5, 1, 'temp56608136', 1, '2017-04-13 08:23:53'),
(600, 1, 52, NULL, NULL, 5, 1, 'temp56608136', 1, '2017-04-13 08:23:54'),
(601, 1, 53, NULL, NULL, 5, 1, 'temp56608136', 1, '2017-04-13 08:23:55'),
(602, 1, 54, NULL, NULL, 5, 1, 'temp56608136', 1, '2017-04-13 08:23:57'),
(603, 1, 55, NULL, NULL, 5, 1, 'temp56608136', 1, '2017-04-13 08:24:11'),
(604, 1, 56, NULL, NULL, 5, 1, 'temp56608136', 1, '2017-04-13 08:24:13'),
(605, 2, 26, NULL, NULL, 5, 1, 'temp1607221698', 1, '2017-04-13 08:24:44'),
(606, 1, 47, NULL, NULL, 3, 1, 'temp1181781384', 1, '2017-04-13 09:12:45'),
(607, 1, 48, NULL, NULL, 3, 1, 'temp1181781384', 1, '2017-04-13 09:12:46'),
(608, 1, 49, NULL, NULL, 3, 1, 'temp1181781384', 1, '2017-04-13 09:12:47'),
(609, 1, 50, NULL, NULL, 3, 1, 'temp1181781384', 1, '2017-04-13 09:12:48'),
(610, 1, 51, NULL, NULL, 3, 1, 'temp1181781384', 1, '2017-04-13 09:12:50'),
(611, 1, 52, NULL, NULL, 3, 1, 'temp1181781384', 1, '2017-04-13 09:12:50'),
(612, 1, 53, NULL, NULL, 3, 1, 'temp1181781384', 1, '2017-04-13 09:12:51'),
(613, 1, 47, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:23'),
(614, 1, 48, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:25'),
(615, 1, 49, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:27'),
(616, 1, 50, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:28'),
(617, 1, 51, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:29'),
(618, 1, 52, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:29'),
(619, 1, 53, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:31'),
(620, 1, 54, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:32'),
(621, 1, 55, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:33'),
(622, 1, 56, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:34'),
(623, 1, 57, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:34'),
(624, 1, 58, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:36'),
(625, 1, 59, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:37'),
(626, 1, 60, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:37'),
(627, 1, 61, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:38'),
(628, 1, 62, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:39'),
(629, 1, 63, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:40'),
(630, 1, 64, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:41'),
(631, 1, 65, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:42'),
(632, 1, 66, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:42'),
(633, 1, 67, 105, NULL, 3, 1, 'temp1892063626', 1, '2017-04-13 13:05:43'),
(634, 4, 36, NULL, NULL, 3, 1, 'temp641171725', 1, '2017-04-14 10:29:08'),
(635, 4, 37, NULL, NULL, 3, 1, 'temp641171725', 1, '2017-04-14 10:29:09'),
(636, 4, 38, NULL, NULL, 3, 1, 'temp641171725', 1, '2017-04-14 10:29:11'),
(637, 4, 36, 106, NULL, 3, 1, 'temp156586847', 1, '2017-04-14 10:29:17'),
(638, 4, 37, 106, NULL, 3, 1, 'temp156586847', 1, '2017-04-14 10:29:18'),
(639, 4, 38, 106, NULL, 3, 1, 'temp156586847', 1, '2017-04-14 10:29:19'),
(640, 4, 39, 106, NULL, 3, 1, 'temp156586847', 1, '2017-04-14 10:29:20'),
(641, 4, 40, 106, NULL, 3, 1, 'temp156586847', 1, '2017-04-14 10:29:21'),
(642, 4, 41, 106, NULL, 3, 1, 'temp156586847', 1, '2017-04-14 10:29:22'),
(643, 4, 42, 106, NULL, 3, 1, 'temp156586847', 1, '2017-04-14 10:29:23'),
(644, 4, 43, 106, NULL, 3, 1, 'temp156586847', 1, '2017-04-14 10:29:24'),
(645, 4, 44, 106, NULL, 3, 1, 'temp156586847', 1, '2017-04-14 10:29:25'),
(646, 4, 45, 106, NULL, 3, 1, 'temp156586847', 1, '2017-04-14 10:29:26'),
(647, 3, 6, NULL, NULL, 3, 4, 'temp409241192', 1, '2017-04-14 11:11:22'),
(648, 3, 7, NULL, NULL, 3, 1, 'temp409241192', 1, '2017-04-14 11:11:32'),
(649, 3, 6, NULL, NULL, 2, 2, 'temp482745156', 1, '2017-04-14 11:17:27'),
(650, 3, 7, NULL, NULL, 2, 2, 'temp482745156', 1, '2017-04-14 11:17:32'),
(651, 3, 8, NULL, NULL, 3, 2, 'temp409241192', 1, '2017-04-14 11:19:34'),
(652, 4, 36, NULL, NULL, 3, 1, 'temp1676178158', 1, '2017-04-14 11:20:23'),
(653, 4, 37, NULL, NULL, 3, 2, 'temp1676178158', 1, '2017-04-14 11:20:33'),
(654, 3, 6, NULL, NULL, 2, 2, 'temp1953129733', 1, '2017-04-14 12:11:20'),
(655, 3, 7, NULL, NULL, 2, 2, 'temp1953129733', 1, '2017-04-14 12:11:28'),
(656, 1, 47, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:36'),
(657, 1, 48, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:37'),
(658, 1, 49, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:38'),
(659, 1, 50, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:39'),
(660, 1, 51, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:39'),
(661, 1, 52, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:40'),
(662, 1, 53, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:41'),
(663, 1, 54, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:42'),
(664, 1, 55, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:42'),
(665, 1, 56, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:43'),
(666, 1, 57, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:44'),
(667, 1, 58, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:44'),
(668, 1, 59, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:45'),
(669, 1, 60, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:45'),
(670, 1, 61, NULL, NULL, 3, 1, 'temp2024844365', 1, '2017-04-14 13:05:46'),
(671, 3, 6, NULL, NULL, 3, 1, 'temp1858668177', 1, '2017-04-14 13:05:52'),
(672, 3, 7, NULL, NULL, 3, 1, 'temp1858668177', 1, '2017-04-14 13:05:53'),
(673, 3, 6, NULL, NULL, 3, 1, 'temp1942007807', 1, '2017-04-14 13:06:50'),
(674, 3, 7, NULL, NULL, 3, 1, 'temp1942007807', 1, '2017-04-14 13:06:51'),
(675, 3, 6, NULL, NULL, 3, 1, 'temp314010584', 1, '2017-04-14 13:08:28'),
(676, 3, 7, NULL, NULL, 3, 1, 'temp314010584', 1, '2017-04-14 13:08:29'),
(677, 3, 6, 107, NULL, 3, 1, 'temp1546412484', 1, '2017-04-14 13:08:47'),
(678, 3, 7, 107, NULL, 3, 1, 'temp1546412484', 1, '2017-04-14 13:08:49'),
(679, 3, 8, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:08:58'),
(680, 3, 9, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:08:59'),
(681, 3, 10, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:02'),
(682, 3, 11, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:04'),
(683, 3, 12, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:05'),
(684, 3, 13, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:10'),
(685, 3, 14, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:16'),
(686, 3, 15, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:20'),
(687, 3, 16, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:25'),
(688, 3, 17, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:28'),
(689, 3, 18, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:30'),
(690, 3, 19, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:31'),
(691, 3, 20, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:32'),
(692, 3, 21, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:33'),
(693, 3, 22, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:35'),
(694, 3, 23, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:36'),
(695, 3, 24, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:37'),
(696, 3, 25, 107, NULL, 3, 2, 'temp1546412484', 1, '2017-04-14 13:09:38'),
(697, 3, 6, NULL, NULL, 3, 1, 'temp1623584563', 1, '2017-04-14 13:44:29'),
(698, 3, 7, NULL, NULL, 3, 2, 'temp1623584563', 1, '2017-04-14 13:44:33'),
(699, 3, 8, NULL, NULL, 3, 2, 'temp1623584563', 1, '2017-04-14 13:44:37'),
(700, 1, 47, NULL, NULL, 9, 2, 'temp689746670', 1, '2017-04-20 11:59:36');
INSERT INTO `tbl_userassessment` (`userassessmentid`, `fk_category_id`, `fk_assessmentsid`, `fk_userresultid`, `useremail`, `fk_userid`, `useranswer`, `usertempid`, `statuscheck`, `createddate`) VALUES
(701, 1, 48, NULL, NULL, 9, 2, 'temp689746670', 1, '2017-04-20 11:59:54'),
(702, 4, 36, NULL, NULL, 9, 1, 'temp123162083', 1, '2017-04-20 12:00:41'),
(703, 4, 37, NULL, NULL, 9, 1, 'temp123162083', 1, '2017-04-20 12:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userresults`
--

CREATE TABLE IF NOT EXISTS `tbl_userresults` (
  `userresultid` int(11) NOT NULL AUTO_INCREMENT,
  `fk_category_id` int(11) NOT NULL,
  `useremail` varchar(255) DEFAULT NULL,
  `fk_userid` int(11) NOT NULL,
  `totalnoquestions` int(11) DEFAULT NULL,
  `totalrightanswer` int(11) DEFAULT NULL,
  `usertempid` varchar(255) DEFAULT NULL,
  `statuscheck` int(11) DEFAULT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userresultid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `tbl_userresults`
--

INSERT INTO `tbl_userresults` (`userresultid`, `fk_category_id`, `useremail`, `fk_userid`, `totalnoquestions`, `totalrightanswer`, `usertempid`, `statuscheck`, `createddate`) VALUES
(1, 4, NULL, 10, 2, 0, 'temp781577788', 1, '2017-03-15 05:01:40'),
(2, 4, NULL, 12, 2, 0, 'temp678296582', 1, '2017-03-15 11:13:58'),
(3, 4, NULL, 12, 2, 0, 'temp1125140383', 1, '2017-03-15 11:32:03'),
(4, 4, NULL, 12, 2, 0, 'temp2067138999', 1, '2017-03-15 11:32:33'),
(5, 4, NULL, 12, 2, 0, 'temp1957690245', 1, '2017-03-15 11:34:16'),
(6, 4, NULL, 12, 2, 0, 'temp117921266', 1, '2017-03-15 11:38:34'),
(7, 4, NULL, 12, 2, 2, 'temp853524444', 1, '2017-03-15 11:39:24'),
(8, 4, NULL, 12, 1, 0, 'temp576796487', 1, '2017-03-15 11:41:02'),
(9, 4, NULL, 12, 2, 0, 'temp43279727', 1, '2017-03-15 11:42:36'),
(10, 4, NULL, 12, 2, 0, 'temp1817311922', 1, '2017-03-15 11:49:11'),
(11, 4, NULL, 12, 2, 0, 'temp1205463736', 1, '2017-03-16 04:32:01'),
(12, 4, NULL, 15, 2, 0, 'temp592054724', 1, '2017-03-16 07:01:30'),
(13, 1, NULL, 14, 1, 1, 'temp355691422', 1, '2017-03-22 12:19:57'),
(14, 1, NULL, 39, 1, 0, '39', 1, '2017-03-22 13:06:01'),
(15, 1, NULL, 50, 1, 0, '50', 1, '2017-03-27 04:43:35'),
(16, 1, NULL, 51, 1, 0, '51', 1, '2017-03-27 09:25:35'),
(17, 1, NULL, 52, 1, 0, '52', 1, '2017-03-27 09:33:17'),
(18, 1, NULL, 42, 1, 1, 'temp999502879', 1, '2017-03-27 10:03:30'),
(19, 1, NULL, 42, 1, 0, 'temp332512420', 1, '2017-03-27 10:03:44'),
(20, 1, NULL, 42, 1, 1, 'temp83491070', 1, '2017-03-27 10:04:02'),
(21, 1, NULL, 53, 1, 0, '53', 1, '2017-03-27 10:50:12'),
(22, 1, NULL, 54, 1, 0, '54', 1, '2017-03-27 11:04:41'),
(23, 2, NULL, 38, 1, 0, '38', 1, '2017-03-27 11:37:30'),
(24, 1, NULL, 38, 1, 0, 'temp1181761870', 1, '2017-03-27 12:01:00'),
(25, 4, NULL, 38, 2, 0, 'temp1103960533', 1, '2017-03-27 12:02:32'),
(26, 1, NULL, 56, 1, 0, 'temp829303593', 1, '2017-03-27 12:05:19'),
(27, 1, NULL, 56, 1, 1, 'temp1172708957', 1, '2017-03-27 12:08:14'),
(28, 4, NULL, 56, 2, 2, 'temp1796082033', 1, '2017-03-27 12:08:40'),
(29, 1, NULL, 56, 1, 0, 'temp337802457', 1, '2017-03-27 12:14:09'),
(30, 1, NULL, 57, 1, 1, 'temp1238653338', 1, '2017-03-27 12:27:26'),
(31, 2, NULL, 57, 1, 0, 'temp1633111146', 1, '2017-03-27 12:27:32'),
(32, 4, NULL, 57, 2, 1, 'temp289971421', 1, '2017-03-27 12:27:42'),
(33, 3, NULL, 57, 1, 1, 'temp1355823091', 1, '2017-03-27 12:27:48'),
(34, 1, NULL, 58, 1, 0, 'temp1028996887', 1, '2017-03-28 11:03:09'),
(35, 1, NULL, 66, 1, 1, 'temp435230505', 1, '2017-03-30 10:30:54'),
(36, 1, NULL, 66, 1, 1, 'temp902364438', 1, '2017-03-30 10:33:11'),
(37, 3, NULL, 69, 1, 1, 'temp1251627982', 1, '2017-03-30 14:00:02'),
(38, 3, NULL, 69, 1, 1, 'temp1233246251', 1, '2017-03-31 06:17:18'),
(39, 1, NULL, 69, 1, 0, 'temp1934952242', 1, '2017-03-31 06:17:28'),
(40, 1, NULL, 69, 1, 0, 'temp480115729', 1, '2017-03-31 06:17:34'),
(41, 3, NULL, 69, 1, 0, 'temp753419062', 1, '2017-03-31 06:17:40'),
(42, 1, NULL, 70, 1, 1, 'temp606894675', 1, '2017-04-03 05:33:34'),
(43, 3, NULL, 77, 1, 1, 'temp1922048309', 1, '2017-04-04 11:33:53'),
(44, 4, NULL, 70, 2, 0, 'temp900690410', 1, '2017-04-05 04:32:54'),
(45, 1, NULL, 70, 1, 1, 'temp80778889', 1, '2017-04-05 05:40:19'),
(46, 1, NULL, 70, 1, 1, 'temp289913091', 1, '2017-04-05 05:51:55'),
(47, 1, NULL, 70, 1, 1, 'temp1431387384', 1, '2017-04-05 05:54:11'),
(48, 2, NULL, 70, 1, 0, 'temp1321220073', 1, '2017-04-05 05:54:38'),
(49, 1, NULL, 70, 1, 0, 'temp270110061', 1, '2017-04-05 06:08:08'),
(50, 3, NULL, 70, 1, 0, 'temp1587690699', 1, '2017-04-05 06:08:32'),
(51, 1, NULL, 70, 1, 0, 'temp91718560', 1, '2017-04-05 06:10:11'),
(52, 1, NULL, 70, 1, 0, 'temp2097891432', 1, '2017-04-05 06:19:32'),
(53, 3, NULL, 70, 1, 0, 'temp9346660', 1, '2017-04-05 06:23:34'),
(54, 1, NULL, 70, 1, 0, 'temp2090616598', 1, '2017-04-05 06:25:00'),
(55, 1, NULL, 70, 1, 0, 'temp1068490598', 1, '2017-04-05 06:28:54'),
(56, 1, NULL, 70, 1, 0, 'temp152077460', 1, '2017-04-05 06:32:56'),
(57, 1, NULL, 70, 1, 0, 'temp1285001904', 1, '2017-04-05 06:34:06'),
(58, 2, NULL, 70, 1, 0, 'temp1458817976', 1, '2017-04-05 06:53:14'),
(59, 2, NULL, 70, 1, 0, 'temp1470382159', 1, '2017-04-05 06:57:42'),
(60, 1, NULL, 70, 1, 0, 'temp54098383', 1, '2017-04-05 07:08:37'),
(61, 4, NULL, 70, 2, 1, 'temp1765895207', 1, '2017-04-05 07:15:36'),
(62, 4, NULL, 70, 2, 1, 'temp1569866120', 1, '2017-04-05 07:19:55'),
(63, 4, NULL, 70, 2, 1, 'temp1325068294', 1, '2017-04-05 07:22:23'),
(64, 4, NULL, 70, 2, 1, 'temp7355714', 1, '2017-04-05 07:24:14'),
(65, 4, NULL, 70, 2, 1, 'temp489379050', 1, '2017-04-05 07:28:51'),
(66, 4, NULL, 70, 2, 1, 'temp2083451652', 1, '2017-04-05 07:30:34'),
(67, 4, NULL, 70, 2, 0, 'temp2040388311', 1, '2017-04-05 08:17:21'),
(68, 4, NULL, 70, 2, 0, 'temp2139606380', 1, '2017-04-05 08:17:33'),
(69, 4, NULL, 70, 2, 0, 'temp841119580', 1, '2017-04-05 08:18:09'),
(70, 4, NULL, 70, 2, 1, 'temp2036249396', 1, '2017-04-05 08:24:29'),
(71, 4, NULL, 70, 2, 1, 'temp412639072', 1, '2017-04-05 08:25:54'),
(72, 4, NULL, 70, 2, 0, 'temp699516137', 1, '2017-04-05 08:46:29'),
(73, 4, NULL, 79, 2, 0, 'temp1751609617', 1, '2017-04-05 09:19:30'),
(74, 4, NULL, 70, 2, 0, 'temp1663735788', 1, '2017-04-05 09:25:02'),
(75, 4, NULL, 80, 2, 0, 'temp932114706', 1, '2017-04-05 09:35:02'),
(76, 3, NULL, 81, 1, 1, 'temp1455475195', 1, '2017-04-05 17:33:28'),
(77, 3, NULL, 70, 1, 1, 'temp1165038699', 1, '2017-04-07 06:49:50'),
(78, 4, NULL, 70, 2, 0, 'temp147664911', 1, '2017-04-07 07:01:44'),
(79, 3, NULL, 70, 1, 1, 'temp1155784914', 1, '2017-04-07 07:01:55'),
(80, 3, NULL, 70, 1, 1, 'temp1657091699', 1, '2017-04-07 07:06:33'),
(81, 1, NULL, 91, 1, 1, 'temp269728645', 1, '2017-04-09 16:06:42'),
(82, 3, NULL, 91, 1, 1, 'temp712053363', 1, '2017-04-09 18:08:13'),
(83, 3, NULL, 92, 2, 2, 'temp1139987029', 1, '2017-04-09 18:13:08'),
(84, 3, NULL, 92, 7, 7, 'temp1294716251', 1, '2017-04-09 19:14:32'),
(85, 3, NULL, 92, 21, 0, 'temp668820076', 1, '2017-04-09 19:15:56'),
(86, 1, NULL, 92, 1, 1, 'temp1119141737', 1, '2017-04-09 19:20:43'),
(87, 1, NULL, 92, 2, 2, 'temp716454768', 1, '2017-04-09 20:37:12'),
(88, 1, NULL, 92, 2, 1, 'temp1080597898', 1, '2017-04-09 20:37:30'),
(89, 4, NULL, 92, 12, 2, 'temp1779674418', 1, '2017-04-09 20:50:09'),
(90, 1, NULL, 92, 15, 4, 'temp1800722090', 1, '2017-04-09 21:02:37'),
(91, 1, NULL, 92, 23, 5, 'temp1867976205', 1, '2017-04-09 21:18:12'),
(92, 1, NULL, 89, 23, 7, 'temp1300906911', 1, '2017-04-10 10:24:18'),
(93, 1, NULL, 89, 23, 5, 'temp1730984385', 1, '2017-04-10 10:48:52'),
(94, 1, NULL, 68, 23, 5, 'temp1591298743', 1, '2017-04-11 06:25:08'),
(95, 2, NULL, 3, 10, 5, 'temp785099936', 1, '2017-04-12 04:49:14'),
(96, 1, NULL, 3, 21, 4, 'temp1438829453', 1, '2017-04-12 05:09:24'),
(97, 1, NULL, 3, 21, 21, 'temp929872458', 1, '2017-04-12 05:20:41'),
(98, 3, NULL, 3, 20, 1, 'temp972141539', 1, '2017-04-12 05:31:35'),
(99, 3, NULL, 3, 20, 13, 'temp1644531341', 1, '2017-04-12 08:20:20'),
(100, 1, NULL, 3, 21, 4, 'temp1152676836', 1, '2017-04-12 10:28:39'),
(101, 1, NULL, 5, 21, 4, 'temp65270212', 1, '2017-04-12 10:59:56'),
(102, 3, NULL, 5, 20, 14, 'temp613451485', 1, '2017-04-12 11:48:22'),
(103, 1, NULL, 3, 21, 4, 'temp1672801622', 1, '2017-04-12 13:47:57'),
(104, 1, NULL, 4, 21, 4, 'temp1368259719', 1, '2017-04-12 14:08:32'),
(105, 1, NULL, 3, 21, 4, 'temp1892063626', 1, '2017-04-13 13:05:44'),
(106, 4, NULL, 3, 10, 2, 'temp156586847', 1, '2017-04-14 10:29:26'),
(107, 3, NULL, 3, 20, 4, 'temp1546412484', 1, '2017-04-14 13:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `device_type` int(11) DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `notification_token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `cr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime DEFAULT NULL,
  `Created_Id` varchar(120) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `email`, `name`, `password`, `device_type`, `device_token`, `notification_token`, `status`, `cr_date`, `modified_date`, `Created_Id`, `ip_address`) VALUES
(1, 'cesar.ramos@advancedplanninganalytics.com', 'Cesar Ramos', NULL, 0, '06362178-1032-48FA-B7F8-9B6D6051B32F', NULL, 1, '2017-04-11 10:13:30', NULL, NULL, ''),
(2, 'vishal.dhamecha@vrinsofts.com', 'Vishal', NULL, 0, '06362178-1032-48FA-B7F8-9B6D6051B32F', NULL, 1, '2017-04-11 10:15:09', NULL, NULL, ''),
(3, 'nirali.vrinsoft@gmail.com', 'nirali', NULL, 0, 'c858d23346533e35', NULL, 1, '2017-04-11 10:15:14', NULL, NULL, ''),
(4, 'yasmik@gmail.com', 'yasmik', NULL, 0, 'a2e112dfde992dfa', NULL, 1, '2017-04-12 04:44:01', NULL, NULL, ''),
(5, 'nirali.vronsoft@gmail.com', 'nirali', NULL, 0, '44de3a2f3c169e73', NULL, 1, '2017-04-12 10:55:12', NULL, NULL, ''),
(6, 'pratik.dodiya@vrinsofts.com', 'pratik', NULL, 0, '20f12de8019a4e6', NULL, 1, '2017-04-13 13:14:44', NULL, NULL, ''),
(7, 'ghanshyam.vrinsoft@gmail.com', 'Ghanshyam', NULL, 0, '1234', NULL, 1, '2017-04-14 13:13:34', NULL, NULL, ''),
(8, 'yasmik@vrinsoft.com', 'yasmik', NULL, 0, 'db1385d74de6aed8', NULL, 1, '2017-04-14 13:48:11', NULL, NULL, ''),
(9, 'pratik@gmail.com', 'pratik', NULL, 0, 'c2be89fdd19310fe', NULL, 1, '2017-04-20 11:37:04', NULL, NULL, ''),
(10, 'vishal@gmail.com', 'Bishal', NULL, 0, 'D9BD5490-9457-4336-AB2E-16E7838CB05D', NULL, 1, '2017-04-25 04:47:17', NULL, NULL, ''),
(11, 'pratik@gmail.con', 'pratik', NULL, 0, 'f9f84c8bd99ff659', NULL, 1, '2017-04-28 14:35:33', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertype`
--

CREATE TABLE IF NOT EXISTS `tbl_usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usertypename` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_usertype`
--

INSERT INTO `tbl_usertype` (`id`, `usertypename`, `status`, `createdby`, `createdatetime`, `updatedby`, `updatedatetime`) VALUES
(1, 'Admin', 1, 1, '2016-09-23 01:17:14', 1, '2016-09-28 23:51:33'),
(2, 'Sub Admin', 1, 1, '2016-09-23 01:17:25', 1, '2016-09-27 21:38:52'),
(3, 'Super Admin', 2, 1, '2016-09-23 01:17:34', 1, '2016-09-23 01:17:48'),
(4, '', 2, 1, '2016-09-23 03:29:15', 1, '2016-09-23 03:29:15'),
(5, 'Super Admin', 2, 1, '2016-09-23 03:31:12', 1, '2016-09-23 03:31:12'),
(6, 'Super Sub Admin', 2, 1, '2016-09-28 01:01:04', 1, '2016-09-28 01:01:12'),
(7, 'Super Sub Admin', 2, 1, '2016-09-28 01:01:26', 1, '2016-09-28 01:01:26'),
(8, 'dsd', 2, 1, '2016-09-28 01:30:29', 1, '2016-09-28 01:30:29'),
(9, 'Admin', 1, 1, '2016-09-23 01:17:14', 1, '2016-09-28 23:51:33'),
(10, 'Sub Admin', 1, 1, '2016-09-23 01:17:25', 1, '2016-09-27 21:38:52'),
(11, 'Super Admin', 2, 1, '2016-09-23 01:17:34', 1, '2016-09-23 01:17:48'),
(12, '', 2, 1, '2016-09-23 03:29:15', 1, '2016-09-23 03:29:15'),
(13, 'Super Admin', 2, 1, '2016-09-23 03:31:12', 1, '2016-09-23 03:31:12'),
(14, 'Super Sub Admin', 2, 1, '2016-09-28 01:01:04', 1, '2016-09-28 01:01:12'),
(15, 'Super Sub Admin', 2, 1, '2016-09-28 01:01:26', 1, '2016-09-28 01:01:26'),
(16, 'dsd', 2, 1, '2016-09-28 01:30:29', 1, '2016-09-28 01:30:29');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
