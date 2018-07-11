<?php
require_once "pdo.php";
session_start();
//
/*
replace table name classes
//db: rise
//table:classes
replace column name class_id, class_number
*/
if ( isset($_POST['delete']) && isset($_POST['class_id']) ) {
    $sql = "DELETE FROM classes WHERE class_id = :zip"; //table nom
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['class_id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian: Make sure that class_id is present
if ( ! isset($_GET['class_id']) ) {
  $_SESSION['error'] = "Missing class_id";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT class_stage,class_number,class_id FROM classes where class_id = :xyz");//tablenom
$stmt->execute(array(":xyz" => $_GET['class_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for class_id';
    header( 'Location: index.php' ) ;
    return;
}

?>
<p>Confirm: Deleting <?= htmlentities($row['class_stage']) ?>0<?= htmlentities($row['class_number']) ?></p>

<form method="post">
<input type="hidden" name="class_id" value="<?= $row['class_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="index.php">Cancel</a>
</form>
