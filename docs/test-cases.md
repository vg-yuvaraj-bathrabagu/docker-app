# onclodutime Test Cases - Agency Deployment 

## Account Creation and User Management 
1. Create a new account 
    * Login as the application admin user and create an account 
    * Account details are displayed and SQS contains the details of the account creation 
2. Login using the email address and password for the account which is the account administrator 
3. Create a new non-administrator user account and make sure the account has ROLE_TEMPLATE, ROLE_FILE_UPLOAD and ROLE_QUERIES privileges to complete this flow 
4. Edit the details of the new user account - the changes should be reflected 



## Text - Template Creation and execution for User
1. Login as the non-administrator user account 
2. Create a new template selecting the Format "Text"
    - An external table with the tablename_u is created pointing to `s3://app-bucket/data/account-name/home/firstname-lastname-uuid/intake/template/template-name/Text/filename/`
    - A query pointing to the external table is created 
3. Run the query created by the template, it should return no values 
4.  Upload a file to the template 
5. Run the query created by the template, it should show values from the uploaded file 

## Text - Template Creation and execution for Core  
1. Login as administrator user
2. Create a template of type 'Core'
    * Two external tables are created: 
        - tablename with input directory `s3://app-bucket/data/account-name/shared/template/template-name/Text/filename/` 
        - tablename_u  with input directory `s3://app-bucket/data/account-name/home/firstname-lastname-uuid/intake/template/template-name/Text/filename/` 
    * This creates two queries one Core and the other user 
    * Run the queries and they both return no data 
3.  Upload a file 
    * Running the "User" query returns data 
    * Running the "Core" query returns no data
4.  Copy the uploaded file to the shared folder 
    * Running the "Core" query now returns data 

## Parquet/ORC/JSON - Template Creation and execution for User
1. Login as the non-administrator user account 
2. Create a new template selecting the Format "Text"
    - An external table with the tablename_u is created pointing to `s3://app-bucket/data/account-name/home/firstname-lastname-uuid/intake/template/template-name/format/filename/`  where format is Parquet, ORC or JSON
    - A query pointing to the external table is created 
3. Run the query created by the template, it should return no values 
4.  Upload a file to the template 
5. Run the query created by the template, it should show values from the uploaded file 

## Parquet/ORC/JSON - Template Creation and execution for Core  
1. Login as administrator user
2. Create a template of type 'Core'
    * Two external tables are created: 
        - tablename with input directory `s3://app-bucket/data/account-name/shared/template/template-name/format/filename/`
        - tablename_u  with input directory `s3://app-bucket/data/account-name/home/firstname-lastname-uuid/intake/template/template-name/format/filename/`  where format is Parquet, ORC or JSON
    * This creates two queries one Core and the other user 
    * Run the queries and they both return no data 
3.  Upload a file 
    * Running the "User" query returns data 
    * Running the "Core" query returns no data
4.  Copy the uploaded file to the shared folder 
    * Running the "Core" query now returns data 

## File Upload for Core Template
1.  Login as  user 
2.  Upload a file to the template - this will go into the users intake folder and not affect the query results 
3. Login in as an admin user for the account 
4. Share the file 
5. Running the "Core" query will include the results for the added file 

## Duplicate File Upload for Core Template
1.  Login as  user 
2.  Upload a file to a template 
3. Upload the same file to the template and an error will be returned stating that the file has already been uploaded to the template 

