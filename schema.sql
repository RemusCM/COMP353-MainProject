-- phpMyAdmin SQL Dump

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;



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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `bills`;
CREATE TABLE IF NOT EXISTS `bills` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double(15,2) DEFAULT NULL,
  `is_paid` bit(1) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`bill_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `chargeplan`;
CREATE TABLE IF NOT EXISTS `chargeplan` (
  `opt` varchar(255) NOT NULL,
  `lim` int(11) DEFAULT NULL,
  `charge` double(15,2) DEFAULT NULL,
  `additional_charge` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`opt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `checking`;
CREATE TABLE IF NOT EXISTS `checking` (
  `account_number` int(11) NOT NULL,
  `opt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`account_number`),
  KEY `opt` (`opt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `credit`;
CREATE TABLE IF NOT EXISTS `credit` (
  `account_number` int(11) NOT NULL,
  `credit_limit` double(15,2) DEFAULT NULL,
  `minimal_payment` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`account_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `foreigncurrency`;
CREATE TABLE IF NOT EXISTS `foreigncurrency` (
  `account_number` int(11) NOT NULL,
  `currency_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`account_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `loan`;
CREATE TABLE IF NOT EXISTS `loan` (
  `account_number` int(11) NOT NULL,
  `loan_limit` double(15,2) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`account_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `reoccurringbills`;
CREATE TABLE IF NOT EXISTS `reoccurringbills` (
  `bill_id` int(11) NOT NULL,
  `reoccurrence` int(11) DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `savings`;
CREATE TABLE IF NOT EXISTS `savings` (
  `account_number` int(11) NOT NULL,
  `opt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`account_number`),
  KEY `opt` (`opt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(255) NOT NULL,
  `start_time` varchar(12) DEFAULT NULL,
  `end_time` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`employee_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `service_type` varchar(255) NOT NULL,
  `manager_id` int(11) NOT NULL,
  PRIMARY KEY (`service_type`),
  KEY `manager_id` (`manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_number` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,

  `amount` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`transaction_number`),
  KEY `account_number` (`account_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`),
  ADD CONSTRAINT `account_ibfk_2` FOREIGN KEY (`service_type`) REFERENCES `service` (`service_type`);


ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`);


ALTER TABLE `checking`
  ADD CONSTRAINT `checking_ibfk_1` FOREIGN KEY (`opt`) REFERENCES `chargeplan` (`opt`),
  ADD CONSTRAINT `checking_ibfk_2` FOREIGN KEY (`account_number`) REFERENCES `account` (`account_number`);

ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);


ALTER TABLE `credit`
  ADD CONSTRAINT `credit_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `account` (`account_number`);


ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);


ALTER TABLE `foreigncurrency`
  ADD CONSTRAINT `foreigncurrency_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `account` (`account_number`);


ALTER TABLE `loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `account` (`account_number`);


ALTER TABLE `reoccurringbills`
  ADD CONSTRAINT `reoccurringbills_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`);

ALTER TABLE `savings`
  ADD CONSTRAINT `savings_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `account` (`account_number`),
  ADD CONSTRAINT `savings_ibfk_2` FOREIGN KEY (`opt`) REFERENCES `chargeplan` (`opt`);


ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);


ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `employee` (`employee_id`);


ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `account` (`account_number`);
COMMIT;


