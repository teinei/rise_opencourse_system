<?php
//table surveys
//columns: average, student_name
require_once "pdo.php";
session_start();
$average;
//$average=($_POST['q1']+$_POST['q2']+$_POST['q3']+$_POST['q4']+$_POST['q5'])/5.0;

if ( isset($_POST['class_number']) && isset($_POST['student_name'])
     && isset($_POST['d_teacher'])) {

    
	// Data validation
    if ( strlen($_POST['class_number']) < 1 || strlen($_POST['student_name']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: add.php");
        return;
    }
	
	/*
    if ( strpos($_POST['average'],'@') === false ) {
        $_SESSION['error'] = 'Bad d/Applications/MAMP/htdocs/rise_opencourse_system/rise_opencourse_system/Rise3/crud-surveys/report.phpata';
        header("Location: add.php");
        return;
    }
	*/
	/*
	survey_id, q1,q2,q3,q4,q5, average, text1,text2,text3, student_name, class_number, d_teacher, co_tea, tel,open_date,ordinal
	*/
	//
	$average=($_POST['q1']+$_POST['q2']+$_POST['q3']+$_POST['q4']+$_POST['q5'])/5.0;
	//
    $sql = "INSERT INTO surveys ( 
	q1,q2,q3,q4,q5,
	text1,text2,text3, 
	student_name, class_number, 
	d_teacher, co_tea, 
	open_date,ordinal,
	q11, average
	)VALUES ( :q1,:q2,:q3,:q4,:q5,
			  :text1,:text2,:text3, 
			  :student_name, :class_number,
			  :d_teacher, :co_tea, 
			  :open_date,:ordinal,
			  :q11,
			  :average
			  )";
    $stmt = $pdo->prepare($sql);
	//
	//
	
	//
    $stmt->execute(array(
        ':q1' => $_POST['q1'],
		':q2' => $_POST['q2'],
		':q3' => $_POST['q3'],
		':q4' => $_POST['q4'],
		':q5' => $_POST['q5'],
        ':text1' => $_POST['text1'],
		':text2' => $_POST['text2'],
		':text3' => $_POST['text3'],
		':student_name' => $_POST['student_name'],
		':class_number' => $_POST['class_number'],
		':d_teacher' => $_POST['d_teacher'],
		':co_tea' => $_POST['co_tea'],
		':open_date' => $_POST['open_date'],
        ':ordinal' => $_POST['ordinal'],
		':q11'=>$_POST['q11'],
		':average' => $average ));
		//$_POST['average'], I miss a comma after ordinal post $_POST['ordinal'],
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
<p>Add A New Survey</p>
<form method="post">
<p>student name:
<input type="text" name="student_name"></p>
<p>class number:
<input type="text" name="class_number"></p>
<p>ordinal:
<input type="radio" name="ordinal" value="1" />1
<input type="radio" name="ordinal" value="2" />2
<input type="radio" name="ordinal" value="3" />3
<input type="radio" name="ordinal" value="4" />4
<p>open date:
<input type="text" name="open_date" value="YYYY-MM-DD"></p>

<p>main teacher:
<input type="text" name="d_teacher"></p>
<p>co-teacher:
<input type="text" name="co_tea"></p>

<p>q1:
<input type="radio" name="q1" value="10" />10
<input type="radio" name="q1" value="9" />9
<input type="radio" name="q1" value="8" />8
<input type="radio" name="q1" value="7" />7
<input type="radio" name="q1" value="6" />6
</p>
<p>q2:
<input type="radio" name="q2" value="10" />10
<input type="radio" name="q2" value="9" />9
<input type="radio" name="q2" value="8" />8
<input type="radio" name="q2" value="7" />7
<input type="radio" name="q2" value="6" />6
</p>
<p>q3:
<input type="radio" name="q3" value="10" />10
<input type="radio" name="q3" value="9" />9
<input type="radio" name="q3" value="8" />8
<input type="radio" name="q3" value="7" />7
<input type="radio" name="q3" value="6" />6
</p>
<p>q4:
<input type="radio" name="q4" value="10" />10
<input type="radio" name="q4" value="9" />9
<input type="radio" name="q4" value="8" />8
<input type="radio" name="q4" value="7" />7
<input type="radio" name="q4" value="6" />6
</p>
<p>q5:
<input type="radio" name="q5" value="10" />10
<input type="radio" name="q5" value="9" />9
<input type="radio" name="q5" value="8" />8
<input type="radio" name="q5" value="7" />7
<input type="radio" name="q5" value="6" />6
</p>

<p>q11: 
<input type="radio" name="q11" value="1" />1.已续报
<input type="radio" name="q11" value="2" />2.是，会续报
<input type="radio" name="q11" value="3" />3.正在考虑
<input type="radio" name="q11" value="4" />4.否，不续报
</p>

<p>text1:<br>
<textarea rows="5" cols="50" name="text1"></textarea></p>
<p>text2:<br>
<textarea rows="5" cols="50" name="text2"></textarea></p>
<p>text3:<br>
<textarea rows="5" cols="50" name="text3"></textarea></p>

<p><input type="submit" value="Add New"/>
<a href="index.php">Cancel</a></p>
</form>
