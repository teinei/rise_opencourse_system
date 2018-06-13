<?php
require_once "pdo.php";
session_start();
?>

<html>
<head>
<meta content="text/html; charset=utf-8">
</head>
<body>

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
		
		$survey_id=htmlentities($row['survey_id']);
		//echo "<tr>";
		
		foreach($row as $value){
			if($count<1){
				
				echo "<td>$value</td>";
				
			}
			$row_array[]=$value;
		} 
		//echo "</tr>";
		//echo"<br>";
		
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
	var_dump($row_array);
	//var_dump($q11_array);
	echo "$q11s1"." "."$q11s2"." "."$q11s3"." "."$q11s4";
}

?>
<br>
<a href="index.php">back</a>  
<p>
<?= $row_array[1] ?>第<?= $row_array[2] ?>次公开课，<br>
应出勤人数<?= $count ?>人，<br>
实际出勤<?= $count ?>人，<br>
<br><br>
<?= $q11s1 ?>人已续报，<br>
<?= $q11s2 ?>人会续报，<br>
<?= $q11s3 ?>人正在考虑，<br>
<?= $q11s4 ?>人不续报 <br>
</p>
</body>
</html>
