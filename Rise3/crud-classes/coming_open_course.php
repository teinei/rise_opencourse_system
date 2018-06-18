<?php
require_once "pdo.php";
session_start();
//
$red_date=0;
//
$input_begin_day=0;
$input_begin_month=0;
$input_begin_year=0;
$input_end_day=0;
$input_end_month=0;
$input_end_year=0;
//
$class_id;
$class_number;
$class_counter=0;
$main_teacher;
$co_tea;
$start_date;
$open1;
$open2;
$open3;
$graduate_date;
?>

<p>coming open courses for this month</p>
<form method="post">
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

<?php
	if(
	isset($_POST['begin_month'])&&
	isset($_POST['begin_day'])&&
	isset($_POST['begin_year'])&&
	isset($_POST['end_month'])&&
	isset($_POST['end_day'])&&
	isset($_POST['end_year'])
	){

	$input_begin_year=$_POST['begin_year'];
	echo "input_begin_year: $input_begin_year<br>";
	$input_begin_month=$_POST['begin_month'];
	echo "input_begin_month is : $input_begin_month<br>";
	$input_begin_day=$_POST['begin_day'];
	echo "input_begin_day is: $input_begin_day<br><br>";	
	//
	$input_end_year=$_POST['end_year'];
	echo "input_end_year: $input_end_year<br>";
	$input_end_month=$_POST['end_month'];
	echo "input_end_month is : $input_end_month<br>";
	$input_end_day=$_POST['end_day'];
	echo "input_end_day is: $input_end_day<br><br>";	

	$stmt = $pdo->query("
		SELECT 
	class_id,
	class_stage, class_number,
	d_teacher,co_teacher,
	start_date,
	open1,open2,open3,graduate_date
		FROM 
	classes
");
?>
<table border='1'>
	<tr>
		<td>class_counter</td>
		<td>class_number</td>
		<td>main teacher</td>
		<td>co teacher</td>
		<td>start_date</td>
		<td>open1</td>
		<td>open2</td>
		<td>open3</td>
		<td>graduate_date</td>
	</tr>
<?php
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {	
	$class_id=htmlentities($row['class_id']);
	//var_dump($row);
	//echo "<br>";
	foreach($row as $value){
		$type=gettype($value);//type of $value 

		///print dates
		if ( strpos($value,'-') != false  ) { // === or != false
			$month_position=strpos($value,'-');
			$month_in_row=substr($value,$month_position+1,2);
			//echo "month_position: $month_position<br>";
			$day_position=strpos($value,'-',$month_position+1);
			//echo "day_position: $day_position<br>";
			$day_in_row=substr($value,$day_position+1);
			//echo "day_in_row: $day_in_row<br><br>";
			$year_in_row=substr($value,0,4);
			//
			//
			$month_flag=
			$month_in_row==$input_begin_month ||
			$month_in_row==$input_end_month ||
			($month_in_row>$input_begin_month &&
			$month_in_row<$input_end_month)
			;	
			if($input_begin_month==$input_end_month){
				$day_flag=
				$day_in_row <= $input_end_day &&
				$day_in_row >=$input_begin_day;
			}elseif($input_begin_month<$input_end_month){
				$day_flag=
				($day_in_row>=$input_begin_day &&
				$month_in_row==$input_begin_month)
				||($month_in_row==$input_end_month &&
				$day_in_row<=$input_end_day);
				//echo "$day_flag<br>";
			}
			$year_flag=
			$year_in_row==$input_begin_year ||
			$year_in_row==$input_end_year;

			if($month_flag && $day_flag
			){				
				//
				
				//
				$red_date=$value;
				//imcrement class counter
				$class_id=htmlentities($row['class_id']);
				$class_number=htmlentities($row['class_id']);
				//$class_counter=0;
				$main_teacher=htmlentities($row['d_teacher']);
				$co_tea=htmlentities($row['co_teacher']);
				$start_date=htmlentities($row['start_date']);
				$open1=htmlentities($row['open1']);
				$open2=htmlentities($row['open2']);
				$open3=htmlentities($row['open3']);
				$graduate_date=htmlentities($row['graduate_date']);
				
				//echo "<td>$value</td>";

				//echo "var_dump(\$value): ";
				//var_dump($value);
				//echo "<br>";
				
				//
				if($start_date!=$red_date){
					$class_counter++;

					echo "<tr>";
					//
					echo("<td>");
					echo "$class_counter";
					echo("</td>");
					//
					echo("<td>");
					echo(htmlentities($row['class_number']));
					echo("</td>");
					//
					echo("<td>");
					echo(htmlentities($row['d_teacher']));
					echo("</td>");
					//
					echo("<td>");
					echo(htmlentities($row['co_teacher']));
					echo("</td>");
					//
					$month_position=strpos($value,'-');
					$month_in_row=substr($value,$month_position+1,2);
						//
					if($start_date==$red_date){
						echo "<td><font color='red'>";
					}else{
						echo("<td>");
					}
					echo(htmlentities($row['start_date']));
					echo("</font></td>");
					//
					//
					if($open1==$red_date){
						echo "<td><font color='red'>";
						//echo "red";
					}else{
						echo("<td>");
					}
					echo(htmlentities($row['open1']));
					echo("</font></td>");
					//
					//
					//
					if($open2==$red_date){
						echo "<td><font color='red'>";
					}else{
						echo("<td>");
					}
					echo(htmlentities($row['open2']));
					echo("</td>");
					//
					//
					if($open3==$red_date){
						echo "<td><font color='red'>";
					}else{
						echo("<td>");
					}
					echo(htmlentities($row['open3']));
					echo("</td>");
					//
					if($graduate_date==$red_date){
						echo "<td><font color='red'>";
					}else{
						echo("<td>");
					}
					echo(htmlentities($row['graduate_date']));
					echo("</td>");
					//echo "class_id: $class_id<br>";
					//echo "$value<br><br>";
					echo "</tr>";
				}
			}

			//echo "<br>$class_counter<br>";
		}
	}
}
//echo"<br>";
}
?>
</table>