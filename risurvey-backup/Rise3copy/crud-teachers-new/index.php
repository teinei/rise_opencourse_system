<?php
require_once "pdo.php";
session_start();
?>
<html>
<head></head><body>
<?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
echo('<table border="1">'."\n");

//
//alter keys and dbname here
$stmt = $pdo->query("SELECT teacher_name, email, password, teacher_id FROM teachers");
//
//
//$stmt = $pdo->query("SELECT teacher_name, email, password, user_id FROM users");
//

while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo ("<tr><td>");
    echo(htmlentities($row['teacher_name']));//alter key name
    echo("</td><td>");
    echo(htmlentities($row['email']));
    echo("</td><td>");
    echo(htmlentities($row['password']));
    echo("</td><td>");
    echo('<a href="edit.php?teacher_id='.$row['teacher_id'].'">Edit</a> / '); //alter key name teacher_id < user_id
    echo('<a href="delete.php?teacher_id='.$row['teacher_id'].'">Delete</a>'); //user_id > teacher_id
    echo("</td></tr>\n");
}
?>
</table>
<a href="add.php">Add New</a>
