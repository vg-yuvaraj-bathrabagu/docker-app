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
-- Sample data fix to ensure usernames match the conventions firstname-lastname-uuid
--
UPDATE `app_user` SET `credential_nickname` = CONCAT_WS("-", LOWER(firstname), LOWER(lastname), LOWER (uuid));
--
-- Timesheets Module
--
-- roles
--
REPLACE INTO `role`(`name`) VALUES ('ROLE_PROJECT'), ('ROLE_TASK'), ('ROLE_TIMESHEET_ASSIGNMENT'), ('ROLE_TIMESHEET_SUBMISSION'), ('ROLE_PROJECT_RATE'), ('ROLE_TASK_QUEUE'), ('ROLE_TASK_CATEGORY'), ('ROLE_TASK_TEMPLATE');

REPLACE INTO `user_role`(`user_id`, `role_name`) VALUES (1, 'ROLE_PROJECT'), (1, 'ROLE_TIMESHEET_ASSIGNMENT'), (1, 'ROLE_TASK'), (1, 'ROLE_TASK_QUEUE'), (1, 'ROLE_TASK_CATEGORY'), (1, 'ROLE_TASK_TEMPLATE'), (1, 'ROLE_PROJECT_RATE'), (2, 'ROLE_TIMESHEET_SUBMISSION'),(2, 'ROLE_TASK'), (2, 'ROLE_TASK_QUEUE'), (2, 'ROLE_TASK_CATEGORY'), (2, 'ROLE_TASK_TEMPLATE'),(3, 'ROLE_TASK'), (3, 'ROLE_TASK_QUEUE'), (3, 'ROLE_PROJECT'), (3, 'ROLE_TIMESHEET_ASSIGNMENT'), (3, 'ROLE_TIMESHEET_SUBMISSION'), (3, 'ROLE_TASK_TEMPLATE'), (3, 'ROLE_TASK_CATEGORY'),(3, 'ROLE_PROJECT_RATE'),(4, 'ROLE_TIMESHEET_SUBMISSION'), (4, 'ROLE_TASK_QUEUE');
--
-- Add structure and data for projects
--
DROP TABLE IF EXISTS `project`;

CREATE TABLE IF NOT EXISTS `project`
(
  `id`                       BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
  `effectivedate`            DATETIME,
  projectid                VARCHAR(50)  NOT NULL,
  title                    VARCHAR(50)  NOT NULL,
  projectcategory          VARCHAR(255),
  sponsor                  VARCHAR(255),
  projectexecutive         VARCHAR(255),
  projectmanager           VARCHAR(255),
  jobcode                  VARCHAR(255),
  costcentercode           VARCHAR(255) DEFAULT '',
  activity                 VARCHAR(255) DEFAULT '',
  laborpoline              VARCHAR(255) DEFAULT '',
  odcpoline                VARCHAR(255) DEFAULT '',
  travelpoline             VARCHAR(255) DEFAULT '',
  mailinglist              VARCHAR(255),
  priority                 VARCHAR(255),
  estimatedstartdate       DATE,
  estimatedenddate         DATE,
  actualstartdate          DATE,
  actualenddate            DATE,
  status                   VARCHAR(255),
  immediatesupervisorname  VARCHAR(255),
  immediatesupervisorphone VARCHAR(255),
  immediatesupervisoremail VARCHAR(255),
  supervisorname           VARCHAR(255),
  supervisorphone          VARCHAR(255),
  supervisoremail          VARCHAR(255),
  `budget` decimal(10,2) NOT NULL DEFAULT '0.00',
  notes                    TEXT,
  createdby                BIGINT       NOT NULL,
  datecreated              DATE,
  lastupdatedby            BIGINT,
  lastupdatedate           DATETIME,
  ponumber                 VARCHAR(10),
  taskcode                 VARCHAR(15),
  expirydate               DATETIME,
  currentflag              TINYINT(1),
  companyid                INT,
  `type`          VARCHAR(255) NOT NULL DEFAULT 'Waterfall',
  sprintcount                INT,
  sprintduration               INT,
  `builtin` TINYINT(1) NOT NULL DEFAULT 0,
  `uuid` char(38) NOT NULL,
  `accountid` BIGINT(20) NOT NULL,
  UNIQUE KEY `project_title_account` (`accountid`, `title`),
  KEY idx_project_currentflag (currentflag),
  KEY idx_project_projectcategory (projectcategory),
  KEY idx_project_projectid (projectid),
  KEY idx_project_title (title, jobcode),
  KEY idx_project_ponumber (ponumber),
  KEY idx_project_id (id),
  KEY idx_project_taskcode (taskcode)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `project`
  ADD CONSTRAINT `fk_project_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`);

--
-- PTO Project which includes Public Holiday, Vacation, Sick which are built in and cannot be deleted or removed
--
INSERT INTO `project` (`id`,`projectid`, `title`, `accountid`, `uuid`, `createdby`, `datecreated`, `builtin`) VALUES (1, 'Employee PTO', 'PTO', 1, UUID(), 1, NOW(), 1), (2, 'Employee PTO', 'PTO', 2, UUID(), 1, NOW(), 1);

--
-- Sample projects
--
INSERT INTO `project` (`id`, `projectid`, `title`, `accountid`, `uuid`, `createdby`, `datecreated`, `builtin`,  `budget`) VALUES (3, 'FDI Development', 'FDI-Dev', 2, UUID(), 1, NOW(), 0, 15000), (4, 'ACME ERP Rollout', 'ACMEERP', 2, UUID(), 1, NOW(),0, 50000);
--
-- Tasks
--

DROP TABLE IF EXISTS `task`;

CREATE TABLE IF NOT EXISTS `task` (
      `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
      `accountid` BIGINT(20) NOT NULL,
      `assigneeid` BIGINT(20),
      `projectid` BIGINT(20),
      `parentid` BIGINT(20),
      `startdate` datetime  NOT NULL,
      `enddate` datetime,
      `uuid` char(38) NOT NULL,
      `status` VARCHAR(255) NOT NULL DEFAULT 'Pending',
      `title` VARCHAR(255) NOT NULL,
      `istimesheettask` TINYINT(1) NOT NULL DEFAULT 0,
      createdby                BIGINT       NOT NULL,
      datecreated              DATETIME,
      lastupdatedby            BIGINT,
      lastupdatedate           DATETIME,
      UNIQUE KEY `task_title_account` (`accountid`, `title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `task`
  ADD CONSTRAINT `fk_task_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`),
  ADD CONSTRAINT `fk_task_assignee` FOREIGN KEY (`assigneeid`) REFERENCES app_user (`id`),
  ADD CONSTRAINT `fk_task_project` FOREIGN KEY (`projectid`) REFERENCES project (`id`),
  ADD CONSTRAINT `fk_task_parent` FOREIGN KEY (`parentid`) REFERENCES task (`id`),
  ADD CONSTRAINT `fk_task_creator` FOREIGN KEY (`createdby`) REFERENCES app_user (`id`),
  ADD CONSTRAINT `fk_task_updator` FOREIGN KEY (`lastupdatedby`) REFERENCES app_user (`id`);

--
-- Sample data
--

--
-- PTO project tasks - Public Holiday, Vacation, Sick which are built in but cannot be deleted or removed
--
insert into task (id, accountid, assigneeid, projectid, parentid, startdate, enddate, uuid, status, title, istimesheettask, createdby, datecreated, lastupdatedby, lastupdatedate) values (1, 2, null, 2, null, '2019-01-25 17:31:33', null, '0ef880be-20c7-11e9-bba0-19cdb72ebe32', 'Pending', 'Vacation', 1, 1, '2019-01-25 17:31:33', null, null);
insert into task (id, accountid, assigneeid, projectid, parentid, startdate, enddate, uuid, status, title, istimesheettask, createdby, datecreated, lastupdatedby, lastupdatedate) values (2, 2, null, 2, null, '2019-01-25 17:31:33', null, '0ef88528-20c7-11e9-bba0-19cdb72ebe32', 'Pending', 'Sick', 1, 1, '2019-01-25 17:31:33', null, null);
insert into task (id, accountid, assigneeid, projectid, parentid, startdate, enddate, uuid, status, title, istimesheettask, createdby, datecreated, lastupdatedby, lastupdatedate) values (3, 2, null, 2, null, '2019-01-25 17:31:33', null, '0ef88686-20c7-11e9-bba0-19cdb72ebe32', 'Pending', 'Public Holiday', 1, 1, '2019-01-25 17:31:33', null, null);
insert into task (id, accountid, assigneeid, projectid, parentid, startdate, enddate, uuid, status, title, istimesheettask, createdby, datecreated, lastupdatedby, lastupdatedate) values (4, 2, null, 4, null, '2019-01-25 17:31:33', null, '0ef8c6be-20c7-11e9-bba0-19cdb72ebe32', 'Pending', 'Default', 1, 1, '2019-01-25 17:31:33', null, null);
insert into task (id, accountid, assigneeid, projectid, parentid, startdate, enddate, uuid, status, title, istimesheettask, createdby, datecreated, lastupdatedby, lastupdatedate) values (5, 2, null, null, null, '2019-01-06 17:41:09', null, '1225982e-1e7b-11e9-a197-1cfda13112c7', 'Pending', 'PRESENTATION-LEGAL-PresentationTemplates', 2, 1, '2019-01-25 17:40:58', null, null);
insert into task (id, accountid, assigneeid, projectid, parentid, startdate, enddate, uuid, status, title, istimesheettask, createdby, datecreated, lastupdatedby, lastupdatedate) values (6, 2, 2, null, null, '2019-01-02 17:41:33', '2019-01-17 17:41:43', '1225982e-1e7b-11e9-a197-1cfda13112c8', 'Pending', 'Default General', 2, 1, '2019-01-25 17:42:11', null, null);
insert into task (id, accountid, assigneeid, projectid, parentid, startdate, enddate, uuid, status, title, istimesheettask, createdby, datecreated, lastupdatedby, lastupdatedate) values (7, 2, 3, null, null, '2019-01-02 17:41:33', '2019-01-17 17:41:43', '1225982e-1e7b-11e9-a197-1cfda13112c9', 'Pending', 'Testing Tasks', 2, 1, '2019-01-25 17:42:11', null, null);

--
-- Add structure and data for project assignments
--
DROP TABLE IF EXISTS project_assignment;

CREATE TABLE IF NOT EXISTS `project_assignment` (
  `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
  `userid` BIGINT(20) NOT NULL,
  `projectid` BIGINT(20),
  `taskid` BIGINT(20),
  `description` VARCHAR(255) NOT NULL DEFAULT '',
  `startdate` date  NOT NULL,
  `enddate` date,
  `saturdayworkallowed` TINYINT(1) NOT NULL DEFAULT 0,
  `sundayworkallowed` TINYINT(1) NOT NULL DEFAULT 0,
  `publicholidayworkallowed` TINYINT(1) NOT NULL DEFAULT 0,
  `overtimeallowed` TINYINT(1) NOT NULL DEFAULT 0,
  `maximumhoursperday` DECIMAL(2,1) NOT NULL DEFAULT 8.0,
  `maximumhoursperweek` DECIMAL(3,1) NOT NULL DEFAULT 40.0,
  `regularrate` decimal(10,2) NOT NULL DEFAULT '1.00',
  `overtimerate` decimal(10,2) NOT NULL DEFAULT '1.00',
  `approvername` VARCHAR(255) NOT NULL,
  `approveremail` VARCHAR(255) NOT NULL,
  `uuid` char(38) NOT NULL,
  `accountid` BIGINT(20) NOT NULL,
  `notes` VARCHAR(1000),
  createdby                BIGINT       NOT NULL,
  datecreated              DATE,
  lastupdatedby            BIGINT,
  lastupdatedate           DATETIME,
  UNIQUE KEY `project_assignment` (`userid`, `projectid`, `taskid`, `startdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `project_assignment`
  ADD CONSTRAINT `fk_project_assignment_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`),
  ADD CONSTRAINT `fk_project_assignment_project` FOREIGN KEY (`projectid`) REFERENCES project (`id`),
  ADD CONSTRAINT `fk_project_assignment_task` FOREIGN KEY (`taskid`) REFERENCES task (`id`),
  ADD CONSTRAINT `fk_project_assignment_user` FOREIGN KEY (`userid`) REFERENCES app_user (`id`);

--
-- Assign the built in PTO projects for each user
--
INSERT INTO `project_assignment` (`userid`, `projectid`, `startdate`, `uuid`, `accountid`) SELECT u.id as `userid`, t.id as `projectid`, u.datecreated, UUID(), u.account_id FROM app_user u, project t WHERE u.account_id = t.accountid;


--
-- Rates charged for projects
--
DROP TABLE IF EXISTS `projectrate`;

CREATE TABLE IF NOT EXISTS `projectrate` (
    `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
    `accountid` BIGINT(20) NOT NULL,
    `userid` BIGINT(20),
    `projectid` BIGINT(20),
    `startdate` datetime  NOT NULL,
    `enddate` datetime,
    `uuid` char(38) NOT NULL,
    `clientrate` decimal(10,2) NOT NULL DEFAULT '1.00',
    `contractorrate` decimal(10,2) NOT NULL DEFAULT '1.00',
    `agencyrate` decimal(10,2) NOT NULL DEFAULT '1.00',
    `overtimerate` decimal(10,2) NOT NULL DEFAULT '1.00',
    `premiumrate` decimal(10,2) NOT NULL DEFAULT '1.00',
    `doublerate` decimal(10,2) NOT NULL DEFAULT '1.00',
    `triplerate` decimal(10,2) NOT NULL DEFAULT '1.00',
    `dailyrate` decimal(10,2) NOT NULL DEFAULT '1.00',
    `weeklyrate` decimal(10,2) NOT NULL DEFAULT '1.00',
    `monthlyrate` decimal(10,2) NOT NULL DEFAULT '1.00',
    `notes` VARCHAR(1000),
    createdby                BIGINT(20)       NOT NULL,
    datecreated              DATETIME,
    lastupdatedby            BIGINT,
    lastupdatedate           DATETIME,
    UNIQUE KEY `projectrate_start` (`accountid`, `projectid`, `userid`, `startdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `projectrate`
  ADD CONSTRAINT `fk_projectrate_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`),
  ADD CONSTRAINT `fk_projectrate_user` FOREIGN KEY (`userid`) REFERENCES app_user (`id`),
  ADD CONSTRAINT `fk_projectrate_project` FOREIGN KEY (`projectid`) REFERENCES project (`id`),
  ADD CONSTRAINT `fk_projectrate_creator` FOREIGN KEY (`createdby`) REFERENCES app_user (`id`),
  ADD CONSTRAINT `fk_projectrate_updator` FOREIGN KEY (`lastupdatedby`) REFERENCES app_user (`id`);

--
-- Sample data
--
INSERT INTO projectrate(accountid, userid, projectid, startdate, enddate, uuid, createdby) SELECT accountid, userid, projectid, startdate, enddate, UUID(), createdby FROM project_assignment;

--
-- Add structure and data for timesheet submissions
--
DROP TABLE IF EXISTS `timesheet`;

CREATE TABLE IF NOT EXISTS `timesheet` (
  `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
  `userid` BIGINT(20) NOT NULL,
  `accountid` BIGINT(20) NOT NULL,
  `startdate` datetime  NOT NULL,
  `enddate` datetime  NOT NULL,
  `uuid` char(38) NOT NULL,
  `datecreated` DATETIME,
  `approved` TINYINT(1) NOT NULL DEFAULT 0,
  `approvaldate` DATETIME,
  `approvaldetails` VARCHAR(1000),
  `comments` mediumtext,
  UNIQUE KEY `timesheet` (`userid`, `startdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `timesheet`
  ADD CONSTRAINT `fk_timesheet_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`),
  ADD CONSTRAINT `fk_timesheet_user` FOREIGN KEY (`userid`) REFERENCES app_user (`id`);

DROP TABLE IF EXISTS `timesheet_detail`;

CREATE TABLE IF NOT EXISTS `timesheet_detail` (
  `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
  `userid` BIGINT(20) NOT NULL,
  `accountid` BIGINT(20) NOT NULL,
  `projectid` BIGINT(20) NOT NULL,
  `taskid` BIGINT(20) NOT NULL,
  `timesheetid` BIGINT(20) NOT NULL,
  `projectassignmentid` BIGINT(20) NOT NULL,
  `workday` date  NOT NULL,
  `hours` DECIMAL(2,1) NOT NULL,
  UNIQUE KEY `timesheet_detail` (`userid`, `taskid`, `timesheetid`, `workday`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `timesheet_detail`
  ADD CONSTRAINT `fk_timesheet_detail_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`),
  ADD CONSTRAINT `fk_timesheet_detail_project` FOREIGN KEY (`projectid`) REFERENCES project (`id`),
  ADD CONSTRAINT `fk_timesheet_detail_task` FOREIGN KEY (`taskid`) REFERENCES task (`id`),
  ADD CONSTRAINT `fk_timesheet_detail_project_assignment` FOREIGN KEY (`projectassignmentid`) REFERENCES project_assignment (`id`),
  ADD CONSTRAINT `fk_timesheet_detail_user` FOREIGN KEY (`userid`) REFERENCES app_user (`id`);

--
-- Task category
--

DROP TABLE IF EXISTS `taskcategory`;

CREATE TABLE IF NOT EXISTS `taskcategory` (
      `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
      `accountid` BIGINT(20) NOT NULL,
      `title` VARCHAR(255) NOT NULL ,
      `description` VARCHAR(1000),
      `uuid` char(38) NOT NULL,
      `datecreated` DATETIME,
      createdby                BIGINT       NOT NULL,
      lastupdatedby            BIGINT,
      lastupdatedate           DATETIME,
      UNIQUE KEY `task_category_title` (`accountid`, `title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sample data
--
INSERT INTO `taskcategory` (id, accountid, title, uuid, datecreated, createdby) VALUES(1, 2, 'CLIENT PRESENTATION', UUID(), NOW(), 1),  (2, 2, 'TECHSOFT GENERAL', UUID(), NOW(), 1), (3, 2, 'DEFAULT TASK', UUID(), NOW(), 1);

--
-- Companies
--
--
-- Task category
--

DROP TABLE IF EXISTS `taskidentifier`;

CREATE TABLE IF NOT EXISTS `taskidentifier` (
    `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
    `accountid` BIGINT(20) NOT NULL,
    `taskid` BIGINT(20) NOT NULL,
    `identifier` VARCHAR(255) NOT NULL ,
    `description` VARCHAR(1000),
    `uuid` char(38) NOT NULL,
    `datecreated` DATETIME,
    createdby                BIGINT       NOT NULL,
    lastupdatedby            BIGINT,
    lastupdatedate           DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--                                                                                     --
-- Task Queue
--

DROP TABLE IF EXISTS `taskqueue`;

CREATE TABLE IF NOT EXISTS `taskqueue` (
  `id` BIGINT(20) NOT NULL PRIMARY KEY ,
  `categoryid` BIGINT(20),
  `taskidenifierid` BIGINT(20)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `taskqueue`
  ADD CONSTRAINT `fk_taskqueue_task` FOREIGN KEY (`id`) REFERENCES task (`id`),
  ADD CONSTRAINT `fk_taskqueue_category` FOREIGN KEY (`categoryid`) REFERENCES taskcategory (`id`);

--
-- Sample data
-- 
insert into taskqueue (id, categoryid, taskidenifierid) values (5, 3, null);
insert into taskqueue (id, categoryid, taskidenifierid) values (6, 1, null);
insert into taskqueue (id, categoryid, taskidenifierid) values (7, 2, null);

--                                                                                     --
-- Task Template
--

DROP TABLE IF EXISTS `tasktemplate`;

CREATE TABLE IF NOT EXISTS `tasktemplate` (
     `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
     `accountid` BIGINT(20) NOT NULL,
     `name` VARCHAR(255) NOT NULL ,
     `code` VARCHAR(255) NOT NULL ,
     `notes` VARCHAR(1000),
     `uuid` char(38) NOT NULL,
     `datecreated` DATETIME,
     createdby                BIGINT       NOT NULL,
     lastupdatedby            BIGINT,
     lastupdatedate           DATETIME,
     UNIQUE KEY `task_template_name` (`accountid`, `name`),
     UNIQUE KEY `task_template_code` (`accountid`, `code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `tasktemplate`
  ADD CONSTRAINT `fk_tasktemplate_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`),
  ADD CONSTRAINT `fk_tasktemplate_createdby` FOREIGN KEY (`createdby`) REFERENCES app_user (`id`);


DROP TABLE IF EXISTS `tasktemplatedetail`;

CREATE TABLE IF NOT EXISTS `tasktemplatedetail` (
    `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
    `accountid` BIGINT(20) NOT NULL,
    `tasktemplateid` BIGINT(20) NOT NULL,
    `name` VARCHAR(255) NOT NULL ,
    `description` VARCHAR(1000) NOT NULL,
    `assigneeid` BIGINT(20),
    `duration` INT(20) NOT NULL DEFAULT 1,
    `notes` VARCHAR(1000),
    `uuid` char(38) NOT NULL,
    `datecreated` DATETIME,
    createdby                BIGINT       NOT NULL,
    lastupdatedby            BIGINT,
    lastupdatedate           DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;