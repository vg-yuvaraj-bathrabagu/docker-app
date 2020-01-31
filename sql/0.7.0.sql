/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


--
-- Add a file_upload_location field to the user account
--
ALTER TABLE `app_user` ADD COLUMN `file_upload_location` VARCHAR(10) NOT NULL DEFAULT 'UserHome';
--
-- Nexus Module
--
-- roles
--
REPLACE INTO `role`(`name`) VALUES ('ROLE_NEXUS_ADMIN'), ('ROLE_NEXUS_ANALYSIS'), ('ROLE_NEXUS_FILE_UPLOAD'), ('ROLE_NEXUS_REPORT'), ('ROLE_ACTIVITY_CURRENT'), ('ROLE_ACTIVITY_HISTORY');

DROP TABLE IF EXISTS `state`;
CREATE TABLE `state` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `accountid` BIGINT(20) NOT NULL DEFAULT 1,
  `code` char(2) NOT NULL,
  `name` varchar(64) NOT NULL,
  createdby                BIGINT       NOT NULL,
  datecreated              DATETIME,
  lastupdatedby            BIGINT,
  lastupdatedate           DATETIME,
  PRIMARY KEY (`id`),
  UNIQUE KEY `state_code_account` (`accountid`, `code`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `code`, `accountid`) VALUES (1,'AL','Alabama'),(2,'AK','Alaska'),(3,'AS','American Samoa'),(4,'AZ','Arizona'),(5,'AR','Arkansas'),(6,'CA','California'),(7,'CO','Colorado'),(8,'CT','Connecticut'),(9,'DE','Delaware'),(10,'DC','District of Columbia'),(11,'FM','Federated States of Micronesia'),(12,'FL','Florida'),(13,'GA','Georgia'),(14,'GU','Guam'),(15,'HI','Hawaii'),(16,'ID','Idaho'),(17,'IL','Illinois'),(18,'IN','Indiana'),(19,'IA','Iowa'),(20,'KS','Kansas'),(21,'KY','Kentucky'),(22,'LA','Louisiana'),(23,'ME','Maine'),(24,'MH','Marshall Islands'),(25,'MD','Maryland'),(26,'MA','Massachusetts'),(27,'MI','Michigan'),(28,'MN','Minnesota'),(29,'MS','Mississippi'),(30,'MO','Missouri'),(31,'MT','Montana'),(32,'NE','Nebraska'),(33,'NV','Nevada'),(34,'NH','New Hampshire'),(35,'NJ','New Jersey'),(36,'NM','New Mexico'),(37,'NY','New York'),(38,'NC','North Carolina'),(39,'ND','North Dakota'),(40,'MP','Northern Mariana Islands'),(41,'OH','Ohio'),(42,'OK','Oklahoma'),(43,'OR','Oregon'),(44,'PW','Palau'),(45,'PA','Pennsylvania'),(46,'PR','Puerto Rico'),(47,'RI','Rhode Island'),(48,'SC','South Carolina'),(49,'SD','South Dakota'),(50,'TN','Tennessee'),(51,'TX','Texas'),(52,'UT','Utah'),(53,'VT','Vermont'),(54,'VI','Virgin Islands'),(55,'VA','Virginia'),(56,'WA','Washington'),(57,'WV','West Virginia'),(58,'WI','Wisconsin'),(59,'WY','Wyoming');

--
-- Sample companies and users
--
REPLACE INTO account (`id`, `name`, `description`, `uuid`, `dashboard_url`) VALUES (3, 'Northrop', 'Demo account with access to Timesheet and Task Queue', '9da7561d-97b9-41aa-8efd-a165182b4a77', ''), (4, 'Walmart', 'Demo account with access to nexus module and Task queue', '589a7492-7361-4791-b9b2-d72287b25df8', 'https://app.powerbi.com/view?r=eyJrIjoiNTcwMTI1NWUtNjcyZS00MTU4LWFiYWEtZDA4MDgxMTNiMWU3IiwidCI6ImM3ZGZjNTk1LWU4OWUtNDQ4Ni1iNGM0LWI0NmRhZmFjMmU5NSIsImMiOjF9');

REPLACE INTO app_user (`id`, credential_nickname, credential_password, password_reset_token, password_requested_at, account_id, employeetemplateid, salutation, firstname, middlename, lastname, initials, gender, jobtitle, blccode, jobcategory, department, joblocation, employeetype, rateperhour, account, credential_email, personalemailaddress, uuid, snstopic, usertype, employeecategory, onvacation, mobilenumber, homephone, tsgbadgenumber, officeline1, officeline2, faxnumber, address1, address2, stateorprovince, postalcode, country, city, companyname, companyaddress, ssn, ein, birthdate, hiredate, employeestartdate, employeeenddate, releasedate, lastreviewdate, nextreviewdate, supervisorname, supervisoremail, supervisorofficeline, approver, approveremail, invoiceapprover, invoiceapproveremail, businessmeetingapprover, businessmeetingapproveremail, travelexpenseapprover, travelexpenseapproveremail, odcapprover, odcapproveremail, billsapprover, billsapproveremail, payrollfrequency, paycode, regularrate, regularratecode, maximumregularhours, overtimeallowed, overtimerate, overtimeratecode, maximumovertimehoursperday, maximumhoursperday, maximumhoursperweek, maximumovertimehours, vacationdaysallowed, maximumsocialsecurity, maximumvacationdays, personaldaysallowed, maximumpersonaldays, paidholidaysallowed, maximumpaidholidays, sickdaysallowed, maximumsickdays, saturdayworkallowed, sundayworkallowed, publicholidayworkallowed, employeebenefitsbillable, invoicecategory, employeejobs, status, createdby, datecreated, changedpassword, lastupdatedby, lastupdatedate, securityquestion, answer, disabledaily, passwordexpirydate, canviewemployeeresources, canviewpublicholidays, canviewpayrolldates, canviewtravelpolicy, canview401kinformation, canviewreferenceinformation, ec1_firstname, ec1_lastname, ec1_streetaddress, ec1_city, ec1_state, ec1_zipcode, ec1_homephone, ec1_workphone, ec1_cellphone, ec1_relationship, ec2_firstname, ec2_lastname, ec2_streetaddress, ec2_city, ec2_state, ec2_zipcode, ec2_homephone, ec2_workphone, ec2_cellphone, ec2_relationship, ec3_firstname, ec3_lastname, ec3_streetaddress, ec3_city, ec3_state, ec3_zipcode, ec3_homephone, ec3_workphone, ec3_cellphone, ec3_relationship, permissiontemplate, categoryuser, uniqueid, week_start, hourly_wage, photo, file_upload_location) VALUES (6, 'northrop-admin-ecf570f6-d7fd-4c54-8946-c3ec56b169ad', '$2y$13$2A.mwmtd1brc07i5W3e16Ol42keJ1ATtxmkf3KcCc16jZ9OGlBCp6', null, null, 3, null, '', 'Admin', '', 'Northorp', '', null, '', 'NP12345', '', '', '', '', '', '', 'northorp.admin@oncloudtime.com', '', 'ecf570f6-d7fd-4c54-8946-c3ec56b169ad', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 0.00, null, 8.0, 'N', null, null, null, 0, 0, null, 'N', null, null, 'N', null, 'N', null, 'N', null, 'N', 'N', 'N', 'N', null, null, null, 1, '2019-04-27 10:00:34', 'N', null, null, null, null, 'N', null, 'N', 'N', 'N', 'N', 'N', 'N', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 'HRMS', null, '', '', 'None', 'UserHome'),(7, 'northrop-user-c67d1c88-0613-4890-89d6-f90879e96c87', '$2y$13$2A.mwmtd1brc07i5W3e16Ol42keJ1ATtxmkf3KcCc16jZ9OGlBCp6', null, null, 3, null, '', 'User', '', 'Northorp', '', null, '', 'NP1234', '', '', '', '', '', '', 'northorp.user@oncloudtime.com', '', 'c67d1c88-0613-4890-89d6-f90879e96c87', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 0.00, null, 8.0, 'N', null, null, null, 0, 0, null, 'N', null, null, 'N', null, 'N', null, 'N', null, 'N', 'N', 'N', 'N', null, null, null, 1, '2019-04-27 10:00:34', 'N', null, null, null, null, 'N', null, 'N', 'N', 'N', 'N', 'N', 'N', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 'HRMS', null, '', '', 'None', 'UserHome'),(8, 'walmart-admin-01965cce-f45e-496c-8364-87998b2ff3bc', '$2y$13$2A.mwmtd1brc07i5W3e16Ol42keJ1ATtxmkf3KcCc16jZ9OGlBCp6', null, null, 4, null, '', 'Admin', '', 'Walmart', '', null, '', 'WL12345', '', '', '', '', '', '', 'walmart.admin@oncloudtime.com', '', '01965cce-f45e-496c-8364-87998b2ff3bc', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 0.00, null, 8.0, 'N', null, null, null, 0, 0, null, 'N', null, null, 'N', null, 'N', null, 'N', null, 'N', 'N', 'N', 'N', null, null, null, 1, '2019-04-27 10:00:34', 'N', null, null, null, null, 'N', null, 'N', 'N', 'N', 'N', 'N', 'N', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 'HRMS', null, '', '', 'None', 'Shared'),(9, 'walmart-user-c31558bb-4215-4dd5-bc88-8f75e8716706', '$2y$13$2A.mwmtd1brc07i5W3e16Ol42keJ1ATtxmkf3KcCc16jZ9OGlBCp6', null, null, 4, null, '', 'User', '', 'Walmart', '', null, '', 'WL1234', '', '', '', '', '', '', 'walmart.user@oncloudtime.com', '', 'c31558bb-4215-4dd5-bc88-8f75e8716706', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 0.00, null, 8.0, 'N', null, null, null, 0, 0, null, 'N', null, null, 'N', null, 'N', null, 'N', null, 'N', 'N', 'N', 'N', null, null, null, 1, '2019-04-27 10:00:34', 'N', null, null, null, null, 'N', null, 'N', 'N', 'N', 'N', 'N', 'N', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 'HRMS', null, '', '', 'None', 'Shared');

--
-- User Roles
--
--
-- Sample data
--
REPLACE INTO `user_role`(`user_id`, `role_name`) VALUES (1, 'ROLE_TIMESHEET_SUBMISSION'), (6, 'ROLE_TASK'), (6, 'ROLE_TASK_QUEUE'), (6, 'ROLE_PROJECT'), (6, 'ROLE_TIMESHEET_ASSIGNMENT'), (6, 'ROLE_TIMESHEET_SUBMISSION'), (6, 'ROLE_TASK_TEMPLATE'), (6, 'ROLE_TASK_CATEGORY'),(6, 'ROLE_PROJECT_RATE'),(7, 'ROLE_TIMESHEET_SUBMISSION'), (7, 'ROLE_TASK_QUEUE'), (8, 'ROLE_TASK_TEMPLATE'), (8, 'ROLE_TASK_CATEGORY'),(8, 'ROLE_TASK_QUEUE');

--
-- Activities
--
REPLACE INTO `user_role`(`user_id`, `role_name`) VALUES (1, 'ROLE_ACTIVITY_CURRENT'), (1, 'ROLE_ACTIVITY_CURRENT'),(2, 'ROLE_ACTIVITY_CURRENT'), (2, 'ROLE_ACTIVITY_CURRENT'),(3, 'ROLE_ACTIVITY_CURRENT'), (3, 'ROLE_ACTIVITY_CURRENT'),(4, 'ROLE_ACTIVITY_CURRENT'), (4, 'ROLE_ACTIVITY_CURRENT'),(5, 'ROLE_ACTIVITY_CURRENT'), (5, 'ROLE_ACTIVITY_CURRENT'),(6, 'ROLE_ACTIVITY_CURRENT'), (6, 'ROLE_ACTIVITY_CURRENT'),(7, 'ROLE_ACTIVITY_CURRENT'), (7, 'ROLE_ACTIVITY_CURRENT'), (8, 'ROLE_ADMIN');
--
-- Nexus module roles
--
REPLACE INTO `user_role`(`user_id`, `role_name`) VALUES (1, 'ROLE_NEXUS_ADMIN'), (1, 'ROLE_NEXUS_FILE_UPLOAD'), (1, 'ROLE_NEXUS_REPORT'), (1, 'ROLE_NEXUS_ANALYSIS'), (2, 'ROLE_NEXUS_FILE_UPLOAD'), (2, 'ROLE_NEXUS_REPORT'),(3, 'ROLE_NEXUS_ADMIN'), (3, 'ROLE_NEXUS_ANALYSIS'),(3, 'ROLE_NEXUS_FILE_UPLOAD'), (3, 'ROLE_NEXUS_REPORT'),(4, 'ROLE_NEXUS_ANALYSIS'),(4, 'ROLE_NEXUS_FILE_UPLOAD'), (4, 'ROLE_NEXUS_REPORT'),(5, 'ROLE_NEXUS_ANALYSIS'), (5, 'ROLE_NEXUS_FILE_UPLOAD'), (5, 'ROLE_NEXUS_REPORT'),(8, 'ROLE_NEXUS_ADMIN'), (8, 'ROLE_NEXUS_ANALYSIS'), (8, 'ROLE_NEXUS_FILE_UPLOAD'), (8, 'ROLE_NEXUS_REPORT'),(9, 'ROLE_NEXUS_ANALYSIS'), (9, 'ROLE_NEXUS_FILE_UPLOAD'), (9, 'ROLE_NEXUS_REPORT'),(9, 'ROLE_NEXUS_ADMIN');

--
-- Table structure for table `state_guide`
--

DROP TABLE IF EXISTS `state_guide`;
CREATE TABLE `state_guide` (
   `id` bigint(20) NOT NULL AUTO_INCREMENT,
   `accountid` bigint(20) NOT NULL,
   `state` varchar(100) DEFAULT NULL,
   `code` char(2) NOT NULL,
   `effectivedate` varchar(100) DEFAULT NULL,
   `salestransactionsthreshold` int(11) DEFAULT NULL,
   `salesdollarsthreshold` decimal(10,2) DEFAULT NULL,
   `nearingtransactioncountthreshold` int(11) DEFAULT NULL,
   `nearingsalesthreshold` decimal(10,2) DEFAULT NULL,
   `createdby` bigint(20) NOT NULL,
   `datecreated` datetime NOT NULL,
   `lastupdatedby` bigint(20) DEFAULT NULL,
   `lastupdatedate` datetime DEFAULT NULL,
   `uuid` char(38) NOT NULL,
   PRIMARY KEY (`id`),
   UNIQUE KEY `state_guide_state_code_account` (`accountid`,`code`),
   UNIQUE KEY `state_guide_state_account` (`accountid`,`state`),
   KEY `idx_state_guide_state` (`state`),
   KEY `idx_state_guide_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state_guide`
--

INSERT INTO `state_guide` (`id`, `accountid`, `state`, `code`, `effectivedate`, `salestransactionsthreshold`, `salesdollarsthreshold`, `nearingtransactioncountthreshold`, `nearingsalesthreshold`, `createdby`, `datecreated`, `lastupdatedby`, `lastupdatedate`, `uuid`) VALUES (1,1,'Alabama','AL','2018-10-01',NULL,250000.00,NULL,200000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341ef54-69d7-11e9-bcc6-1fa5dd6563c1'),(2,1,'Alaska','AK',NULL,NULL,NULL,NULL,NULL,1,'2019-04-27 19:50:15',NULL,NULL,'f341f5b2-69d7-11e9-bcc6-1fa5dd6563c1'),(3,1,'Arizona','AZ',NULL,200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341f652-69d7-11e9-bcc6-1fa5dd6563c1'),(4,1,'Arkansas','AR',NULL,200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341f6ca-69d7-11e9-bcc6-1fa5dd6563c1'),(5,1,'California','CA','2019-04-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341f72e-69d7-11e9-bcc6-1fa5dd6563c1'),(6,1,'Colorado','CO','2018-12-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341f792-69d7-11e9-bcc6-1fa5dd6563c1'),(7,1,'Connecticut','CT','2018-12-01',200,250000.00,160,200000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341f800-69d7-11e9-bcc6-1fa5dd6563c1'),(8,1,'Delaware','DE',NULL,NULL,NULL,NULL,NULL,1,'2019-04-27 19:50:15',NULL,NULL,'f341f86e-69d7-11e9-bcc6-1fa5dd6563c1'),(9,1,'District of Columbia','DC','2019-01-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341f8d2-69d7-11e9-bcc6-1fa5dd6563c1'),(10,1,'Florida','FL','2019-07-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341f9a4-69d7-11e9-bcc6-1fa5dd6563c1'),(11,1,'Georgia','GA','2019-01-01',200,250000.00,160,200000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fa12-69d7-11e9-bcc6-1fa5dd6563c1'),(12,1,'Hawaii','HI','2018-07-01',NULL,10000.00,NULL,8000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fa76-69d7-11e9-bcc6-1fa5dd6563c1'),(13,1,'Idaho','ID','2018-07-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fada-69d7-11e9-bcc6-1fa5dd6563c1'),(14,1,'Illinois','IL','2018-10-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fb3e-69d7-11e9-bcc6-1fa5dd6563c1'),(15,1,'Indiana','IN','2018-10-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fba2-69d7-11e9-bcc6-1fa5dd6563c1'),(16,1,'Kansas','KS',NULL,NULL,NULL,NULL,NULL,1,'2019-04-27 19:50:15',NULL,NULL,'f341fc06-69d7-11e9-bcc6-1fa5dd6563c1'),(17,1,'Iowa','IA','2019-01-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fc6a-69d7-11e9-bcc6-1fa5dd6563c1'),(18,1,'Kentucky','KY','2018-10-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fcce-69d7-11e9-bcc6-1fa5dd6563c1'),(19,1,'Louisiana','LA','2019-01-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fd28-69d7-11e9-bcc6-1fa5dd6563c1'),(20,1,'Maine','ME','2018-07-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fda0-69d7-11e9-bcc6-1fa5dd6563c1'),(21,1,'Maryland','MD','2018-10-01',100,500000.00,80,400000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fddc-69d7-11e9-bcc6-1fa5dd6563c1'),(22,1,'Massachusetts','MA','2017-10-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fe18-69d7-11e9-bcc6-1fa5dd6563c1'),(23,1,'Michigan','MI','2018-10-01',100,100000.00,80,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fe5e-69d7-11e9-bcc6-1fa5dd6563c1'),(24,1,'Minnesota','MN','2018-10-01',NULL,NULL,NULL,NULL,1,'2019-04-27 19:50:15',NULL,NULL,'f341fe9a-69d7-11e9-bcc6-1fa5dd6563c1'),(25,1,'Mississippi','MS','2018-09-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341fed6-69d7-11e9-bcc6-1fa5dd6563c1'),(26,1,'Missouri','MO',NULL,NULL,NULL,NULL,NULL,1,'2019-04-27 19:50:15',NULL,NULL,'f341ff58-69d7-11e9-bcc6-1fa5dd6563c1'),(27,1,'Montana','MT',NULL,200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341ff9e-69d7-11e9-bcc6-1fa5dd6563c1'),(28,1,'Nebraska','NE','2019-01-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f341ffe4-69d7-11e9-bcc6-1fa5dd6563c1'),(29,1,'Nevada','NV','2018-10-01',NULL,NULL,NULL,NULL,1,'2019-04-27 19:50:15',NULL,NULL,'f3420020-69d7-11e9-bcc6-1fa5dd6563c1'),(30,1,'New Hampshire','NH',NULL,200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f34200c0-69d7-11e9-bcc6-1fa5dd6563c1'),(31,1,'New Mexico','NM',NULL,NULL,NULL,NULL,NULL,1,'2019-04-27 19:50:15',NULL,NULL,'f342021e-69d7-11e9-bcc6-1fa5dd6563c1'),(32,1,'New Jersey','NJ','2018-11-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f34202be-69d7-11e9-bcc6-1fa5dd6563c1'),(33,1,'New York','NY','2019-01-15',100,300000.00,80,240000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f3420340-69d7-11e9-bcc6-1fa5dd6563c1'),(34,1,'North Carolina','NC','2018-11-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f34203ae-69d7-11e9-bcc6-1fa5dd6563c1'),(35,1,'North Dakota','ND','2019-10-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f3420412-69d7-11e9-bcc6-1fa5dd6563c1'),(36,1,'Ohio','OH',NULL,NULL,100000.00,NULL,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f3420480-69d7-11e9-bcc6-1fa5dd6563c1'),(37,1,'Oregon','OR',NULL,NULL,NULL,NULL,NULL,1,'2019-04-27 19:50:15',NULL,NULL,'f34204e4-69d7-11e9-bcc6-1fa5dd6563c1'),(38,1,'Oklahoma','OK','2019-07-01',NULL,100000.00,NULL,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f3420552-69d7-11e9-bcc6-1fa5dd6563c1'),(39,1,'Pennsylvania','PA','2019-07-01',NULL,100000.00,NULL,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f34205ac-69d7-11e9-bcc6-1fa5dd6563c1'),(40,1,'Rhode Island','RI','2017-08-17',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f342061a-69d7-11e9-bcc6-1fa5dd6563c1'),(41,1,'South Carolina','SC','2018-11-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f3420688-69d7-11e9-bcc6-1fa5dd6563c1'),(42,1,'South Dakota','SD','2018-11-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f342076e-69d7-11e9-bcc6-1fa5dd6563c1'),(43,1,'Tennessee','TN',NULL,NULL,NULL,NULL,NULL,1,'2019-04-27 19:50:15',NULL,NULL,'f34207dc-69d7-11e9-bcc6-1fa5dd6563c1'),(44,1,'Texas','TX','2019-10-01',NULL,500000.00,NULL,400000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f342084a-69d7-11e9-bcc6-1fa5dd6563c1'),(45,1,'Utah','UT','2019-01-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f34208b8-69d7-11e9-bcc6-1fa5dd6563c1'),(46,1,'Vermont','VT','2018-07-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f3420976-69d7-11e9-bcc6-1fa5dd6563c1'),(47,1,'Virginia','VA',NULL,200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f34209da-69d7-11e9-bcc6-1fa5dd6563c1'),(48,1,'Washington','WA','2018-10-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f3420a48-69d7-11e9-bcc6-1fa5dd6563c1'),(49,1,'West Virginia','WV','2019-01-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f3420ab6-69d7-11e9-bcc6-1fa5dd6563c1'),(50,1,'Wisconsin','WI','2018-10-01',200,100000.00,160,80000.00,1,'2019-04-27 19:50:15',NULL,NULL,'f3420b1a-69d7-11e9-bcc6-1fa5dd6563c1');

--
--  Add nexus report to the account table
--
ALTER TABLE `account`
    ADD COLUMN `nexus_report_url` VARCHAR(1000) DEFAULT NULL;


/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;