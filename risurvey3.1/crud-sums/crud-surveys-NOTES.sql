To get started run the following SQL commands:

CREATE DATABASE misc;
GRANT ALL ON misc.* TO 'fred'@'localhost' IDENTIFIED BY 'zap';
GRANT ALL ON misc.* TO 'fred'@'127.0.0.1' IDENTIFIED BY 'zap';

GRANT ALL ON rise.* TO 'fred'@'localhost' IDENTIFIED BY 'zap';
GRANT ALL ON rise.* TO 'fred'@'127.0.0.1' IDENTIFIED BY 'zap';

USE misc; (Or select misc in phpMyAdmin)

CREATE TABLE users (
   user_id INTEGER NOT NULL
     AUTO_INCREMENT KEY,
   name VARCHAR(128),
   email VARCHAR(128),
   password VARCHAR(128),
   INDEX(email)
) ENGINE=InnoDB CHARSET=utf8;

ALTER TABLE
surveys
ADD COLUMN
q11	VARCHAR(128)
AFTER
q5

--create new db survey_sum
CREATE TABLE survey_sum (
   sum_id INTEGER NOT NULL
     AUTO_INCREMENT KEY,
   open_date DATE, 
   class_name VARCHAR(128),
   main_teacher VARCHAR(128),
   co_teacher VARCHAR(128),
   average FLOAT,
   text1 TEXT,
   text2 TEXT,
   text3 TEXT,
   INDEX(class_name)
) ENGINE=InnoDB CHARSET=utf8;

