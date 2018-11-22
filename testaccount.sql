-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 22, 2018 at 12:20 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testaccount`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `account_number` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `balance` double(15,2) DEFAULT NULL,
  `account_type` varchar(255) DEFAULT NULL,
  `service_type` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `interest_rate` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`account_number`),
  KEY `service_type` (`service_type`),
  KEY `client_id` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_number`, `client_id`, `balance`, `account_type`, `service_type`, `level`, `interest_rate`) VALUES
(1, 1, 0.00, 'checking', 'banking', 'personal', 0.00),
(2, 1, 0.00, 'savings', 'banking', 'personal', 2.00),
(3, 1, 0.00, 'foreign-currency', 'banking', 'personal', 0.00),
(4, 1, 0.00, 'savings', 'banking', 'personal', 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE IF NOT EXISTS `bills` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double(15,2) DEFAULT NULL,
  `is_paid` bit(1) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`bill_id`),
  KEY `client_id` (`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(12) DEFAULT NULL,
  `fax` varchar(12) DEFAULT NULL,
  `manager_name` varchar(255) DEFAULT NULL,
  `opening_date` date DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `phone`, `fax`, `manager_name`, `opening_date`, `area`, `city`) VALUES
(1, '5141111111', '5141111112', 'Jimmy', '2018-11-01', 'Downtown', 'Montreal');

-- --------------------------------------------------------

--
-- Table structure for table `chargeplan`
--

DROP TABLE IF EXISTS `chargeplan`;
CREATE TABLE IF NOT EXISTS `chargeplan` (
  `opt` varchar(255) NOT NULL,
  `lim` int(11) DEFAULT NULL,
  `charge` double(15,2) DEFAULT NULL,
  `additional_charge` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`opt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chargeplan`
--

INSERT INTO `chargeplan` (`opt`, `lim`, `charge`, `additional_charge`) VALUES
('Basic', 100, 25.00, 2.50);

-- --------------------------------------------------------

--
-- Table structure for table `checking`
--

DROP TABLE IF EXISTS `checking`;
CREATE TABLE IF NOT EXISTS `checking` (
  `account_number` int(11) NOT NULL,
  `opt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`account_number`),
  KEY `opt` (`opt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checking`
--

INSERT INTO `checking` (`account_number`, `opt`) VALUES
(1, 'basic');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `is_notified` bit(1) DEFAULT NULL,
  PRIMARY KEY (`client_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `name`, `date_of_birth`, `joining_date`, `address`, `category`, `email_address`, `password`, `phone_number`, `branch_id`, `is_notified`) VALUES
(1, 'mr rem', '2018-11-13', '2018-11-17', '91 r', 'Basic', 'r@m.com', '$2y$10$GqxKDjL76I5NSLBH2ghb6eVYUyxb607C1fNGOLMrcvDNU6v.WM1H2', '514-555-5555', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

DROP TABLE IF EXISTS `credit`;
CREATE TABLE IF NOT EXISTS `credit` (
  `account_number` int(11) NOT NULL,
  `credit_limit` double(15,2) DEFAULT NULL,
  `minimal_payment` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`account_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `salary` double(15,2) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `holidays` int(11) DEFAULT NULL,
  `sick_days` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foreigncurrency`
--

DROP TABLE IF EXISTS `foreigncurrency`;
CREATE TABLE IF NOT EXISTS `foreigncurrency` (
  `account_number` int(11) NOT NULL,
  `currency_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`account_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foreigncurrency`
--

INSERT INTO `foreigncurrency` (`account_number`, `currency_type`) VALUES
(3, 'jpy');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

DROP TABLE IF EXISTS `loan`;
CREATE TABLE IF NOT EXISTS `loan` (
  `account_number` int(11) NOT NULL,
  `loan_limit` double(15,2) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`account_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reoccurringbills`
--

DROP TABLE IF EXISTS `reoccurringbills`;
CREATE TABLE IF NOT EXISTS `reoccurringbills` (
  `bill_id` int(11) NOT NULL,
  `reoccurrence` int(11) DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

DROP TABLE IF EXISTS `savings`;
CREATE TABLE IF NOT EXISTS `savings` (
  `account_number` int(11) NOT NULL,
  `opt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`account_number`),
  KEY `opt` (`opt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`account_number`, `opt`) VALUES
(2, 'Basic'),
(4, 'basic');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(255) NOT NULL,
  `start_time` varchar(12) DEFAULT NULL,
  `end_time` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`employee_id`,`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `service_type` varchar(255) NOT NULL,
  `manager_id` int(11) NOT NULL,
  PRIMARY KEY (`service_type`),
  KEY `manager_id` (`manager_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_number` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`transaction_number`),
  KEY `account_number` (`account_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
