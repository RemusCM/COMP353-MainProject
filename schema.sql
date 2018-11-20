-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:8889
-- Généré le :  Dim 11 nov. 2018 à 18:15
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Structure de la table `Admin`
--

CREATE TABLE `Admin` (
  `admin_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Account`
--

CREATE TABLE `Account` (
  `account_number` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `balance` double(15,2) DEFAULT NULL,
  `account_type` varchar(255) DEFAULT NULL,
  `service_type` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `interest_rate` double(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Bills`
--

CREATE TABLE `Bills` (
  `bill_id` int(11) NOT NULL,
  `amount` double(15,2) DEFAULT NULL,
  `is_paid` bit(1) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Branch`
--

CREATE TABLE `Branch` (
  `branch_id` int(11) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `fax` varchar(12) DEFAULT NULL,
  `manager_name` varchar(255) DEFAULT NULL,
  `opening_date` date DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ChargePlan`
--

CREATE TABLE `ChargePlan` (
  `opt` varchar(255) NOT NULL DEFAULT '',
  `lim` INT DEFAULT NULL,
  `charge` double(15,2) DEFAULT NULL,
  `additional_charge` double(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Checking`
--

CREATE TABLE `Checking` (
  `account_number` int(11) NOT NULL DEFAULT '0',
  `opt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `client_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `is_notified` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Credit`
--

CREATE TABLE `Credit` (
  `account_number` int(11) NOT NULL DEFAULT '0',
  `credit_limit` double(15,2) DEFAULT NULL,
  `minimal_payment` double(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Employee`
--

CREATE TABLE `Employee` (
  `employee_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `salary` double(15,2) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `holidays` int(11) DEFAULT NULL,
  `sick_days` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ForeignCurrency`
--

CREATE TABLE `ForeignCurrency` (
  `account_number` int(11) NOT NULL DEFAULT '0',
  `currency_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Loan`
--

CREATE TABLE `Loan` (
  `account_number` int(11) NOT NULL DEFAULT '0',
  `loan_limit` double(15,2) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ReoccurringBills`
--

CREATE TABLE `ReoccurringBills` (
  `bill_id` int(11) NOT NULL DEFAULT '0',
  `reoccurrence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Savings`
--

CREATE TABLE `Savings` (
  `account_number` int(11) NOT NULL DEFAULT '0',
  `opt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Schedule`
--

CREATE TABLE `Schedule` (
  `employee_id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL DEFAULT '',
  `start_time` varchar(12) DEFAULT NULL,
  `end_time` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Service`
--

CREATE TABLE `Service` (
  `service_type` varchar(255) NOT NULL DEFAULT '',
  `manager_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Transaction`
--

CREATE TABLE `Transaction` (
  `transaction_number` int(11) NOT NULL,
  `account_number` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` double(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

-- Index pour la table `Account`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`admin_id`),

--
-- Index pour la table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`account_number`),
  ADD KEY `service_type` (`service_type`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `Bills`
--
ALTER TABLE `Bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `Branch`
--
ALTER TABLE `Branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Index pour la table `ChargePlan`
--
ALTER TABLE `ChargePlan`
  ADD PRIMARY KEY (`opt`);

--
-- Index pour la table `Checking`
--
ALTER TABLE `Checking`
  ADD PRIMARY KEY (`account_number`),
  ADD KEY `opt` (`opt`);

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Index pour la table `Credit`
--
ALTER TABLE `Credit`
  ADD PRIMARY KEY (`account_number`);

--
-- Index pour la table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Index pour la table `ForeignCurrency`
--
ALTER TABLE `ForeignCurrency`
  ADD PRIMARY KEY (`account_number`);

--
-- Index pour la table `Loan`
--
ALTER TABLE `Loan`
  ADD PRIMARY KEY (`account_number`);

--
-- Index pour la table `ReoccurringBills`
--
ALTER TABLE `ReoccurringBills`
  ADD PRIMARY KEY (`bill_id`);

--
-- Index pour la table `Savings`
--
ALTER TABLE `Savings`
  ADD PRIMARY KEY (`account_number`),
  ADD KEY `opt` (`opt`);

--
-- Index pour la table `Schedule`
--
ALTER TABLE `Schedule`
  ADD PRIMARY KEY (`employee_id`,`day`);

--
-- Index pour la table `Service`
--
ALTER TABLE `Service`
  ADD PRIMARY KEY (`service_type`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Index pour la table `Transaction`
--
ALTER TABLE `Transaction`
  ADD PRIMARY KEY (`transaction_number`),
  ADD KEY `account_number` (`account_number`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Account`
--
ALTER TABLE `Account`
  MODIFY `account_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Bills`
--
ALTER TABLE `Bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Branch`
--
ALTER TABLE `Branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Client`
--
ALTER TABLE `Client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Schedule`
--
ALTER TABLE `Schedule`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Transaction`
--
ALTER TABLE `Transaction`
  MODIFY `transaction_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Account`
--
ALTER TABLE `Account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`service_type`) REFERENCES `Service` (`service_type`),
  ADD CONSTRAINT `account_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `Client` (`client_id`);

--
-- Contraintes pour la table `Bills`
--
ALTER TABLE `Bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `Client` (`client_id`);

--
-- Contraintes pour la table `Checking`
--
ALTER TABLE `Checking`
  ADD CONSTRAINT `checking_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `Account` (`account_number`),
  ADD CONSTRAINT `checking_ibfk_2` FOREIGN KEY (`opt`) REFERENCES `ChargePlan` (`opt`);

--
-- Contraintes pour la table `Client`
--
ALTER TABLE `Client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `Branch` (`branch_id`);

--
-- Contraintes pour la table `Credit`
--
ALTER TABLE `Credit`
  ADD CONSTRAINT `credit_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `Account` (`account_number`);

--
-- Contraintes pour la table `Employee`
--
ALTER TABLE `Employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `Branch` (`branch_id`);

--
-- Contraintes pour la table `ForeignCurrency`
--
ALTER TABLE `ForeignCurrency`
  ADD CONSTRAINT `foreigncurrency_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `Account` (`account_number`);

--
-- Contraintes pour la table `Loan`
--
ALTER TABLE `Loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `Account` (`account_number`);

--
-- Contraintes pour la table `ReoccurringBills`
--
ALTER TABLE `ReoccurringBills`
  ADD CONSTRAINT `reoccurringbills_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `Bills` (`bill_id`);

--
-- Contraintes pour la table `Savings`
--
ALTER TABLE `Savings`
  ADD CONSTRAINT `savings_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `Account` (`account_number`),
  ADD CONSTRAINT `savings_ibfk_2` FOREIGN KEY (`opt`) REFERENCES `ChargePlan` (`opt`);

--
-- Contraintes pour la table `Schedule`
--
ALTER TABLE `Schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `Employee` (`employee_id`);

--
-- Contraintes pour la table `Service`
--
ALTER TABLE `Service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `Employee` (`employee_id`);

--
-- Contraintes pour la table `Transaction`
--
ALTER TABLE `Transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `Account` (`account_number`);
