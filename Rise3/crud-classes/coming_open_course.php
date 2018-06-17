<?php
require_once "pdo.php";
session_start();
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
	<p>which month
		<input type="text" name="month">
	</p>
	<p><input type="submit" value="Start Queue"/>
</form>

<?php
	if(isset($_POST['month'])){
	$input_month=$_POST['month'];
	echo "input_month is : $input_month<br><br>";

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
	foreach($row as $value){
		$type=gettype($value);//type of $value 

		///print dates
		if ( strpos($value,'-') != false  ) { // === or != false
			$month_position=strpos($value,'-');
			$month_in_row=substr($value,$month_position+1,2);

			if($month_in_row==$input_month){
				//
				$class_counter++;
				//
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

				var_dump($value);
				echo "<br>";
				//
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
				echo("<td>");
				echo(htmlentities($row['start_date']));
				echo("</td>");
				//
				//
				echo("<td>");
				echo(htmlentities($row['open1']));
				echo("</td>");
				//
				//
				//
				echo("<td>");
				echo(htmlentities($row['open2']));
				echo("</td>");
				//
				//
				echo("<td>");
				echo(htmlentities($row['open3']));
				echo("</td>");
				//
				echo("<td>");
				echo(htmlentities($row['graduate_date']));
				echo("</td>");
				//echo "class_id: $class_id<br>";
				//echo "$value<br><br>";
				echo "</tr>";
			}

			//echo "<br>$class_counter<br>";
		}
	}
}
//echo"<br>";
}
?>
</table>