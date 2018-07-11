<html>
<head>
<meta content="text/html; charset=utf-8">
</head>
<body>
<?php
require_once "pdo.php";
session_start();
//db:surveys
//survey_id,

$sum_id=0;
$open_date=0;
$class_name=0;
$main_teacher=0;
$co_teacher=0;
$average=0;
$text1=0;
$text2=0;
$text3=0;
?>
<p>coming open courses for this month</p>

<?php
if (
isset($_POST['sum_id'])
) { //survey_id
	// Data validation should go here (see add.php)
	$sql = "UPDATE
			survey_sum 
		SET 
			average=:average
		WHERE
		sum_id=:sum_id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(
			':average' => $class_average,
			':sum_id' => $input_class
	));
    //
    $_SESSION['success'] = 'Record updated';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian should go here (see delete.php)
// if this sum is not in table, back to index.php
$stmt = $pdo->prepare("SELECT * FROM 
	survey_sum where sum_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['sum_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for survey_id';
    header( 'Location: index.php' ) ;
    return;
}
	$sum_id=$_GET['sum_id'];
	$open_date=$row['open_date'];
	$class_name=$row['class_name'];
	$main_teacher=$row['main_teacher'];
	$co_teacher=$row['co_teacher'];
	$average=$row['average'];
	$text1=$row['text1'];
	$text2=$row['text2'];
	$text3=$row['text3'];
?>
<p>Edit User</p>
<form method="post">
<p>open date:
<input type="text" name="open_date" 
	value="<?=  $open_date ?>"> </p>
<p>class name:
<input type="text" name="class_name" 
	value="<?= $class_name ?>"></p>
<p>main teacher:
<input type="text" name="main_teacher" 
	value="<?= $main_teacher ?>"></p>
<p>co-teacher:
<input type="text" name="co_tea"
	value="<?= $co_teacher ?>"></p>
<p>average:
<input type="text" name="average" 
	value="<?= $average ?>">
</p>
<p>text1:<br>
<textarea rows="5" cols="50" 
	name="text1"><?= $text1 ?></textarea></p>
<p>text2:<br>
<textarea rows="5" cols="50" 
	name="text2"><?= $text2 ?></textarea></p>
<p>text3:<br>
<textarea rows="5" cols="50" 
	name="text3"><?= $text3 ?></textarea></p>
<input type="hidden" name="survey_id" value="<?= $survey_id ?>">
<p>sum_id:<?= $sum_id ?></p>

<p><input type="submit" value="Edit done"/>
<a href="index.php">Cancel</a></p>
</form>
</body>
</html>
