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
		class_number,
		ordinal,q11
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
<td>class_number</td>
<td>ordinal</td>
<td>q11</td>
	</tr>
	
<?php
	$class_total=0;

	$row_average=0;
	$count=0;
	$q11_array=array();
	
	$q11s1=0;//for those choose 1
	$q11s2=0;//choose 2
	$q11s3=0;//choose 3 of q11
	$q11s4=0;//choose 4
	
	while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$row_array=array();
		
		echo "<tr>";
		$survey_id=htmlentities($row['survey_id']);

		foreach($row as $value){
			
			echo "<td>$value</td>";
			$row_array[]=$value;
		} 
		//echo"<br>";
		echo "</tr>";
		
		$count=$count+1;
		//$row_array expired here,
		$q11_array[]=$row_array[3];
		//echo 
		if($row_array[3] == 1){
			$q11s1 = $q11s1+1;
		}elseif($row_array[3] == 2){
			$q11s2+=1;
		}elseif($row_array[3] ==3){
			$q11s3+=1;
		}elseif($row_array[3] ==4){
			$q11s4+=1;
		}else{
		}
	}
	$class_average=$class_total/$count*10;
	echo "</table>";
	//var_dump($row_array);
	//var_dump($q11_array);
	echo "$q11s1"." "."$q11s2"." "."$q11s3"." "."$q11s4";
}

?>
<a href="index.php">back</a>  

