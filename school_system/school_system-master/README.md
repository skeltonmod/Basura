## Thesis System for AMA CC

```diff
- Although this project is nearing completion, Bugs are still present
```

**How to use**
  * For XAMPP users
    1. go to C://xampp_directory/htdocs/
    2. paste the the folder
    3. open phpmyadmin
    4. create a database named "schooldb"
    5. Select the "schooldb" database
    6. Import the "schooldb.sql" file
  * For AMMPPS users
    * Same as Above but for steps 1 it's C://ammpps_directory/www
    * change the following lines [Here](https://github.com/SkeltonMod/school_system/blob/master/admin/server/db_config.php#L3-L4)
      to
      ```php
            $username = "root";
            $password = "mysql";
      ```
 **TO DO**
 - [x] 100% of the Core Features
 - [x] Image upload
 - [x] Ajax
 - [x] Most of the Essentials and QOL
 - [x] Delete Records
 - [x] Schedule
 - [x] Print ID
 - [x] Attendance
 - [x] Teacher Subsystem
 - [x] Student Subsystem
 - [x] User Accounts
 - [x] Proper Grading System (the current one only works for final grades)
 - [x] Sessions
