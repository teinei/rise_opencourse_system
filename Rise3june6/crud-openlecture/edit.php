<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['class_number']) && isset($_POST['percent']) //class_number
     && isset($_POST['issues']) && isset($_POST['open_id']) ) { //open_id

    // Data validation should go here (see add.php)
    $sql = "UPDATE openlessons SET class_number = :class_number,
            percent = :percent, issues = :issues
            WHERE open_id = :open_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':class_number' => $_POST['class_number'],
        ':percent' => $_POST['percent'],
        ':issues' => $_POST['issues'],
        ':open_id' => $_POST['open_id']));
    $_SESSION['success'] = 'Record updated';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian should go here (see delete.php)

$stmt = $pdo->prepare("SELECT * FROM openlessons where open_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['open_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for open_id';
    header( 'Location: index.php' ) ;
    return;
}

$n = htmlentities($row['class_number']);
$e = htmlentities($row['percent']);
$p = htmlentities($row['issues']);
$open_id = $row['open_id'];
?>
<p>Edit User</p>
<form method="post">
<p>Name:
<input type="text" name="class_number" value="<?= $n ?>"></p>
<p>percent:
<input type="text" name="percent" value="<?= $e ?>"></p>
<p>issues:
<input type="text" name="issues" value="<?= $p ?>"></p>
<input type="hidden" name="open_id" value="<?= $open_id ?>">
<p><input type="submit" value="Update"/>
<a href="index.php">Cancel</a></p>
</form>
