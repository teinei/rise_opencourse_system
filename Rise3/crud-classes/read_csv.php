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
	
	
}
    
//read csv
	$row = 1;
if (($handle = fopen("open_courses-short.csv", "r")) !== FALSE) {
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
	$start_date=$data[4];
	$open1=$data[5];
	$open2=$data[6];
	$open3=$data[7];
	$graduate_date=$data[8];	

	//
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
        ':class_stage' => $class_number,
		':class_number' => $class_number,
		':d_teacher' => $teachers,
		':co_teacher' => $teachers,
		':start_date' => $start_date,
        ':open1' => $open1,
		':open2' => $open2,
		':open3' => $open3,
		':graduate_date' => $graduate_date
		));
	//
	
  }
  fclose($handle);
}
//read csv



?>
