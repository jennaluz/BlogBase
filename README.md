# BlogBase

BlogBase is a free article-publishing platform.

## Instructions

We are building BlogBase with XAMPP in mind. Other server stacks may work, but have not been tested and are therefore are not guaranteed to.

1. Clone the repository to the htdocs folder of your XAMPP installation.

    * MacOS


        ```
        git clone https://github.com/jennaluz/BlogBase.git /Applicaions/XAMPP/xampfiles/htdocs/BlogBase
        ```

    * Windows


        ```
        git clone https://github.com/jennaluz/BlogBase.git C:\xampp\htdocs\BlogBase
        ```
2. Import the database to your local database server.
    * phpmyadmin
    
        1. Ensure that both the MySQL Database Server and Apache Web Server are running
        2. Open a browser and navigate to `localhost/phpmyadmin/`
        3. On the left-hand side of the page, select "New" to create a new database
        4. Name the database "BlogBase" and create it
        5. On the left-hand side of the page, select "BlogBase"
        6. On the top of the page, select "Import"
        7. Select "Browse" and find the `BlogBase/database/BlogBase.sql` file on your computer
        8. Once you've selected the BlogBase.sql file, click import

You should now be able to access BlogBase by navigating to `localhost/blogbase/content/` in your browser!

* Note: In order to upload images through the webpage, you will need to change the permissions of the `uploads` directory. From the
  root of the project, run the following command:
  

      chmod -R 777 content/uploads


## Usage

The usernames of all included users can be found in the "Users" table of the BlogBase database. 

The password for each user is the concatenation of their first and last name. For example,

| username | password |
| -------- | -------- |
| chii_robinson | chiirobinson |
