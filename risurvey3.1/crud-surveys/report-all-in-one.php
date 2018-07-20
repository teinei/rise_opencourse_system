<?php
require_once "pdo.php";
require_once "report_oop.php";
session_start();
?>
<html>
<head>
	<meta content="text/html; charset=utf-8">
</head>
<body>	
	<h3>survey summary and report - All in One</h3>
<!-- ask for input_class -->	
	<form method="post">
		<p>which class
		<input type="text" name="class_number">
		</p>
		<input type="submit" value="Start Queue"/>
	</form>
	<a href="index.php">back</a>
	<br><br>
<?php //get input class from user
//$input_class_form='';
$input_class='';
if(isset($_POST['class_number'])){
    echo "class_number is set<br>";
	$input_class=$_POST['class_number'];
    //$input_class_form=$_POST['class_number'];
    //echo "input_class is : $input_class_form";
	echo "input_class is : $input_class";
}
	//
?>

<?php //report1 use oop
//
//echo "report1";
$report1 = new Report();
//$report1->$input_class=$input_class;
$report1->print_report1($input_class);
$report1->print_report2($input_class);
$report1->add_to_weekly_report_db($input_class);
?>

<?php
	
//}
//
?>
<br>
<hr>
<br>

<?php
/*

//var_dump($report3);
echo "<br><br>";
print_r($report3);

<span><b>report3: email</b></span>
<p>
<?= $class_number ?>第<?= $ordinal ?>次公开课，<br>
应出勤人数<?= $count ?>人，<br>
实际出勤<?= $count ?>人，<br>
<br>
<?= $q11s1 ?>人已续报，<br>
<?= $q11s2 ?>人会续报，<br>
<?= $q11s3 ?>人正在考虑，<br>
<?= $q11s4 ?>人不续报 <br>
</p>
</body>
</html>
*/
?>
<?php
//put sum data into survey_sum db

//if it is not exist, add new entry to db
//var_dump($row_pdo);

	
	

	


echo "<br><br>$input_class"."第"."$ordinal"."次公开课-"
."$open_date"."-"."$main_teacher"."-"."$co_teacher<br><br><br>";
?>