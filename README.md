# TA Registration System

System used to manage TA applications and selection process

## Database Initialization

Files used for database initialzation are included in `resources\Database` Initialization

### Files
1. initializeDatabase.bat
2. database.sql

### Steps
1. log in to the database as root

```
mysql -u root -p
```

2. This brings you to the command shell. Next, create a new database called `tasql`.

```
CREATE DATABASE tasql;
```

3. Run `initializeDatabase.bat`. Make sure you change the absolute path in the .bat file if your path is differnt.

