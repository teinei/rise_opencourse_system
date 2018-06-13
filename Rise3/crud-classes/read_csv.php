<?php
require_once "pdo.php";
session_start();
?>
<html>
<head>
<meta content="text/html; charset=utf-8">
</head>
<body>

<?php
//if(1){
if ( isset($_POST['class_stage'])){
	echo "loaded";
	
	$sql = "INSERT INTO classes ( 
		class_stage, class_number,
		d_teacher,co_teacher,
		start_date,
		open1,open2,open3,graduate_date
	)
    VALUES (
		:class_stage, :class_number,
		:d_teacher,:co_teacher,:start_date,:open1,:open2,:open3,:graduate_date
	)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(
        ':class_stage' => $_POST['class_stage'],
		':class_number' => $_POST['class_number'],
		':d_teacher' => $_POST['d_teacher'],
		':co_teacher' => $_POST['co_teacher'],
		':start_date' => $_POST['start_date'],
        ':open1' => $_POST['open1'],
		':open2' => $_POST['open2'],
		':open3' => $_POST['open3'],
		':graduate_date' => $_POST['graduate_date']
		));
}
    
//read csv
	$row = 1;
if (($handle = fopen("open_courses.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);///data loaded
    echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
	//
	echo "$data[2]<br>";
	
    for ($c=0; $c < $num; $c++) {
        echo $c." : ".$data[$c] . "<br />\n";// an item
	
    }
	
	$class_number=htmlentities($data[1]);
	echo "$class_number"."<br>";
	$teachers=htmlentities($data[2]);
	echo "$teachers"."<br>";
	
	//
	$co_teacher=htmlentities($row['co_teacher']);
	$start_date=htmlentities($row['start_date']);
	$open1=htmlentities($row['open1']);
	$open2=htmlentities($row['open2']);
	$open3=htmlentities($row['open3']);
	$graduate_date=htmlentities($row['graduate_date']); 
	
  }
  fclose($handle);
}
//read csv



?>
