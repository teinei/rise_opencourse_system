<?php
require_once "pdo.php";
require_once "report_oop.php";
session_start();
?>
<html>
<head>
	<meta content="text/html; charset=utf-8">
</head>
<body>	
	<h3>survey summary and report - All in One</h3>
<!-- ask for input_class -->	
	<form method="post">
		<p>which class
		<input type="text" name="class_number">
		</p>
		<input type="submit" value="Start Queue"/>
	</form>
	<a href="index.php">back</a>
	<br><br>
<?php //get input class from user
//$input_class_form='';
$input_class='';
if(isset($_POST['class_number'])){
    echo "class_number is set<br>";
	$input_class=$_POST['class_number'];
    //$input_class_form=$_POST['class_number'];
    //echo "input_class is : $input_class_form";
	echo "input_class is : $input_class";
}
	//
?>

<?php //report1 use oop
//
$report1 = new Report();
//$report1->$input_class=$input_class;
$report1->print_report1($input_class);
?>



<?php
	//create csv file 
if(isset($_POST['class_number'])){
	//create a file
	//$filename = "average_".date('Ymd').'_'.date('h-i-sa').'.csv';
	$filename = "average_".date('Ymd').'.csv'; 
	//设置文件名
	$file = fopen("$filename","w");
	$csv_count=array();
	for($i=0;$i<$count;$i++){
		$a=$i+1;
		echo "<td align='center'>$a</td>";
		//
		if($a<$count)$csv_count[].=$a.",";
		else $csv_count[].=$a;
		//

	}
//$csv_count .= implode(",",$count)."\n";
//echo sizeof($count);//sizeof() to calculate array length
echo"<br>";
//var_dump($csv_count);
//fputcsv($file,$csv_count); 
//fclose($file);    
    //header("Content-type:text/csv"); 
    //header("Content-Disposition:attachment;filename=".$filename); 
    //header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
    //header('Expires:0'); 
    //header('Pragma:public'); 
    //echo $csv_count;
}
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

<?php
$report3[]="<p>".$class_number."第".$ordinal."次公开课，<br>";
$report3[]="应出勤人数".$count."人，<br>";
$report3[]="实际出勤".$count."人，<br><br>";

$report3[]=$q11s1."人已续报，<br>";
$report3[]=$q11s2."人会续报，<br>";
$report3[]=$q11s3."人正在考虑，<br>";
$report3[]=$q11s4."人不续报 <br></p>";
//$report3[]=
//$report3[]=
$report_email=
"<p>".$class_number."第".$ordinal."次公开课，<br>"
."应出勤人数".$count."人，<br>"
."实际出勤".$count."人，<br><br>"
.$q11s1."人已续报，<br>"
.$q11s2."人会续报，<br>"
.$q11s3."人正在考虑，<br>"
.$q11s4."人不续报 <br></p>";
echo "$report_email"."<br><br>";

//var_dump($report3);
echo "<br><br>";
print_r($report3);
?>
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

if ( $row_pdo === false && isset($_POST['class_number'])){
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
echo "<br><br>$input_class"."第"."$ordinal"."次公开课-"
."$open_date"."-"."$main_teacher"."-"."$co_teacher<br><br><br>";
?>