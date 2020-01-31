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
-- Add a role for each entity
--
INSERT INTO role (`name`) VALUES ('ROLE_SUPER_ADMIN'), ('ROLE_DELETE_USER_DATA'), ('ROLE_DELETE_SHARED_DATA'), ('ROLE_RECOVER_USER_DATA'), ('ROLE_RECOVER_SHARED_DATA'), ( 'ROLE_CONVERSIONS'), ('ROLE_FILE_WATCHER'), ( 'ROLE_MODEL'), ( 'ROLE_FILE_UPLOAD'), ('ROLE_HADOOP'), ('ROLE_DATABASE'), ('ROLE_TABLES'), ( 'ROLE_QUERIES'), ('ROLE_TEMPLATE');
--
-- Add the super-admin role to the admin, and make user id 3 an admin for that account
--
DELETE  FROM user_role;
ALTER TABLE user_role DROP FOREIGN KEY fk_user_role_user;
ALTER TABLE user_role
  ADD CONSTRAINT fk_user_role_user
FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
INSERT INTO user_role(`user_id`, `role_name`) VALUES (1, 'ROLE_SUPER_ADMIN'), (1, 'ROLE_DELETE_USER_DATA'), (1, 'ROLE_DELETE_SHARED_DATA'), (1, 'ROLE_RECOVER_USER_DATA'), (1, 'ROLE_RECOVER_SHARED_DATA'), (1, 'ROLE_CONVERSIONS'), (1, 'ROLE_FILE_WATCHER'), (1, 'ROLE_MODEL'), (1, 'ROLE_FILE_UPLOAD'), (1, 'ROLE_HADOOP'), (1, 'ROLE_DATABASE'), (1, 'ROLE_TABLES'), (1, 'ROLE_QUERIES'), (1, 'ROLE_TEMPLATE'), (2, 'ROLE_DELETE_USER_DATA'), (2, 'ROLE_DELETE_SHARED_DATA'), (2, 'ROLE_RECOVER_USER_DATA'), (2, 'ROLE_RECOVER_SHARED_DATA'), (2, 'ROLE_CONVERSIONS'), (2, 'ROLE_FILE_WATCHER'), (2, 'ROLE_MODEL'), (2, 'ROLE_FILE_UPLOAD'), (2, 'ROLE_HADOOP'), (2, 'ROLE_DATABASE'), (2, 'ROLE_TABLES'), (2, 'ROLE_QUERIES'), (2, 'ROLE_TEMPLATE'),(3, 'ROLE_DELETE_USER_DATA'), (3, 'ROLE_DELETE_SHARED_DATA'), (3, 'ROLE_RECOVER_USER_DATA'), (3, 'ROLE_RECOVER_SHARED_DATA'), (3, 'ROLE_CONVERSIONS'), (3, 'ROLE_FILE_WATCHER'), (3, 'ROLE_MODEL'), (3, 'ROLE_FILE_UPLOAD'), (3, 'ROLE_HADOOP'), (3, 'ROLE_DATABASE'), (3, 'ROLE_TABLES'), (3, 'ROLE_QUERIES'), (3, 'ROLE_TEMPLATE'),(3, 'ROLE_ADMIN'), (4, 'ROLE_DELETE_USER_DATA'), (4, 'ROLE_CONVERSIONS'), (4, 'ROLE_FILE_WATCHER'), (4, 'ROLE_MODEL'), (4, 'ROLE_FILE_UPLOAD'), (4, 'ROLE_HADOOP'), (4, 'ROLE_DATABASE'), (4, 'ROLE_TABLES'), (4, 'ROLE_QUERIES'), (4, 'ROLE_TEMPLATE'),(5, 'ROLE_DELETE_USER_DATA'), (5, 'ROLE_CONVERSIONS'), (5, 'ROLE_FILE_WATCHER'), (5, 'ROLE_MODEL'), (5, 'ROLE_FILE_UPLOAD'), (5, 'ROLE_HADOOP'), (5, 'ROLE_DATABASE'), (5, 'ROLE_TABLES'), (5, 'ROLE_QUERIES'), (5, 'ROLE_TEMPLATE'), (5, 'ROLE_USER');

--
-- Add accountid fields to tables that do not have
--
ALTER TABLE `hadoop_status` ADD COLUMN `accountid` BIGINT(20) NOT NULL;
ALTER TABLE `hadoop_status`
  ADD CONSTRAINT `fk_hadoop_status_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`);

ALTER TABLE `mpp_status` ADD COLUMN `accountid` BIGINT(20) NOT NULL;
ALTER TABLE `mpp_status`
  ADD CONSTRAINT `fk_mpp_status_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`);

ALTER TABLE `filewatcher` ADD COLUMN `accountid` BIGINT(20) NOT NULL;
ALTER TABLE `filewatcher`
  ADD CONSTRAINT `fk_filewatcher_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`);

ALTER TABLE `simulation` ADD COLUMN `accountid` BIGINT(20) NOT NULL;
ALTER TABLE `simulation`
  ADD CONSTRAINT `fk_simulation_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`);

ALTER TABLE `customreport` ADD COLUMN `accountid` BIGINT(20) NOT NULL;
ALTER TABLE `customreport`
  ADD CONSTRAINT `fk_customreport_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`);

ALTER TABLE `fileupload` ADD COLUMN `accountid` BIGINT(20) NOT NULL;
ALTER TABLE `fileupload`
  ADD CONSTRAINT `fk_fileupload_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`);

ALTER TABLE `template`
  DROP FOREIGN KEY `fk_template_account`;
ALTER TABLE `template` DROP INDEX `unique_template_name_for_account`;
ALTER TABLE `template` DROP COLUMN `account_id`;
ALTER TABLE `template` ADD COLUMN `accountid` BIGINT(20) NOT NULL;
ALTER TABLE `template`
  ADD CONSTRAINT `fk_template_account` FOREIGN KEY (`accountid`) REFERENCES account (`id`);
ALTER TABLE `template` ADD UNIQUE INDEX `unique_template_name_for_account` (`accountid`, `name`);

--
-- Add trash column to file upload
--
ALTER TABLE `fileupload`
  ADD COLUMN `trash` TINYINT(1) NOT NULL DEFAULT 0,
  MODIFY `name` VARCHAR(255) NOT NULL;

--
-- Add createdby for template
--
ALTER TABLE `template` ADD COLUMN `createdby` bigint(20) DEFAULT NULL;
ALTER TABLE `template` ADD COLUMN `simulationid` bigint(20) DEFAULT NULL;
ALTER TABLE `template`
  ADD CONSTRAINT `fk_template_createdby` FOREIGN KEY (`createdby`) REFERENCES app_user (`id`);

--
-- Add dashboard urls to the account
--
ALTER TABLE `account`
    ADD COLUMN `dashboard_url` VARCHAR(1000) DEFAULT NULL,
  ADD COLUMN `current_activity_url` VARCHAR(1000) DEFAULT NULL,
  ADD COLUMN `history_activity_url` VARCHAR(1000) DEFAULT NULL;

--
-- Add an ignore conversion
--
INSERT INTO conversion (id, name, description, type, url, parameters, datecreated, createdby, lastupdatedon, lastupdatedby, isactive, uuid)
VALUES (4, 'Ignore', null, '', '', null, '2018-09-10 11:34:33', 1, null, null, 1, '66bdc4e8-532f-4481-9093-b10906adea54');

--
-- Additional fields for File watcher
--
ALTER TABLE `filewatcher`
  ADD COLUMN `templateid` bigint(20) DEFAULT NULL,
  ADD COLUMN `simulationid` bigint(20) DEFAULT NULL,
  ADD COLUMN `schedule` mediumtext DEFAULT NULL,
  ADD COLUMN `securitypolicy` mediumtext DEFAULT NULL;

--
-- SNS topics
--
ALTER TABLE `account`
  ADD COLUMN `snstopic` VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE `app_user`
  ADD COLUMN `snstopic` VARCHAR(255) NOT NULL DEFAULT '';


/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;