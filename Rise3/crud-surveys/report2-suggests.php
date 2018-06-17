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
<?php //ask for user input ?>
<p>which class
<input type="text" name="class_number">
</p>
<p><input type="submit" value="Start Queue"/>
</form>
<?php
if(isset($_POST['class_number'])){
    echo "class_number is set<br>";
    $input_class=$_POST['class_number'];
	echo "input_class is : $input_class<br>";
//
    //    $stmt = $pdo->query("
    //  buggy code: I use query rather than prepare

	//prepare select statement that has :placeholder
    $stmt = $pdo->prepare(" 
	SELECT survey_id, 
		open_date,
		ordinal,
		text1, text2, text3
	FROM
		surveys
	WHERE
		class_number = :class_number
    ");

	//execute to replace :placehold with variable value
    $stmt->execute(array(
        ':class_number'=>$input_class
    ));
	
	echo "<table border='1' width='610'>";
?>




<?php
	$class_total=0;
	$row_average=0;
	$count=0;
	$open_date=0;
	$ordinal=0;
	$text1='';
	$text2='';
	$text3='';
	while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$row_array=array();
		
		//print count before incrementing
		//echo '$count: '."$count<br>";
		
		//echo "<tr>";
		$survey_id=htmlentities($row['survey_id']);

		foreach($row as $value){
			//echo "<td>$value</td>";
			$row_array[]=$value;
		} 
		//echo"<br>";
		//echo "</tr>";
		
		//$row_array[0]:survey_id
		//$row_array[1]:open_date
		//$row_array[2]:ordinal
		//$row_array[3]:text1
		//$row_array[4]:text2
		//$row_array[5]:text3
		if($count==1){ //only assign once 
			//because these variables have same value every row
			echo "<br>";
			$open_date=$row_array[1];
			//echo "open_date: $open_date";
			$ordinal=$row_array[2];
			//echo "<br>ordinal: $ordinal";
		}
		/*
		check if text is empty, if it is not empty
		add '. ' to the end.
		*/
		$text_temp=$row_array[3];
		$text_length=strlen($text_temp);
		//echo "<br>text_Length: $text_length";	
		$text1 .= $row_array[3];
		if($text_length>0) $text1 .='. ';
		//

		$text_temp=$row_array[4];
		$text_length=strlen($text_temp);
		$text2 .= $row_array[4];
		if($text_length>0) $text2 .='. ';

		$text_temp=$row_array[5];
		$text_length=strlen($text_temp);
		$text3 .= $row_array[5];
		if($text_length>0) $text3 .='. ';

		//print each row
		//echo "<br>$count";
		//echo "<br>";
		//var_dump($row_array);
		//echo "<br>";
		//$class_total = $class_total+$row_array[7];
		
		//print score before everage
		//echo '$class_total: '."$class_total<br>";
		$count=$count+1;
		//print $count
		//echo  '$count: '."$count<br>";
	}//end of while loop
	//echo "<br>text1: $text1";
	//echo "<br>text2: $text2";
	//echo "<br>text3: $text3";
	$class_average=$class_total/$count*10;

	//echo "</table>";
	//echo 'average: '."$class_average";
	$textlen=strlen("是");//return 3, a chiese character takes 3
	$textlen=strlen($text2);
	//echo "<br>$textlen";
}
?>

	<tr>
		<td>班级名称</td>
		<td><?= $input_class ?></td>
	</tr>
	<tr>
		<td>日期</td>
		<td><?= $open_date ?>(第<?=$ordinal?>次)</td>
	</tr>
	<tr>
		<td>是否按计划进行及滞后的原因</td>
		<td>是</td>
	</tr>
	<tr>
		<td>如果正在考虑或不打算续报下一年，具体考量的点</td>
		<td><?=$text1?></td>
	</tr>
	<tr>
		<td>公开课孩子的进步点</td>
		<td><?=$text2?></td>
	</tr>
	<tr>
		<td>家长建议</td>
		<td>
		<?=$text3?>
		</td>
	</tr>
</table>
<br>
<a href="index.php">back</a> 

