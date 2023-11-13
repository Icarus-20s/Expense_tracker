
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- Database: `expense_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense_category_tbl`
--

CREATE TABLE `expense_category_tbl` (
  `expense_category_id` int(11) UNSIGNED NOT NULL,
  `expense_category_name` varchar(200) NOT NULL,
  `amount` decimal(10,0) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `ID` int(10) NOT NULL,
  `FullName` varchar(150) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `expense_tbl`
--

CREATE TABLE `expense_tbl` (
  `expense_id` int(11) UNSIGNED NOT NULL,
  `expense_category_id` int(11) UNSIGNED NOT NULL,
  `expense_description` varchar(200) NOT NULL,
  `expense_date` date NOT NULL,
  `deleted` int(1) UNSIGNED NOT NULL,
  `created_at` date NOT NULL,
  `amount_spent` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables

--
ALTER TABLE `expense_category_tbl`
  ADD PRIMARY KEY (`expense_category_id`),
  ADD UNIQUE KEY `expense_category_name` (`expense_category_name`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `expense_tbl`
--
ALTER TABLE `expense_tbl`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `FK_cat_id` (`expense_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expense_category_tbl`
--
ALTER TABLE `expense_category_tbl`
  MODIFY `expense_category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expense_tbl`
--
ALTER TABLE `expense_tbl`
  MODIFY `expense_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables

--
ALTER TABLE `expense_tbl`
  ADD CONSTRAINT `FK_cat_id` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_category_tbl` (`expense_category_id`);

ALTER TABLE `user`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;