<?php
require_once "pdo.php";
session_start();
//
$input_class='';
//
//report1 variables
$student_names=array();
$q1=array();
$q2=array();
$q3=array();
$q4=array();
$q5=array();
//report1 var set 2
$class_total=0;
$row_average=0;
$count=0;
//
//report2 vars
$open_date=0;
$ordinal=0;
$text1='';
$text2='';
$text3='';
//
//report3 vars
$q11_array=array();
$q11s1=0;//for those choose 1
$q11s2=0;//choose 2
$q11s3=0;//choose 3 of q11
$q11s4=0;//choose 4
//
$main_teacher=0;
$co_teacher=0;
//
?>
<html>
<head>
	<meta content="text/html; charset=utf-8">
</head>
<body>	
	<h3>survey summary and report - All in One</h3>
	<form method="post">
		<p>which class
		<input type="text" name="class_number">
		</p>
		<input type="submit" value="Start Queue"/>
	</form>
	<a href="index.php">back</a>
	<br><br>
<?php
if(isset($_POST['class_number'])){
    echo "class_number is set<br>";
    $input_class=$_POST['class_number'];
    echo "input_class is : $input_class";
//
?>
<?php
    //    $stmt = $pdo->query("
    //  buggy code: I use query rather than prepare

	//prepare select statement that has :placeholder
    $stmt = $pdo->prepare(" 
	SELECT 
		survey_id, 
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
	//
	//echo "<table border='1'>"; 
	while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$row_array=array();
		//echo '$count: '."$count<br>";
		
		//echo "<tr>";
		$survey_id=htmlentities($row['survey_id']);

		foreach($row as $value){
			//echo "<td>$value</td>";
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
		//echo "</tr>";
		
		//print row array
		//echo "<br>";
		//var_dump($row_array);
		//echo "<br>";
		$class_total = $class_total+$row_array[7];
		//echo '$class_total: '."$class_total<br>";
		$count=$count+1;
		//echo  '$count: '."$count<br>";
	}//end of while loop
	$class_average=$class_total/$count*10;
	$class_average=number_format($class_average,2);
	/*
	//
	$number = 1234.5678;
	// english notation without thousands seperator
	$english_format_number = number_format($number, 2, '.', '');
	// 1234.57
	*/
?>
	<br><br>
	<hr>
	<br>
	<span>report1: everage</span>
	<table border='1'>
	<tr>
	<td>人数\项目</td>
<?php
	for($i=0;$i<$count;$i++){
		$a=$i+1;
		echo "<td align='center'>$a</td>";
	}
?>
	</tr>
<tr>
	<td>
	姓名
	</td>
	<?php
	foreach($student_names as $name){
		echo "<td width='50' align='center'>$name</td>";
	} 
	?>
</tr>
<tr>
	<td>
	1.您对此次公开课的评价是？
	</td>
	<?php
	foreach($q1 as $q){
		echo "<td align='center'>$q</td>";
	} 
	?>
</tr>
<tr>
	<td>
	2.您对班级老师的授课满意度如何？
	</td>
	<?php
	foreach($q2 as $q){
		echo "<td align='center'>$q</td>";
	} 
	?>
</tr>
<tr>
	<td>
	3.您觉得班级老师对孩子的关爱程度如何？
	</td>
	<?php
	foreach($q3 as $q){
		echo "<td align='center'>$q</td>";
	} 
	?>
</tr>
<tr>
	<td>
	4.您对老师定期与您沟通孩子学习情况的满意度如何？
	</td>
	<?php
	foreach($q4 as $q){
		echo "<td align='center'>$q</td>";
	} 
	?>
</tr>
<tr>
	<td>
	5.您对中心整体教学服务质量的满意度如何？
	</td>
	<?php
	foreach($q5 as $q){
		echo "<td align='center'>$q</td>";
	} 
	//$colspan=$count-1;
	?>
</tr>
<tr>
	<td>
	平均值
	</td>
	<td colspan="<?=$count?>" align="right">
		<?php sprintf("%.2f",$class_average) ?>
		<?=$class_average?>%
	</td>
</tr>
</tr>

<?php
	echo "</table>";
	//echo 'average: '."$class_average".'%';
}
//end of table 1
?>

<?php
//table2 data, start
$count=1;
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
$stmt->execute(array(
    ':class_number'=>$input_class
));
//echo "<table border='1' width='610'>";
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
	
	//check if text is empty, if it is not empty
	//add '. ' to the end.
	
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
}
//table2 data, end
?>
	<hr>
	<br>
	<span>report2: comments</span>
 	<table border='1' width='610'>
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
<?php
	//table 3
$count=0;
$stmt = $pdo->prepare(" 
	SELECT 
		survey_id, 
		class_number,
		ordinal,
		q11,
		d_teacher,
		co_tea
	FROM
		surveys
	WHERE
		class_number = :class_number
");
//
$stmt->execute(array(
	':class_number'=>$input_class
));
//
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$row_array=array();
	
	$survey_id=htmlentities($row['survey_id']);
	//echo "<tr>";
	
	foreach($row as $value){
		if($count<1){	
			//echo "<td>$value</td>";	
		}
		$row_array[]=$value;
	} 
	//echo "</tr>";
	//echo"<br>";
	//
	$main_teacher=$row_array[4];
	$co_teacher=$row_array[5];
	//
	$count=$count+1;
	//$row_array expired here,
	$q11_array[]=$row_array[3];
	//echo 
	$class_number=$row_array[1];
	$ordinal=$row_array[2];
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
//
?>
<br>
<hr>
<br>
<span><b>report3: email</b></span>
<p>
<?= $class_number ?>第<?= $ordinal ?>次公开课，<br>
应出勤人数<?= $count ?>人，<br>
实际出勤<?= $count ?>人，<br>
<br>
<?= $q11s1 ?>人已续报，<br>
<?= $q11s2 ?>人会续报，<br>
<?= $q11s3 ?>人正在考虑，<br>
<?= $q11s4 ?>人不续报 <br>
</p>
</body>
</html>

<?php
//put sum data into survey_sum db
$stmt = $pdo->prepare("SELECT * FROM 
		survey_sum WHERE class_name = :xyz");
$stmt->execute(array(":xyz" => $input_class));
$row_pdo = $stmt->fetch(PDO::FETCH_ASSOC);
//if it is not exist, add new entry to db
//var_dump($row_pdo);

if ( $row_pdo === false &&
	isset($_POST['class_number'])
){
	echo "<br>insert data";
	$sql = "INSERT INTO survey_sum ( 
		average,
		open_date, class_name,
		text1, text2, text3,
		main_teacher, co_teacher
		)VALUES ( 
	:average,
	:open_date, :class_name,
	:text1, :text2, :text3,
	:main_teacher, :co_teacher
		)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(
		':average' => $class_average,
		':open_date' => $open_date,
		':class_name' => $input_class,
		':text1'=>$text1, 	
		':text2'=>$text2,
		':text3'=>$text3,
		':main_teacher'=>$main_teacher,
		':co_teacher'=>$co_teacher
	));
}elseif($row_pdo!=false){
	//entry exist
	echo "<br>update data<br>";
	//update db
	$sql = "UPDATE
		survey_sum 
	SET 
		average=:average,
		open_date=:open_date, class_name=:class_name,
		text1=:text1, text2=:text2, text3=:text3,
		main_teacher=:main_teacher, co_teacher=:co_teacher
	WHERE
	class_name=:class_name";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(
	':average' => $class_average,
	':class_name' => $input_class,
	':open_date' => $open_date,
	':text1'=>$text1, 	
	':text2'=>$text2,
	':text3'=>$text3,
	':main_teacher'=>$main_teacher,
	':co_teacher'=>$co_teacher
	));
}else{
	//
	echo '<p style="color:red">'."bada data".'</p>';
}
?>