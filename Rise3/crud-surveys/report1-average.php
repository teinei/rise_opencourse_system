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
    echo "class_number is set<br>";
    $input_class=$_POST['class_number'];
    echo "input_class is : $input_class";
//
    //    $stmt = $pdo->query("
    //  buggy code: I use query rather than prepare

	//prepare select statement that has :placeholder
    $stmt = $pdo->prepare(" 
	SELECT survey_id, 
		student_name,
		q1, q2, q3, q4, q5,
		average
	FROM
		surveys
	WHERE
		class_number = :class_number
    ");

	//execute to replace :placehold with variable value
    $stmt->execute(array(
        ':class_number'=>$input_class
    ));
	
    echo "<table border='1'>"; ?>
	<tr>
<td>survey_id</td>
<td>student_name</td>
<td>q1</td><td>q2</td><td>q3</td><td>q4</td><td>q5</td> 
<td>average</td>
	</tr>
	
<?php
	$class_total=0;

	$row_average=0;
	$count=0;

	//
	$student_names=array();
	$q1=array();
	$q2=array();
	$q3=array();
	$q4=array();
	$q5=array();

	while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$row_array=array();
		//echo '$count: '."$count<br>";
		
		echo "<tr>";
		$survey_id=htmlentities($row['survey_id']);

		foreach($row as $value){
			echo "<td>$value</td>";
			$row_array[]=$value;
		} 
		$student_names[]=$row_array[1];
		//echo "<br>";
		//var_dump($student_names);
		//echo "<br>";

		$q1[]=$row_array[2];
		$q2[]=$row_array[3];
		$q3[]=$row_array[4];
		$q4[]=$row_array[5];
		$q5[]=$row_array[6];
		//
		//echo"<br>";
		echo "</tr>";
		
		//print row array
		//echo "<br>";
		//var_dump($row_array);
		//echo "<br>";
		$class_total = $class_total+$row_array[7];
		//echo '$class_total: '."$class_total<br>";
		$count=$count+1;
		//echo  '$count: '."$count<br>";
	}//end of while loop
	echo "<br>";
	var_dump($student_names);
	echo "<br>";
	var_dump($q1);
	echo "<br>";
	var_dump($q2);
	echo "<br>";
	var_dump($q3);
	echo "<br>";
	var_dump($q4);
	echo "<br>";
	var_dump($q5);
	echo "<br>";
	//
	//
	$class_average=$class_total/$count*10;
?>
<tr>
<td colspan="7">class_average</td>
<td><?=$class_average?>%</td>
</tr>
<?php
	echo "</table>";
	echo 'average: '."$class_average".'%';
}

?>
<br><a href="index.php">back</a>  

