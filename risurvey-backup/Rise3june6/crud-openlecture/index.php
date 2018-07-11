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
//table opened
//alter keys and dbname here
$stmt = $pdo->query("SELECT class_number, open_date, ordinal,class_id,percent,issues, open_id FROM openlessons");//
?>
<tr>
<td>class number</td>
<td>percent</td>
<td>open date</td>
<td>ordinal</td>
<td></td>
</tr>
<?php
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo ("<tr><td>");
    echo(htmlentities($row['class_number']));//alter key name
    echo("</td>");
	//
	echo("<td>");
	echo(htmlentities($row['percent']));
	echo("</td>");
	//
    echo("<td>");
	echo(htmlentities($row['open_date']));
    echo("</td><td>");
    echo(htmlentities($row['ordinal']));
    echo("</td><td>");
    echo('<a href="edit.php?open_id='.$row['open_id'].'">Edit</a> / '); //alter key name open_id < user_id
    echo('<a href="delete.php?open_id='.$row['open_id'].'">Delete</a>'); //user_id > open_id
    echo("</td></tr>\n");
}
?>
</table>
<a href="add.php">Add New</a>
