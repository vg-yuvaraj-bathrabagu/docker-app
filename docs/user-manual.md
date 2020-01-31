# OnCloudTime User Manual

# Table of Contents

The purpose of this document is to highlight the architecture and design of the OnCloudtime application.

**TBD - specify user information used throughout the demo 

## Solution

## Architecture

The application runs on:

1. PHP 7.2
2. Symfony 4, following the default directory layout and best practices outlined at (https://symfony.com/doc/current/best_practices/index.html)
3. The database is MySQL 5.6
4. Command execution: 
   * All commands from the user interface are executed through backend shell scripts to provide fine grained control 
   * Data from the user interface is logged into a configured SQS queue with enough information for microservices to provide post-execution actions 
* Notifications are done via SNS topics at user, account and application level 

## Installation

1. Setup your webserver and virtual hosts 
2. Install MySQL, create a new database and run the new_install.sql script from the sql folder 
3. Run the http://domain/install script to setup the app which requires the following information: 
   * MySQL connection credentials - hostname, username, password and database name 
   * AWS Key and Secret 
   * S3 bucket 
   * Athena directory (for output) 
   * Athena database - must be pre-created 
   * SQS Queue URL for notifications
   * Application SNS Topic ARN 

## Deployment Scenarios

- Agency 
- Company
- AWS Application - TBD 

### Agency Deployment

- add steps 
  
  ### 
  
  ## User and Account Management
  
  ### Hierarchy of User Account Levels
  
  ### Login and Access Control
1. Each user requires an email address and password to access the application 
2. A user can only access their own data and shared data within the account to which they are tied 
3. A user can only access features depending on the roles assigned to them by the account administrator 

### User Restrictions

1. Each user is tied to one account 
2. A user can only see their data and any shared data by the account administrator 
3. An account administrator can see the data for all the users in the account, copy files into shared folders 

### Available Roles

### Create Account

This is done by the application super administrator.

1. The minimum information needed is: 
   * Name 
   * Description   
   * admin account email address and password 
   * Links to information displayed on the dashboard, current and historical activity pages 
2. When an account is created the following happens:
   * folder with account name is created in S3 at the path `s3://app-bucket/data/account-name/` 
   * The administrator account is created 
   * An SNS topic is created for the account to which all account users are subscribed.  
   
   ### Create User
   
   This is done  by the account administrator 
   
   1. The minimum information required for this is: 
      * First Name 
      * Last Name 
      * Email address (cannot be duplicated)
      * Roles granting access to different features within the application 
   2. When an account is created the following happens: 
      * A folder in the account directory, is created at the following path `s3://app-bucket/data/account-name/home/firstname-lastname-uuid`
      * An SNS topic is created for the user to receive notifications 
      * The user email address is subscribed to both the application and account SNS topics  

## Application Features

### Dashbord

Displays data specified by a link in the account configuration 

### Hadoop

A user can create and run Hadoop configurations 

### Database

A user can create and run MPP database configurations 

### File Management

#### Template

Templates are used to configure processing for collections of files 

When creating a template the following information is required: 

1. Name 
2. Format - Text, Parquet, ORC or JSON 
3. Delimiter - only comma is supported at this time 
4. Type - whether for a single user (User) or shared amongst users (Core)
5. Sample row - this is used for mapping the file data onto an external table created in Athena 
6. Mapping of columns to data types, conversions to be done

All the template information is aggregated into a JSON file describing the template.

#### Upload

When files are uploaded they are attached to templates that define how they are processed and transformed. 

1. Files uploaded to templates of text format are left unchanged while those uploaded to other formats are converted form text to the specific format 
2. Each file is uploaded to its own folder in a directory as follows:  `s3://app-bucket/data/account-name/home/firstname-lastname-uuid/intake/template/template-name/format/filename/`
3. For files uploaded to Core templates, these can be shared by users with administrative rights to a shared folder at `s3://app-bucket/data/account-name/shared/template/template-name/format/filename/`
4. Uploaded files can also be deleted where they are moved to the trash folder for example `s3://app-bucket/trash/account-name/home/firstname-lastname-uuid/intake/template/template-name/format/filename/`
   
   #### Watcher
   
   Provides the ability to run scripts
   
   #### Model
   
   Provides the ability to run scripts
   
   ### Activity
   
   These are reports whose content is defined at account level by external urls 
   
   ### Reports
   
   #### Tables
   
   Displays and allows searches for files uploaded to templates 
   
   #### Queries
   
   These are queries executed against the data to which the application has access with those having a type Athena are executed against tables in the Athena database defined at installaion. 

The queries can be run in interactive mode where a pop-up window opens and displays the output of the query, or in background mode with no visible output. 

## Data Reset

An administrator can reset the data in an account which deletes all defined data while maintaining the user accounts 
