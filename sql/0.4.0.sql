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
-- add datecreated for account
--
ALTER TABLE `account`
  ADD COLUMN `datecreated` datetime DEFAULT NULL,
  ADD COLUMN `description` varchar(255) DEFAULT NULL;

--
-- table structure for conversions
--
DROP TABLE IF EXISTS `conversion`;
CREATE TABLE IF NOT EXISTS `conversion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar (255) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `parameters` mediumtext DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `createdby` bigint(20) DEFAULT NULL,
  `lastupdatedon` datetime DEFAULT NULL,
  `lastupdatedby` bigint(20) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT NULL,
  `uuid` char(38) NOT NULL,
  UNIQUE KEY `unique_conversion_uuid` (`uuid`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sample data for conversions
--
INSERT INTO conversion (id, name, description, type, url, parameters, datecreated, createdby, lastupdatedon, lastupdatedby, isactive, uuid)
VALUES (1, 'None', null, '', '', null, '2018-06-30 11:34:33', 1, null, null, 1, '5a76f700-2b80-4262-af53-7b63b1cb4ed3'),
 (2, 'Date Conversion', null, 'Webservice', 'http://example.com/dateconversion', null, '2018-06-30 11:34:33', 1, null, null, 1, '4eb436f2-5910-449d-a115-acc64870f01f'),
 (3, 'ZipCode Lookup', null, 'WebService', 'http://example.com/zipcodelookup', null, '2018-06-30 11:35:45', 1, null, null, 1, '9f2b1dd1-5eef-4893-a414-746fee87f983');

--
-- Add sync column for Templates
--
ALTER TABLE `template`
  ADD COLUMN `color` varchar(25) NOT NULL DEFAULT '',
  ADD COLUMN `forsync` tinyint NOT NULL DEFAULT 0;

--
-- Add athena output column for the queries
--
ALTER TABLE `customreport`
  ADD COLUMN `athenaoutput` MEDIUMTEXT DEFAULT NULL;

--
-- Add the presigned urls for the folder of the differnet entities
--
ALTER TABLE template ADD COLUMN `bucketinput` varchar(255) NOT NULL,
                      ADD COLUMN `bucketoutput` varchar(255) NOT NULL,
                      ADD COLUMN `filecount` INT DEFAULT 0;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;