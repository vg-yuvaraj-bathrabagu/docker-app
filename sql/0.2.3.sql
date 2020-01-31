/** Renamed to hadoop_status **/
DROP TABLE IF EXISTS `EMRStatus`;

--
-- Table structure for table `hadoop_status`
--

DROP TABLE IF EXISTS `hadoop_status`;
CREATE TABLE IF NOT EXISTS `hadoop_status` (
  `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
  `module` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` mediumtext NOT NULL,
  `category` varchar(200) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `ts_begin` datetime NOT NULL,
  `nodes` int(11) NOT NULL,
  `uuid` char(38) NOT NULL,
  UNIQUE KEY `unique_hadoop_status_uuid` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `mpp_status`
--
DROP TABLE IF EXISTS `mpp_status`;
CREATE TABLE IF NOT EXISTS `mpp_status` (
  `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
  `module` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` mediumtext NOT NULL,
  `category` varchar(200) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `ts_begin` datetime NOT NULL,
  `nodes` int(11) NOT NULL,
  `uuid` char(38) NOT NULL,
  UNIQUE KEY `unique_mpp_status_uuid` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/** Added new columns **/
DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification`(
  id int auto_increment primary key,
  `action` mediumtext NOT NULL,
  `user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  category varchar(255) NULL,
  start_time timestamp default CURRENT_TIMESTAMP not null,
  end_time timestamp,
  status int null,
  output mediumtext null,
  process_id int null,
  account_id int null,
  user_id int null,
  datecreated timestamp default CURRENT_TIMESTAMP not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;