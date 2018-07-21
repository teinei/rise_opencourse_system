<?php
//file: db_oop.php
class Survey{
	//
	function read_by_class($input_class_arg){
		include "pdo.php";
		$input_class=$input_class_arg;
		//prepare place holders
		$stmt = $pdo->prepare(" 
		SELECT 
			*
		FROM
			surveys
		WHERE
			class_number = :class_name
		");
		//
		$stmt->execute(array(
			':class_name'=>$input_class
		));
		//
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			//
			var_dump($row);
			echo "<br><br>";
			//
		}//close while
		//
	}//close function
	//
}//close class
?>
<form method="post">
	<p>which class
	<input type="text" name="class_name">
	</p>
	<p>
	<select name="db_name">
		<option value="surveys">surveys</option>
		<option value="classes">classes</option>
		<option value="survey_sum">weekly reports</option>
	</select>
	</p>
	<input type="submit" value="Start Queue"/>
</form>
<?php

//
$survey = new Survey();
if(isset($_POST['class_name'])){
    echo "class_name is set<br>";
	$input_class=$_POST['class_name'];
	echo "input_class is : $input_class<br>";
	$survey->read_by_class($input_class);
}	
?>















