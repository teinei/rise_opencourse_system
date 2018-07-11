<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['teacher_name']) && isset($_POST['email']) //teacher_name
     && isset($_POST['password']) && isset($_POST['teacher_id']) ) { //teacher_id

    // Data validation should go here (see add.php)
    $sql = "UPDATE teachers SET teacher_name = :teacher_name,
            email = :email, password = :password
            WHERE teacher_id = :teacher_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':teacher_name' => $_POST['teacher_name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password'],
        ':teacher_id' => $_POST['teacher_id']));
    $_SESSION['success'] = 'Record updated';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian should go here (see delete.php)

$stmt = $pdo->prepare("SELECT * FROM teachers where teacher_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['teacher_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for teacher_id';
    header( 'Location: index.php' ) ;
    return;
}

$n = htmlentities($row['teacher_name']);
$e = htmlentities($row['email']);
$p = htmlentities($row['password']);
$teacher_id = $row['teacher_id'];
?>
<p>Edit User</p>
<form method="post">
<p>Name:
<input type="text" name="teacher_name" value="<?= $n ?>"></p>
<p>Email:
<input type="text" name="email" value="<?= $e ?>"></p>
<p>Password:
<input type="text" name="password" value="<?= $p ?>"></p>
<input type="hidden" name="teacher_id" value="<?= $teacher_id ?>">
<p><input type="submit" value="Update"/>
<a href="index.php">Cancel</a></p>
</form>
