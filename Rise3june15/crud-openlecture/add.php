<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['class_number']) && isset($_POST['percent'])
     && isset($_POST['issues'])) {

    
	// Data validation
    if ( strlen($_POST['class_number']) < 1 || strlen($_POST['issues']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: add.php");
        return;
    }
	
	/*
    if ( strpos($_POST['percent'],'@') === false ) {
        $_SESSION['error'] = 'Bad data';
        header("Location: add.php");
        return;
    }
	*/

    $sql = "INSERT INTO openlessons (class_number, percent, issues)
              VALUES (:class_number, :percent, :issues)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':class_number' => $_POST['class_number'],
        ':percent' => $_POST['percent'],
        ':issues' => $_POST['issues']));
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
<p>Add A New open course</p>
<form method="post">
<p>class number:
<input type="text" name="class_number"></p>
<p>percent:
<input type="text" name="percent"></p>
<p>issues:
<input type="text" name="issues"></p>
<p><input type="submit" value="Add New"/>
<a href="index.php">Cancel</a></p>
</form>
