<?php
require_once "pdo.php";
session_start();
//db:classes
//class_id,

if( //check if these input is empty, if they are not empty, update the table
//isset($_POST['class_number']) && 
//isset($_POST['graduate_date']) && 
//isset($_POST['ordinal']) && 	 
isset($_POST['class_id']) //last check
){ //class_id

    // Data validation should go here (see add.php)
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

	WHERE class_id=:class_id";
	
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
	
	':class_stage'=> $_POST['class_stage'],
	':class_number' => $_POST['class_number'],
	':d_teacher'=>$_POST['d_teacher'],':co_teacher'=>$_POST['co_teacher'],
	':start_date'=>$_POST['start_date'],
	
	':open1'=>$_POST['open1'],':open2'=>$_POST['open2'],':open3'=>$_POST['open3'],
	
	':graduate_date'=>$_POST['graduate_date'],
	':class_id'=>$_POST['class_id']//need to be here
    ));
    $_SESSION['success'] = 'Record updated';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian should go here (see delete.php)

$stmt = $pdo->prepare("SELECT * FROM classes where class_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['class_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for class_id';
    header( 'Location: index.php' ) ;
    return;
}

	$class_stage=htmlentities($row['class_stage']);$class_number=htmlentities($row['class_number']);
	$d_teacher=htmlentities($row['d_teacher']);$co_teacher=htmlentities($row['co_teacher']);
	$start_date=htmlentities($row['start_date']);
	$open1=htmlentities($row['open1']);$open2=htmlentities($row['open2']);$open3=htmlentities($row['open3']);
	$graduate_date=htmlentities($row['graduate_date']); 
	$class_id=htmlentities($row['class_id']);
	
?>
<p>Edit Class</p>
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

<input type="hidden" name="class_id" value="<?= $class_id ?>">
<p>class_id:<?= $class_id ?></p>

<p><input type="submit" value="Finish Edit and Update"/>
<a href="index.php">Cancel</a></p>

</form>