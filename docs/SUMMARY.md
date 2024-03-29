Summary

* [Introduction and Overview](README.md)
* [Server Setup and Installation](installation.md)
  * [Architecture](installation.md#architecture)
  * [Server Setup](installation.md#server-setup)
      * [Pre-requisites](installation.md#pre-requisites)
          * [Aurora](installation.md#aurora-database)
          * [Amazon Elastic Container Repository](installation.md#amazon-elastic-container-repository)
          * [Athena](installation.md#athena-database)
          * [SQS Queue](installation.md#sqs-queue)
          * [SNS Topics](installation.md#sns-application-topic)
          * [Secret for Configuration Information](installation.md#secret-for-configuration-information)
          * [Application Load Balancer with HTTPS](installation.md#application-load-balancer-with-https)
      * [Docker on EC2 Instance](installation.md#docker-on-ec2-instance)
      * [Docker on ECS with EC2 Capability](installation.md#ecs-cluster-with-ec2-launch-compatibility)
      * [Docker on ECS with Fargate Capability](installation.md#ecs-cluster-with-faragate-launch-compatibility)
      * [Deployment via CloudFormation](installation.md#deployment-via-cloud-formation)
      * [Manual Installation on EC2](installation.md#manual-installation-on-ec2-instance)
  * [Application Installation](installation.md#application-installation)
  * [Post Install Configuration](installation.md#post-install-configuration)
* [Features and Workflows](features-and-workflows.md)
   * [Deployment Options](features-and-workflows.md#deployment-options)
   * [Directory Structure](features-and-workflows.md#directory-structure)
   * [Dashboard](features-and-workflows.md#dashbord)
   * [Notifications](features-and-workflows.md#notifications)
* [Setup](features-and-workflows.md#setup)
   * [Accounts](features-and-workflows.md#account-management)
   * [Users](features-and-workflows.md#user-management)
   * [Reset Data](features-and-workflows.md#reset-data)
* [User and Account Management](features-and-workflows.md#user-and-account-management)
   * [User Roles](features-and-workflows.md#user-roles)
   * [Hierarchy of User Roles](features-and-workflows.md#hierarchy-of-user-roles)
   * [User Access Restrictions](features-and-workflows.md#user-access-restrictions)
   * [Login and Access Control](features-and-workflows.md#login-and-access-control)
   * [Account Management](features-and-workflows.md#account-management)
   * [User Management](features-and-workflows.md#user-management)
   * [Change User Password](features-and-workflows.md#change-user-password)
   * [Update User Profile](features-and-workflows.md#update-user-profile-information)
* [Command Logging](features-and-workflows.md#command-logging)
* [Hadoop](features-and-workflows.md#hadoop)
   * [Create a new Hadoop Configuration](features-and-workflows.md#create-a-new-hadoop-configuration)
   * [Start a Hadoop Configuration](features-and-workflows.md#start-a-hadoop-configuration)
   * [Stop a Hadoop Configuration](features-and-workflows.md#stop-a-hadoop-configuration)
* [Database](features-and-workflows.md#database)
* [File Management](features-and-workflows.md#file-management)
   * [Template](features-and-workflows.md#template)
     * [Create User Text Template](features-and-workflows.md#create-user-text-template)
     * [Create Core Text Template](features-and-workflows.md#create-core-text-template)
     * [Create User Parquet Template](features-and-workflows.md#create-user-parquet-template)
     * [Create Core Parquet Template](features-and-workflows.md#create-core-parquet-template)
     * [Sync Template](features-and-workflows.md#sync-template)
   * [Upload](features-and-workflows.md#upload)
     * [Upload File to Text Template](features-and-workflows.md#upload-file-to-text-template)
     * [Upload File to Parquet Template](features-and-workflows.md#upload-file-to-parquet-template)
     * [Copy File to Shared Folder](features-and-workflows.md#copy-file-to-shared-folder)
     * [Delete File](features-and-workflows.md#delete-file)
     * [Recover Deleted File](features-and-workflows.md#recover-deleted-file)
   * [Watcher](features-and-workflows.md#watcher)
     * [Create Watcher](features-and-workflows.md#create-watcher)
     * [Run Watcher Interactively](features-and-workflows.md#run-watcher-interactively)
     * [Run Watcher in Background](features-and-workflows.md#run-watcher-in-background)
     * [Delete Watcher](features-and-workflows.md#delete-watcher)
   * [Model](features-and-workflows.md#model)
     * [Create Model](features-and-workflows.md#create-model)
     * [Run Model Interactively](features-and-workflows.md#run-model-interactively)
     * [Run Model in Background](features-and-workflows.md#run-model-in-background)
     * [Delete Model](features-and-workflows.md#delete-model)
* [Timesheet](features-and-workflows.md#timesheet)
   * [Projects](features-and-workflows.md#projects)
   * [Rates](features-and-workflows.md#rates)
   * [Timesheet Tasks](features-and-workflows.md#timesheet-tasks)
   * [Assignment](features-and-workflows.md#assignment)
   * [Submission](features-and-workflows.md#submission)
* [Tasks](features-and-workflows.md#tasks)
    * [Categories](features-and-workflows.md#categories)
    * [Task Queue](features-and-workflows.md#task-queue)
    * [Task Template](features-and-workflows.md#task-template)
* [Activity](features-and-workflows.md#activity)
   * [Current](features-and-workflows.md#current)
   * [History](features-and-workflows.md#history)
* [Reports](features-and-workflows.md#reports)
   * [Queries](features-and-workflows.md#queries)