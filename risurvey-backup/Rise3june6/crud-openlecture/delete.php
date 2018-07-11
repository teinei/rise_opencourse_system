<?php
require_once "pdo.php";
session_start();
//
/*
replace table name openlessons
replace column name open_id, class_number
*/
if ( isset($_POST['delete']) && isset($_POST['open_id']) ) {
    $sql = "DELETE FROM openlessons WHERE open_id = :zip"; //table nom
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['open_id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian: Make sure that open_id is present
if ( ! isset($_GET['open_id']) ) {
  $_SESSION['error'] = "Missing open_id";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT class_number, open_id FROM openlessons where open_id = :xyz");//tablenom
$stmt->execute(array(":xyz" => $_GET['open_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for open_id';
    header( 'Location: index.php' ) ;
    return;
}

?>
<p>Confirm: Deleting <?= htmlentities($row['class_number']) ?></p>

<form method="post">
<input type="hidden" name="open_id" value="<?= $row['open_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="index.php">Cancel</a>
</form>
