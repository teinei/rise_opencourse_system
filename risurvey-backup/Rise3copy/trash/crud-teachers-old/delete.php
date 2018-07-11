<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['delete']) && isset($_POST['teacher_id']) ) {
    $sql = "DELETE FROM teachers WHERE teacher_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['teacher_id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: home.php' ) ;
    return;
}

// Guardian: Make sure that teacher_id is present
if ( ! isset($_GET['teacher_id']) ) {
  $_SESSION['error'] = "Missing teacher_id";
  header('Location: home.php');
  return;
}

$stmt = $pdo->prepare("SELECT teacher_name, teacher_id FROM teachers where teacher_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['teacher_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for teacher_id';
    header( 'Location: home.php' ) ;
    return;
}

?>
<p>Confirm: Deleting <?= htmlentities($row['teacher_name']) ?></p>

<form method="post">
<input type="hidden" name="teacher_id" value="<?= $row['teacher_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="home.php">Cancel</a>
</form>
