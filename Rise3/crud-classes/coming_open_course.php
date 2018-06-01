<?php
require_once "pdo.php";
session_start();


?>

<p>coming open courses for this month</p>
<form method="post">

<p>which month
<input type="text" name="month">
</p>

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


/*
$stmt=$pdo->query("
SELECT 
class_id
FROM classes
WHERE 

MONTH(
start_date
)>5 
AND
MONTH(
open1
)>6
AND 
YEAR(
graduate_date
)< 2019

"); */

while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	
	///print $row
	//var_dump($row);
	
	//$type=gettype($row);
	//echo "<br>$type";///print type of $row
	//echo"<br>";
	
	$class_id=htmlentities($row['class_id']);
	
	
	foreach($row as $value){
		$type=gettype($value);//type of $value 
		//
		///print dates
			if ( strpos($value,'-') != false  ) { // === or != false
        //echo "$type : $value<br>";
		//
			$month_position=strpos($value,'-');
		//echo "$month_position<br>"; // will print 4
			$month_in_row=substr($value,$month_position+1,2);//($string_to_be_sub, start, length)
		//
			//echo "$month_in_row<br>";
		//
		//
			if($month_in_row==$input_month){
			
			echo "class_id: $class_id<br>";
			echo "$value<br>";
			}
		//
		}
	}
	
	echo"<br>";
}

}

?>

