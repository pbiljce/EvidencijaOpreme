-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2020 at 04:01 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equipmentevidence`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `employeeequip_obligation` (IN `emp` INT, IN `equip` INT)  BEGIN
	DELETE FROM equipemployee WHERE employees_id = emp AND equipment_id = equip;
    UPDATE equipment SET equipstatus_id = 1 WHERE equipment.equipment_id = equip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `employee_organization` ()  BEGIN
DECLARE n INT DEFAULT 0;
DECLARE i INT DEFAULT 0;
SELECT COUNT(organization_id) FROM organization INTO n;
SET i = 1;
DELETE FROM employee_organization;
WHILE i <= n DO
	INSERT INTO employee_organization(organization, employees_number) SELECT o.organization,count(employees_id) FROM employees AS e
	INNER JOIN organization AS o ON o.organization_id = e.organization_id
	WHERE e.organization_id = i;
	SET i = i + 1;
END WHILE;
SELECT * FROM employee_organization;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `equipemployee_obligation` (IN `emp` INT, IN `equip` INT)  BEGIN
	INSERT INTO equipemployee(employees_id,equipment_id) VALUES (emp,equip);
    UPDATE equipment SET equipstatus_id = 2 WHERE equipment.equipment_id = equip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `equipment_type` ()  BEGIN
DECLARE n INT DEFAULT 0;
DECLARE i INT DEFAULT 0;
SELECT COUNT(equiptype_id) FROM equiptype INTO n;
SET i = 1;
DELETE FROM equipment_type;
WHILE i <= n DO
	INSERT INTO equipment_type(equiptype, equipment_number) SELECT et.equiptype,count(eq.equiptype_id) FROM equipment AS eq
    INNER JOIN equiptype AS et ON et.equiptype_id = eq.equiptype_id
	WHERE eq.equiptype_id = i;
	SET i = i + 1;
END WHILE;
SELECT * FROM equipment_type;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employees_id` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `datemodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `organization_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employees_id`, `firstname`, `lastname`, `email`, `phone`, `datecreated`, `datemodified`, `organization_id`, `office_id`) VALUES
(1, 'Mary', 'Smith', 'mary.smith@employee.org', '+545451118222', '2020-07-21 13:58:45', '2020-07-21 13:58:45', 1, 1),
(2, 'Patricia', 'Johnson', 'patricia.johnson@employee.org', '+656757333222', '2020-07-21 13:58:45', '2020-07-21 13:58:45', 1, 2),
(3, 'Linda', 'Williams', 'linda.williams@employee.org', '+699857333222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 2, 3),
(4, 'Marilyn', 'Simpson', 'marilyn.simpson@employee.org', '+545732688222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 3, 4),
(5, 'Patrik', 'Johnson', 'patrik.johnson@employee.org', '+656875963222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 4, 15),
(6, 'Luis', 'Davis', 'luis.davis@employee.org', '+6955667333222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 5, 5),
(7, 'Margaret', 'Moore', 'margaret.moore@employee.org', '+4587267333222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 6, 6),
(8, 'Dorothy', 'Taylor', 'dorothy.taylor@employee.org', '+2548667333222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 7, 14),
(9, 'Lisa', 'Anderson', 'lisa.anderson@employee.org', '+55555667333222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 8, 9),
(10, 'Nancy', 'Thomas', 'nancy.thomas@employee.org', '+3785667333222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 4, 7),
(11, 'Karen', 'Jackson', 'karen.jackson@employee.org', '+6556667333222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 4, 10),
(12, 'Betty', 'White', 'betty.white@employee.org', '+6955967333222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 8, 8),
(13, 'Helen', 'Harris', 'helen.harris@employee.org', '+6955627833222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 6, 12),
(14, 'Sandra', 'Martin', 'sandra.martin@employee.org', '+69556679653222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 7, 11),
(15, 'Donna', 'Thompson', 'donna.thompson@employee.org', '+6955667248222', '2020-07-21 13:58:46', '2020-07-21 13:58:46', 6, 13);

-- --------------------------------------------------------

--
-- Stand-in structure for view `employees_list`
-- (See below for the actual view)
--
CREATE TABLE `employees_list` (
`employees_id` int(11)
,`firstname` varchar(50)
,`lastname` varchar(50)
,`email` varchar(50)
,`phone` varchar(30)
,`office` varchar(30)
,`organization` varchar(200)
);

-- --------------------------------------------------------

--
-- Table structure for table `employee_organization`
--

CREATE TABLE `employee_organization` (
  `organization` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employees_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee_organization`
--

INSERT INTO `employee_organization` (`organization`, `employees_number`) VALUES
('Odsjek 1', 2),
('Odsjek 2', 1),
('Odsjek 3', 1),
('Odsjek 4', 3),
('Odsjek 5', 1),
('Odsjek 6', 3),
('Odsjek 7', 2),
('Odsjek 8', 2);

-- --------------------------------------------------------

--
-- Table structure for table `equipemployee`
--

CREATE TABLE `equipemployee` (
  `equipemployee_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `datemodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `equipemployee_list`
-- (See below for the actual view)
--
CREATE TABLE `equipemployee_list` (
`employees_id` int(11)
,`equipment_id` int(11)
,`firstname` varchar(50)
,`lastname` varchar(50)
,`equiptype` varchar(50)
,`equipproducer` varchar(50)
,`inventory` varchar(10)
,`serialnumber` varchar(30)
,`office` varchar(30)
,`office_id` int(11)
,`organization_id` int(11)
,`organization` varchar(200)
);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL,
  `inventory` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `serialnumber` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `datemodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `equiptype_id` int(11) NOT NULL,
  `equipproducer_id` int(11) NOT NULL,
  `equipstatus_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipment_id`, `inventory`, `serialnumber`, `datecreated`, `datemodified`, `equiptype_id`, `equipproducer_id`, `equipstatus_id`) VALUES
(1, '1000', 'A58HZT', '2020-07-21 13:58:45', '2020-07-21 13:58:45', 1, 1, 1),
(2, '1001', 'HG5677', '2020-07-21 13:58:45', '2020-07-21 13:58:45', 2, 2, 1),
(3, '1002', 'KJU879', '2020-07-21 13:58:45', '2020-07-21 13:58:45', 3, 3, 1),
(4, '1003', 'DFR444', '2020-07-21 13:58:45', '2020-07-21 13:58:45', 2, 2, 1),
(5, '1004', 'GFE345', '2020-07-21 13:58:45', '2020-07-21 13:58:45', 1, 3, 1),
(6, '1005', '876HZG', '2020-07-21 13:58:45', '2020-07-21 13:58:45', 4, 8, 1),
(7, '1006', '987JHG', '2020-07-21 13:58:45', '2020-07-21 13:58:45', 6, 1, 1),
(8, '1007', '543FFG', '2020-07-21 13:58:45', '2020-07-21 13:58:45', 6, 2, 1),
(9, '1008', '987NHG', '2020-07-21 13:58:45', '2020-07-21 13:58:45', 1, 4, 1),
(10, '1009', '763FGF', '2020-07-21 13:58:45', '2020-07-21 13:58:45', 3, 4, 1);

--
-- Triggers `equipment`
--
DELIMITER $$
CREATE TRIGGER `insert_status` BEFORE INSERT ON `equipment` FOR EACH ROW SET new.equipstatus_id = 1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `equipment_list`
-- (See below for the actual view)
--
CREATE TABLE `equipment_list` (
`equipment_id` int(11)
,`equiptype` varchar(50)
,`equipproducer` varchar(50)
,`inventory` varchar(10)
,`serialnumber` varchar(30)
,`equipstatus_id` int(11)
,`equipstatus` varchar(20)
,`firstname` varchar(50)
,`lastname` varchar(50)
,`datecreated` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `equipproducer`
--

CREATE TABLE `equipproducer` (
  `equipproducer_id` int(11) NOT NULL,
  `equipproducer` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `equipproducer`
--

INSERT INTO `equipproducer` (`equipproducer_id`, `equipproducer`) VALUES
(1, 'Hp'),
(2, 'Dell'),
(3, 'Acer'),
(4, 'Asus'),
(5, 'D-link'),
(6, 'Juniper'),
(7, 'Cisco'),
(8, 'Canon');

-- --------------------------------------------------------

--
-- Table structure for table `equipstatus`
--

CREATE TABLE `equipstatus` (
  `equipstatus_id` int(11) NOT NULL,
  `equipstatus` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `equipstatus`
--

INSERT INTO `equipstatus` (`equipstatus_id`, `equipstatus`) VALUES
(1, 'Slobodna'),
(2, 'Zadužena');

-- --------------------------------------------------------

--
-- Table structure for table `equiptype`
--

CREATE TABLE `equiptype` (
  `equiptype_id` int(11) NOT NULL,
  `equiptype` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `equiptype`
--

INSERT INTO `equiptype` (`equiptype_id`, `equiptype`) VALUES
(1, 'Laptop'),
(2, 'Kućište'),
(3, 'Monitor'),
(4, 'Štampač'),
(5, 'Skener'),
(6, 'Server'),
(7, 'Fajervol'),
(8, 'Svič');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `office_id` int(11) NOT NULL,
  `office` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`office_id`, `office`) VALUES
(1, '1001'),
(2, '1002'),
(3, '1003'),
(4, '1004'),
(5, '1005'),
(6, '1006'),
(7, '1007'),
(8, '1008'),
(9, '1009'),
(10, '1010'),
(11, '1011'),
(12, '1012'),
(13, '1013'),
(14, '1014'),
(15, '1015');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `organization_id` int(11) NOT NULL,
  `organization` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`organization_id`, `organization`) VALUES
(1, 'Odsjek 1'),
(2, 'Odsjek 2'),
(3, 'Odsjek 3'),
(4, 'Odsjek 4'),
(5, 'Odsjek 5'),
(6, 'Odsjek 6'),
(7, 'Odsjek 7'),
(8, 'Odsjek 8');

-- --------------------------------------------------------

--
-- Structure for view `employees_list`
--
DROP TABLE IF EXISTS `employees_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employees_list`  AS  select `emp`.`employees_id` AS `employees_id`,`emp`.`firstname` AS `firstname`,`emp`.`lastname` AS `lastname`,`emp`.`email` AS `email`,`emp`.`phone` AS `phone`,`off`.`office` AS `office`,`org`.`organization` AS `organization` from ((`employees` `emp` join `office` `off` on(`off`.`office_id` = `emp`.`office_id`)) join `organization` `org` on(`org`.`organization_id` = `emp`.`organization_id`)) order by `emp`.`organization_id` ;

-- --------------------------------------------------------

--
-- Structure for view `equipemployee_list`
--
DROP TABLE IF EXISTS `equipemployee_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `equipemployee_list`  AS  select `eqem`.`employees_id` AS `employees_id`,`eqem`.`equipment_id` AS `equipment_id`,`emp`.`firstname` AS `firstname`,`emp`.`lastname` AS `lastname`,`et`.`equiptype` AS `equiptype`,`ep`.`equipproducer` AS `equipproducer`,`eq`.`inventory` AS `inventory`,`eq`.`serialnumber` AS `serialnumber`,`off`.`office` AS `office`,`off`.`office_id` AS `office_id`,`org`.`organization_id` AS `organization_id`,`org`.`organization` AS `organization` from (((((((`equipemployee` `eqem` join `employees` `emp` on(`emp`.`employees_id` = `eqem`.`employees_id`)) join `equipment` `eq` on(`eq`.`equipment_id` = `eqem`.`equipment_id`)) join `equiptype` `et` on(`et`.`equiptype_id` = `eq`.`equiptype_id`)) join `equipproducer` `ep` on(`ep`.`equipproducer_id` = `eq`.`equipproducer_id`)) join `equipstatus` `es` on(`es`.`equipstatus_id` = `eq`.`equipstatus_id`)) join `office` `off` on(`off`.`office_id` = `emp`.`office_id`)) join `organization` `org` on(`org`.`organization_id` = `emp`.`organization_id`)) order by `eqem`.`equipemployee_id` ;

-- --------------------------------------------------------

--
-- Structure for view `equipment_list`
--
DROP TABLE IF EXISTS `equipment_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `equipment_list`  AS  select `eq`.`equipment_id` AS `equipment_id`,`et`.`equiptype` AS `equiptype`,`ep`.`equipproducer` AS `equipproducer`,`eq`.`inventory` AS `inventory`,`eq`.`serialnumber` AS `serialnumber`,`eq`.`equipstatus_id` AS `equipstatus_id`,`es`.`equipstatus` AS `equipstatus`,`emp`.`firstname` AS `firstname`,`emp`.`lastname` AS `lastname`,`eqemp`.`datecreated` AS `datecreated` from (((((`equipment` `eq` join `equiptype` `et` on(`et`.`equiptype_id` = `eq`.`equiptype_id`)) join `equipproducer` `ep` on(`ep`.`equipproducer_id` = `eq`.`equipproducer_id`)) join `equipstatus` `es` on(`es`.`equipstatus_id` = `eq`.`equipstatus_id`)) left join `equipemployee` `eqemp` on(`eq`.`equipment_id` = `eqemp`.`equipment_id`)) left join `employees` `emp` on(`emp`.`employees_id` = `eqemp`.`employees_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employees_id`),
  ADD KEY `fk_organization_employees` (`organization_id`),
  ADD KEY `fk_office_employees` (`office_id`);

--
-- Indexes for table `equipemployee`
--
ALTER TABLE `equipemployee`
  ADD PRIMARY KEY (`equipemployee_id`),
  ADD KEY `fk_employee_equipemployee` (`employees_id`),
  ADD KEY `fk_equipment_equipemployee` (`equipment_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`),
  ADD KEY `fk_equiptype_equipment` (`equiptype_id`),
  ADD KEY `fk_equipproducer_equipment` (`equipproducer_id`),
  ADD KEY `fk_equipstatus_equipment` (`equipstatus_id`);

--
-- Indexes for table `equipproducer`
--
ALTER TABLE `equipproducer`
  ADD PRIMARY KEY (`equipproducer_id`);

--
-- Indexes for table `equipstatus`
--
ALTER TABLE `equipstatus`
  ADD PRIMARY KEY (`equipstatus_id`);

--
-- Indexes for table `equiptype`
--
ALTER TABLE `equiptype`
  ADD PRIMARY KEY (`equiptype_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`organization_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employees_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `equipemployee`
--
ALTER TABLE `equipemployee`
  MODIFY `equipemployee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `equipproducer`
--
ALTER TABLE `equipproducer`
  MODIFY `equipproducer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `equipstatus`
--
ALTER TABLE `equipstatus`
  MODIFY `equipstatus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `equiptype`
--
ALTER TABLE `equiptype`
  MODIFY `equiptype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `organization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_office_employees` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_organization_employees` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`organization_id`) ON DELETE CASCADE;

--
-- Constraints for table `equipemployee`
--
ALTER TABLE `equipemployee`
  ADD CONSTRAINT `fk_employee_equipemployee` FOREIGN KEY (`employees_id`) REFERENCES `employees` (`employees_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_equipment_equipemployee` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`) ON DELETE CASCADE;

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `fk_equipproducer_equipment` FOREIGN KEY (`equipproducer_id`) REFERENCES `equipproducer` (`equipproducer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_equipstatus_equipment` FOREIGN KEY (`equipstatus_id`) REFERENCES `equipstatus` (`equipstatus_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_equiptype_equipment` FOREIGN KEY (`equiptype_id`) REFERENCES `equiptype` (`equiptype_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
