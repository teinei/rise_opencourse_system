<?php
require_once "pdo.php";
session_start();
?>

<p>survey summary and report</p>
<form method="post">

<p>which class
<input type="text" name="class_number">
</p>

<p><input type="submit" value="Start Queue"/>

</form>


<?php
if(isset($_POST['class_number'])){
$input_class=$_POST['class_number'];
echo "input_class is : $input_class<br><br>";


$stmt = $pdo->query("
SELECT survey_id, 
average,q11, text1,text2,text3, 
student_name, class_number, d_teacher,
co_tea,open_date,ordinal 
FROM
surveys
WHERE
class_number==$input_class
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

