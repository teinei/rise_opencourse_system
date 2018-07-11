<?php
require_once "pdo.php";
session_start();
//
/*
replace table name surveys
replace column name survey_id, class_number
*/
if ( isset($_POST['delete']) && isset($_POST['survey_id']) ) {
    $sql = "DELETE FROM surveys WHERE survey_id = :zip"; //table nom
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['survey_id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian: Make sure that survey_id is present
if ( ! isset($_GET['survey_id']) ) {
  $_SESSION['error'] = "Missing survey_id";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT class_number, survey_id,student_name FROM surveys where survey_id = :xyz");//tablenom
$stmt->execute(array(":xyz" => $_GET['survey_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for survey_id';
    header( 'Location: index.php' ) ;
    return;
}

?>
<p>Confirm: Deleting <?= htmlentities($row['student_name']) ?><?= htmlentities($row['survey_id']) ?></p>

<form method="post">
<input type="hidden" name="survey_id" value="<?= $row['survey_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="index.php">Cancel</a>
</form>
