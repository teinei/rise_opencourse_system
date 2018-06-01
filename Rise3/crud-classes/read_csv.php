<?php
require_once "pdo.php";
session_start();
?>
<p>Add A New Class from CSV</p>
<form method="post">


<p>class_stage:
<input type="text" name="class_stage" value="<?= $class_stage ?>"></p>
<p>class_number:
<input type="text" name="class_number" value="<?= $class_number ?>"></p>

<p>d_teacher:
<input type="text" name="d_teacher" value="<?= $d_teacher ?>"></p>

<p>co-teacher:
<input type="text" name="co_teacher" value="<?= $co_teacher ?>"></p>

<p>start_date:
<input type="text" name="start_date" value="<?= $start_date ?>"></p>

<p>open1:<br>
<input type="text" name="open1" value="<?= $open1 ?>"></p>
<p>open2:<br>
<input type="text" name="open2" value="<?= $open2 ?>"></p>
<p>open3:<br>
<input type="text" name="open3" value="<?= $open3 ?>"></p>

<p>graduate_date:
<input type="text" name="graduate_date" value="<?= $graduate_date ?>"></p>



<p><input type="submit" value="Add New"/>
<a href="index.php">Cancel</a></p>
</form>

<?php

?>


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
	$class_number=htmlentities($data[1]);
	$d_teacher=htmlentities($data[2]);$co_teacher=htmlentities($row['co_teacher']);
	$start_date=htmlentities($row['start_date']);
	$open1=htmlentities($row['open1']);$open2=htmlentities($row['open2']);$open3=htmlentities($row['open3']);
	$graduate_date=htmlentities($row['graduate_date']); 
	//
    for ($c=0; $c < $num; $c++) {
        echo $c." : ".$data[$c] . "<br />\n";// an item
	
    }
  }
  fclose($handle);
}
//read csv



?>
