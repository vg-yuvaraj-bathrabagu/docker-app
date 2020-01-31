/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;
--
-- Table structure for table `account`
--
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account`
(
  `id`   BIGINT(20) AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  UNIQUE INDEX account_name (`name`),
  `uuid` char(38) NOT NULL,
  UNIQUE KEY `unique_account_uuid` (`uuid`),
  PRIMARY KEY (`id`)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;

--
-- Dumping data for table `account`
--
INSERT INTO account (`id`, `name`, `uuid`) VALUES (1, 'Acme Corp', '336761a8-3122-4877-b04a-a4281be6f1dc'), (2, 'Rutrum Industries', 'dd8ec1e5-dd47-42af-be55-f53584753f8e');

--
-- Table structure for table `app_user`
--
DROP TABLE IF EXISTS `app_user`;
CREATE TABLE IF NOT EXISTS `app_user` (
  `id`                       BIGINT(20) AUTO_INCREMENT NOT NULL COMMENT '(DC2Type:msgphp_user_id)',
  `credential_nickname`      VARCHAR(255) NOT NULL,
  `credential_password`      VARCHAR(255) NOT NULL,
  `password_reset_token`     VARCHAR(255) DEFAULT NULL,
  `password_requested_at`    DATETIME     DEFAULT NULL,
  `account_id`          BIGINT(20) NOT NULL,
  `employeetemplateid` bigint(20) DEFAULT NULL,
  `salutation` varchar(25) DEFAULT '',
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `middlename` varchar(255) DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `initials` varchar(255) DEFAULT '',
  `gender` enum('Male','Female') DEFAULT NULL,
  `jobtitle` varchar(255) NOT NULL DEFAULT '',
  `blccode` varchar(255) DEFAULT '',
  `jobcategory` varchar(255) DEFAULT '',
  `department` varchar(255) DEFAULT '',
  `joblocation` varchar(255) DEFAULT '',
  `employeetype` varchar(10) DEFAULT '',
  `rateperhour` varchar(10) NOT NULL DEFAULT '',
  `account` varchar(10) NOT NULL DEFAULT '',
  `emailaddress` varchar(255) NOT NULL DEFAULT '',
  `personalemailaddress` varchar(255) DEFAULT '',
  `uuid` char(38) NOT NULL,
  UNIQUE INDEX app_user_credential_nickname(`credential_nickname`),
  UNIQUE KEY `unique_app_user_uuid` (`uuid`),
  PRIMARY KEY (`id`)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;

ALTER TABLE app_user
  ADD CONSTRAINT fk_app_user_account FOREIGN KEY (account_id) REFERENCES account (id);

--
-- Dumping data for table `app_user`
--
INSERT INTO `app_user` (`id`, `credential_nickname`,`credential_password`, `firstname`, `lastname`, `account_id`, `blccode`, `uuid`) VALUES (1, 'admin', '$2y$13$2A.mwmtd1brc07i5W3e16Ol42keJ1ATtxmkf3KcCc16jZ9OGlBCp6', 'System', 'Admin', 1, 'AB123', '3f35cde5-0f47-4c5f-bb59-31bbafcc9c64
'), (2, 'ATS002', '$2y$13$2A.mwmtd1brc07i5W3e16Ol42keJ1ATtxmkf3KcCc16jZ9OGlBCp6', 'John', 'Doe', 1, 'AB123', 'f1cc1e22-6fce-4ce1-88e1-faf704ecf123
'),(3, 'ATS003', '$2y$13$2A.mwmtd1brc07i5W3e16Ol42keJ1ATtxmkf3KcCc16jZ9OGlBCp6', 'Jean', 'Black', 2, 'CD789', '6eb865f7-d5d6-4f04-bf6d-4a0ee05a8081'),(4, 'ATS004', '$2y$13$2A.mwmtd1brc07i5W3e16Ol42keJ1ATtxmkf3KcCc16jZ9OGlBCp6', 'Frank', 'Morris', 2, 'CD789', '5df79a88-b73d-47c6-b482-eb681f3c9b4d'),
(5, 'fryawe', '$2y$13$K13evaPHxa.TBo0ORC8A\/eBHDUmUDVk7ovdElljO9rWRKDfmqBpTS', 'Fred','Yawe', 2, 'AFG89', 'bb1de4ca-e7ee-49e9-8096-f3fa45082e2b');

--
-- table structure for filewatcher
--
DROP TABLE IF EXISTS `filewatcher`;
CREATE TABLE IF NOT EXISTS `filewatcher` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `querystring` mediumtext NOT NULL,
  `category` varchar(200) NOT NULL,
  `bucket` varchar(255) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `createdby` bigint(20) DEFAULT NULL,
  `lastupdatedon` datetime DEFAULT NULL,
  `lastupdatedby` bigint(20) DEFAULT NULL,
  `issendemail` tinyint(1) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT NULL,
  `expirytype` varchar(255) DEFAULT NULL,
  `expirydate` varchar(255) DEFAULT NULL,
  `postpone` enum('N','Y') DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `color` VARCHAR(25) NOT NULL DEFAULT 'orange',
  `date` date DEFAULT NULL,
  `uuid` char(38) NOT NULL,
  UNIQUE KEY `unique_filewatcher_uuid` (`uuid`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `role`
--
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`name`)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;

--
-- Dumping data for table `role`
--
INSERT INTO `role` (`name`) VALUES ('ROLE_ADMIN'), ('ROLE_USER');
--
-- Table structure for table `user_role`
--
DROP TABLE IF EXISTS user_role;
CREATE TABLE IF NOT EXISTS user_role (
  user_id   BIGINT(20) NOT NULL COMMENT '(DC2Type:msgphp_user_id)',
  role_name VARCHAR(255) NOT NULL,
  INDEX idx_user_role_user_id (user_id),
  INDEX idx_user_role_role_name (role_name),
  PRIMARY KEY (user_id, role_name)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;

ALTER TABLE user_role
  ADD CONSTRAINT fk_user_role_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE;
ALTER TABLE user_role
  ADD CONSTRAINT fk_user_role_role FOREIGN KEY (role_name) REFERENCES role (name) ON DELETE CASCADE;

--
-- Dumping data for table `role`
--
INSERT INTO `user_role` (`user_id`, `role_name`) VALUES (1, 'ROLE_ADMIN'), (2, 'ROLE_USER'), (3, 'ROLE_USER'), (4, 'ROLE_USER');


--
-- table structure for simulation
--
DROP TABLE IF EXISTS `simulation`;
CREATE TABLE IF NOT EXISTS `simulation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `querystring` mediumtext NOT NULL,
  `category` varchar(200) NOT NULL,
  `bucket` varchar(255) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `createdby` bigint(20) DEFAULT NULL,
  `lastupdatedon` datetime DEFAULT NULL,
  `lastupdatedby` bigint(20) DEFAULT NULL,
  `issendemail` tinyint(1) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT NULL,
  `expirytype` varchar(255) DEFAULT NULL,
  `expirydate` varchar(255) DEFAULT NULL,
  `postpone` enum('N','Y') DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `color` VARCHAR(25) NOT NULL DEFAULT 'orange',
  `date` date DEFAULT NULL,
  `uuid` char(38) NOT NULL,
  UNIQUE KEY `unique_simulation_uuid` (`uuid`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for simulation
--


--
-- Table structure for table `template`
--
DROP TABLE IF EXISTS `template`;
CREATE TABLE IF NOT EXISTS `template` (
  `id`   BIGINT(20) AUTO_INCREMENT NOT NULL,
  `account_id`   BIGINT(20),
  `name` VARCHAR(255) NOT NULL,
  `format` VARCHAR(25) NOT NULL,
  `rules` mediumtext NULL,
  `samplerow` mediumtext NOT NULL,
  `creationtype` TINYINT(1),
  `delimiter` VARCHAR(25),
  `uuid` char(38) NOT NULL,
  datecreated timestamp default CURRENT_TIMESTAMP not null,
  UNIQUE INDEX unique_template_name_for_account (`account_id`,`name`),
  UNIQUE KEY `unique_template_uuid` (`uuid`),
  PRIMARY KEY (`id`)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;

ALTER TABLE template
  ADD CONSTRAINT fk_template_account FOREIGN KEY (account_id) REFERENCES template (id) ON DELETE CASCADE;

--
-- Dumping data for table `template`
--
INSERT INTO `template` (`id`, `account_id`, `name`, `format`, `rules`, `samplerow`, `creationtype`, `delimiter`, `uuid`)
    VALUES (1, 2, 'AWS-Invoice', 'CSV', '"name":"string","zip":"webservice://test.com"', 'name,zip\nJohn Doe,08898', 0, ',', '52044a5d-b053-48e8-9bf2-29e6a0a90b13'), (2, 2, 'AWS-Activity', 'CSV', '', '', 0, ',', '0f67727b-8bbc-4654-a1a2-4beac3c6b30f');

--
-- uuid for custom report
--
ALTER TABLE `customreport` ADD COLUMN `uuid` VARCHAR(38) NOT NULL;
--
-- Add the sample data for the uuid
--
UPDATE `customreport` SET `uuid` = UUID();
--
-- Add a unique index to the uuid column
--
ALTER TABLE `customreport`
  ADD COLUMN `status` VARCHAR(255) NOT NULL DEFAULT 'Pending',
  ADD COLUMN `color` VARCHAR(25) NOT NULL DEFAULT 'orange',
  ADD UNIQUE INDEX `unique_customreport_uuid` (`uuid`);



/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;
