<?php
require_once "pdo.php";
session_start();
//
//
$red_date=0;
//
$input_begin_year=2017;
$input_begin_month=1;
$input_begin_day=1;
//
$input_end_year=2020;
$input_end_month=1;
$input_end_day=1;
//
if(isset($_POST['begin_year'])){
	$input_begin_year=$_POST['begin_year'];
}
if(isset($_POST['begin_month'])){
	$input_begin_month=$_POST['begin_month'];
}
if(isset($_POST['begin_day'])){
	$input_begin_day=$_POST['begin_day'];
}
//
$input_begin_date=$input_begin_year."-".
	$input_begin_month."-".$input_begin_day;
//echo "$input_begin_date";
//
if(isset($_POST['end_year'])){
	$input_end_year=$_POST['end_year'];
}
if(isset($_POST['end_month'])){
	$input_end_month=$_POST['end_month'];
}
if(isset($_POST['end_day'])){
	$input_end_day=$_POST['end_day'];
}
//
$input_end_date=$input_end_year."-".
	$input_end_month."-".$input_end_day;
//
//
$sum_id=0;
$open_date=0;
$class_name=0;
$main_teacher=0;
$co_teacher=0;
$average=0;
$text1=0;
$text2=0;
$text3=0;
?>
<html>
<head>
<meta content="text/html; charset=utf-8">
</head>
<body>
<a href="../crud-surveys/index.php">back to surveys index</a><br>
<br>
<form method="post">
<?php
/*
	<p>
	begin: 
	year
		<input type="text" name="begin_year"
		value="<?= $_POST['begin_year'] ?>">
	month
		<input type="text" name="begin_month"
		value="<?= $_POST['begin_month'] ?>">
	day
		<input type="text" name="begin_day"
		value="<?= $_POST['begin_day'] ?>">
	</p>
	<p>
	end: 
	year
		<input type="text" name="end_year"
		value="<?= $_POST['end_year'] ?>">
	month
		<input type="text" name="end_month"
		value="<?= $_POST['end_month'] ?>">
	day
		<input type="text" name="end_day"
		value="<?= $_POST['end_day'] ?>">
	</p>
	<p><input type="submit" value="Start Queue"/>
</form>
*/
?>
	<p>
	begin: 
	year
		<input type="text" name="begin_year" size="4"
		value="<?=$input_begin_year?>">
	month
		<input type="text" name="begin_month" size="2"
		value="<?= $input_begin_month ?>">
	day
		<input type="text" name="begin_day" size="2"
		value="<?= $input_begin_day ?>">
	</p>
	<p>
	end: 
	year
		<input type="text" name="end_year" size="4"
		value="<?= $input_end_year ?>">
	month
		<input type="text" name="end_month" size="2"
		value="<?= $input_end_month ?>">
	day
		<input type="text" name="end_day" size="2"
		value="<?= $input_end_day ?>">
	</p>
	<p><input type="submit" value="Start Queue"/>
</form>
<table border="1" width="850">
	<tr>
	<td>sum_id</td>
	<td>class_name</td>
	<td>open_date</td>
	<td>main_teacher</td> <td>co_teacher</td> 
	<td>average</td>
	<td> text1</td><td>text2</td><td>text3</td>
	<td></td>
	</tr>
<?php
$stmt = $pdo->query("SELECT 
	sum_id,
	open_date,
	class_name,
	main_teacher,co_teacher,
	average,
	text1,text2,text3
	FROM
	survey_sum
");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	//echo "<br>";
	//var_dump($row);
	//	
	$sum_id=htmlentities($row['sum_id']);
	//
	$open_date=$row['open_date'];
	//
	$class_name=$row['class_name'];
	$main_teacher=$row['main_teacher'];
	$co_teacher=$row['co_teacher'];
	$average=$row['average'];
	$text1=$row['text1'];
	$text2=$row['text2'];
	$text3=$row['text3'];
	//
	echo "open_date: $open_date<br>";
	$begin_flag=$open_date<=$input_begin_date;
	echo "$open_date<=$input_begin_date".":"."$begin_flag<br>";
	//echo "$begin_flag";
	$end_flag=$open_date>=$input_end_date;
	echo "$open_date>=$input_end_date".":"."$end_flag<br>";
	var_dump($end_flag);
	echo "$end_flag";
	$date_flag=$begin_flag && $end_flag;
	echo "";
	echo "";
	//echo '$open_date>=$input_begin_date || $open_date<=$input_end_date:';
	var_dump($date_flag);
	echo "$date_flag<br>";
	//
	if($date_flag){
		//
		echo ("<tr><td>");//row start
		echo "$sum_id";
		echo("</td>");
		//		
		echo("<td>");
		echo "$class_name";//alter key name
		echo("</td>");
		//
		echo("<td>");
		echo "$open_date";//alter key name
		echo("</td>");
		//
		echo("<td>");
		echo "$main_teacher";
		echo("</td>");
		
		echo("<td>");
		echo "$co_teacher";
		echo("</td>");
		//
		echo("<td>");
		echo "$average";
		echo("</td>");
		
		echo("<td>");
		echo "$text1";
		echo("</td>");
		
		echo("<td>");
		echo "$text2";
		echo("</td>");
		//
		echo("<td>");
		echo "$text3";
		echo("</td>");
	
		echo("<td>");
		echo('<a href="edit.php?sum_id='.$sum_id.'">Edit</a> / ');
		echo('<a href="delete.php?sum_id='.$sum_id.'">Delete</a>');
		echo("</td></tr>\n");
	}
	//
}
?>
</table>