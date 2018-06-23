<?php
require_once "pdo.php";
session_start();
?>
<html>
<head>
<meta content="text/html; charset=utf-8">
</head>
<body>
<p><a href="index.php">Back</a></p>
<?php
//if(1){
if ( isset($_POST['class_stage'])){
	echo "loaded";
	
	
}
    
//read csv
	$row_csv = 1;
if (($handle = fopen("jun19..24.ivy.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);///data loaded
    //echo "<p> $num fields in line $row_csv: <br /></p>\n";
    $row_csv++;
    for ($c=0; $c < $num; $c++) {
        //echo $c." : ".$data[$c] . "<br />\n";// an item	
    }
	//read the csv file above

    if($row_csv!=1){
    	/* store csv-row into different variables */
		$class_number=htmlentities($data[1]);
		//echo "$class_number"."<br>";
		//get class stage, it is a letter and a digit
	$class_stage=substr($class_number,0,2);
	//echo "$class_stage";
	//main teacher and co teacher
	//substr(string,start,length)
	$teachers=htmlentities($data[2]);
	//find position of white space, to split main teacher
	//and co teacher
	$spacepos=strpos($teachers,' ');
	//main teacher goes here
	$d_teacher=substr($teachers,0,$spacepos);
	//echo "$d_teacher";
	//echo "$spacepos";
	//co teacher goes here
	$co_teacher=substr($teachers,$spacepos);
	//echo "$co_teacher";	
	//echo "$teachers"."<br>";
	$start_date=$data[4];
	$open1=$data[5];
	$open2=$data[6];
	$open3=$data[7];
	$graduate_date=$data[8];	
	/* store csv-row into different variables */
	
	//search the classes table first, if the entry exist, update
	$stmt = $pdo->prepare("SELECT * FROM 
		classes where class_number = :xyz");
	$stmt->execute(array(":xyz" => $class_number));
	$row_pdo = $stmt->fetch(PDO::FETCH_ASSOC);
	//if it is not exist, add new entry to db
	if ( $row_pdo === false ) {
		echo "add new class"."$class_number<br>";
		//insert new rows
		///*
		$sql = "INSERT INTO classes ( 
			class_stage, class_number,
			d_teacher,co_teacher,
			start_date,
			open1,open2,open3,graduate_date
		)
    	VALUES (
			:class_stage, :class_number,
			:d_teacher,:co_teacher,
			:start_date,:open1,:open2,:open3,:graduate_date
		)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
        	':class_stage' => $class_stage,
			':class_number' => $class_number,
			':d_teacher' => $d_teacher,
			':co_teacher' => $co_teacher,
			':start_date' => $start_date,
        	':open1' => $open1,
			':open2' => $open2,
			':open3' => $open3,
			':graduate_date' => $graduate_date
		));
		//*/
		//
		//
	}else{
		echo "update old entry: "."$class_number<br>";
		//update old entry
		$sql = "UPDATE 
			classes /*db*/
			SET 	
		class_stage=:class_stage, 
		class_number=:class_number,
		d_teacher=:d_teacher,
		co_teacher=:co_teacher,
		start_date=:start_date,
		open1=:open1,open2=:open2,open3=:open3,
		graduate_date=:graduate_date
			WHERE class_number=:class_number";	
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
		//
			':class_stage' => $class_stage,
			':class_number' => $class_number,
			':d_teacher' => $d_teacher,
			':co_teacher' => $co_teacher,
			':start_date' => $start_date,
        	':open1' => $open1,
			':open2' => $open2,
			':open3' => $open3,
			':graduate_date' => $graduate_date
    ));
	}
    }
 	}

  fclose($handle);
}
//read csv



?>
