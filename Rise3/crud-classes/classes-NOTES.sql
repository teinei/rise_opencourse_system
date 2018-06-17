// error message
Fatal error: Uncaught PDOException: SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`rise`.`classes`, CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`d_teacher`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE) in C:\MAMP\htdocs\Rise3\crud-classes\add.php:47 Stack trace: #0 C:\MAMP\htdocs\Rise3\crud-classes\add.php(47): PDOStatement->execute(Array) #1 {main} thrown in C:\MAMP\htdocs\Rise3\crud-classes\add.php on line 47
//

ALTER TABLE
classes 
DROP FOREIGN KEY 
d_teacher


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

git commands
//
echo "# rise_opencourse_system" >> README.md
git init
git add README.md
git commit -m "first commit"
git remote add origin https://github.com/teinei/rise_opencourse_system.git
git push -u origin master
//

git remote set-url origin https://teinei:gh103104@github.com/teinei/rise_opencourse_system.git
//change github url

AUTO_INCREMENT KEY

# delete table classes
DROP TABLE IF EXISTS
classes;

# create table classes
CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT KEY,
  `class_stage` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `class_number` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `d_teacher` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `co_teacher` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `open1` date DEFAULT NULL,
  `open2` date DEFAULT NULL,
  `open3` date DEFAULT NULL,
  `graduate_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- temp data
$class_id=htmlentities($row['class_id']);
$class_number=htmlentities($row['class_id']);
$class_counter=0;
$main_teacher=htmlentities($row['d_teacher']);
$co_tea=htmlentities($row['co_teacher']);
$start_date=htmlentities($row['start_date']);
$open1=htmlentities($row['open1']);
$open2=htmlentities($row['open2']);
$open3=htmlentities($row['open3']);
$graduate_date=htmlentities($row['graduate_date']);