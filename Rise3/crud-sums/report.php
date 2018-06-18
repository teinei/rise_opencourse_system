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
    $flag2=0;
    echo "input_class is : $input_class";
//
    //    $stmt = $pdo->query("
    //  buggy code: I use query rather than prepare

	//prepare select statement that has :placeholder
    $stmt = $pdo->prepare(" 
SELECT survey_id, 
average,q11, text1,text2,text3, 
student_name,d_teacher,
co_tea,open_date,ordinal,class_number
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
<td>survey_id</td><td>
average</td><td>q11</td><td>text1</td><td>text2</td><td>text3</td><td> 
student_name</td><td>d_teacher</td><td>
co_tea</td><td>open_date</td><td>ordinal</td><td>class_number</td>
	</tr>
<?php
	while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr>";
		$survey_id=htmlentities($row['survey_id']);

		foreach($row as $value){
			echo "<td>$value</td>";
		} 
		echo"<br>";
		echo "</tr>";
	}
	echo "</table>";
}

?>

