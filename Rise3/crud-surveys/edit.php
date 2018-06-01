<?php
require_once "pdo.php";
session_start();
//db:surveys
//survey_id,

if ( 
isset($_POST['class_number']) && isset($_POST['student_name']) //class_number
     && isset($_POST['ordinal']) && 	 
isset($_POST['survey_id'])) { //survey_id

    // Data validation should go here (see add.php)
    $sql = "UPDATE 
			surveys
			SET 
	q1=:q1,q2=:q2,q3=:q3,q4=:q4,q5=:q5,
	text1=:text1,text2=:text2,text3=:text3,
	student_name=:student_name, class_number=:class_number, 
	d_teacher=:d_teacher, co_tea=:co_tea,
	open_date=:open_date,ordinal=:ordinal,
	average=:average
	WHERE survey_id=:survey_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
	':q1'=> $_POST['q1'],':q2' => $_POST['q2'],':q3'=>$_POST['q3'],':q4'=>$_POST['q4'],':q5'=>$_POST['q5'],
	':text1'=>$_POST['text1'],':text2'=>$_POST['text2'],':text3'=>$_POST['text3'],
	':student_name'=>$_POST['student_name'], ':class_number'=>$_POST['class_number'], 
	':d_teacher'=>$_POST['d_teacher'], ':co_tea'=>$_POST['co_tea'], 
	':open_date'=>$_POST['open_date'],':ordinal'=>$_POST['ordinal'],
	':survey_id'=>$_POST['survey_id'],':average'=>$_POST['average']
    ));
    $_SESSION['success'] = 'Record updated';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian should go here (see delete.php)

$stmt = $pdo->prepare("SELECT * FROM surveys where survey_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['survey_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for survey_id';
    header( 'Location: index.php' ) ;
    return;
}

	$q1=htmlentities($row['q1']);$q2=htmlentities($row['q2']);
	$q3=htmlentities($row['q3']);$q4=htmlentities($row['q4']);$q5=htmlentities($row['q5']);
	$text1=htmlentities($row['text1']);$text2=htmlentities($row['text2']);$text3=htmlentities($row['text3']);
	$student_name=htmlentities($row['student_name']); $class_number=htmlentities($row['class_number']); 
	$d_teacher=htmlentities($row['d_teacher']); $co_tea=htmlentities($row['co_tea']); 
	$open_date=htmlentities($row['open_date']);$ordinal=htmlentities($row['ordinal']);
	$survey_id=htmlentities($row['survey_id']);
	$average=($row['q1']+$row['q2']+$row['q3']+$row['q4']+$row['q5'])/5.0;

	//$survey_id = htmlentities($row['survey_id']);
?>
<p>Edit User</p>
<form method="post">
<p>student name:
<input type="text" name="student_name" value="<?= $student_name ?>"></p>
<p>class number:
<input type="text" name="class_number" value="<?= $class_number ?>"></p>
<p>ordinal:
<input type="text" name="ordinal" value="<?= $ordinal ?>"></p>
<p>open date:
<input type="text" name="open_date" value="<?=  $open_date ?>"> </p>

<p>dominant teacher:
<input type="text" name="d_teacher" value="<?= $d_teacher ?>"></p>
<p>co-teacher:
<input type="text" name="co_tea" value="<?= $co_tea ?>"></p>

<p>q1:
<input type="text" name="q1" value="<?= $q1 ?>"></p>
<p>q2:
<input type="text" name="q2" value="<?= $q2 ?>"></p>
<p>q3:
<input type="text" name="q3" value="<?= $q3 ?>"></p>
<p>q4:
<input type="text" name="q4" value="<?= $q4 ?>"></p>
<p>q5:
<input type="text" name="q5" value="<?= $q5 ?>"></p>
<p>average:
<input type="text" name="average" value="<?= $average ?>">
</p>

<p>text1:<br>
<textarea rows="5" cols="50" name="text1"><?= $text1 ?></textarea></p>
<p>text2:<br>
<textarea rows="5" cols="50" name="text2"><?= $text2 ?></textarea></p>
<p>text3:<br>
<textarea rows="5" cols="50" name="text3"><?= $text3 ?></textarea></p>
<input type="hidden" name="survey_id" value="<?= $survey_id ?>">
<p>survey_id:<?= $survey_id ?></p>

<p><input type="submit" value="Add New"/>
<a href="index.php">Cancel</a></p>
</form>
