<?php
//table classes
//columns: average, student_name
require_once "pdo.php";
session_start();

if ( isset($_POST['class_number']) && isset($_POST['co_teacher']) //alter this part
     && isset($_POST['d_teacher'])) {
    
	// Data validation
    if ( strlen($_POST['class_number']) < 1 || strlen($_POST['co_teacher']) < 1) {//alter this part
        $_SESSION['error'] = 'Missing data';
        header("Location: add.php");
        return;
    }
	
	/*
    if ( strpos($_POST['average'],'@') === false ) {
        $_SESSION['error'] = 'Bad data';
        header("Location: add.php");
        return;
    }
	*/

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
    $_SESSION['success'] = 'Record Added';
    header( 'Location: index.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
?>
<p>Add A New Class</p>
<form method="post">
<p>class stage
<input type="text" name="class_stage"></p>
<p>class number:
<input type="text" name="class_number"></p>
<p>d_teacher:
<input type="text" name="d_teacher"></p>
<p>co_teacher:
<input type="text" name="co_teacher"></p>
<p>value="YYYY-MM-DD"</p>
<p>start_date:
<input type="text" name="start_date"></p>
<p>open1:
<input type="text" name="open1"></p>

<p>open2:
<input type="text" name="open2"></p>
<p>open3:
<input type="text" name="open3"></p>
<p>graduate_date:
<input type="text" name="graduate_date"></p>

<p><input type="submit" value="Add New"/>
<a href="index.php">Cancel</a></p>
</form>
