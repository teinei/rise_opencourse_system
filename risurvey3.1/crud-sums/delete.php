<?php
require_once "pdo.php";
session_start();
//
/*
replace table name survey_sum
replace column name sum_id, class_number
*/
if ( isset($_POST['delete']) && isset($_POST['sum_id']) ) {
    $sql = "DELETE FROM survey_sum WHERE sum_id = :zip"; //table nom
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['sum_id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian: Make sure that sum_id is present
if ( ! isset($_GET['sum_id']) ) {
  $_SESSION['error'] = "Missing sum_id";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT * 
FROM survey_sum where sum_id = :xyz");//tablenom
$stmt->execute(array(":xyz" => $_GET['sum_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for sum_id';
    header( 'Location: index.php' ) ;
    return;
}

?>
<p>Confirm: Deleting <?= htmlentities($row['class_name']) ?> 
survey summary which  sum_id is 
<?= htmlentities($row['sum_id']) ?></p>

<form method="post">
<input type="hidden" name="sum_id" value="<?= $row['sum_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="index.php">Cancel</a>
</form>
