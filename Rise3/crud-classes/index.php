<?php
/*
alter classes,
alter columns class_id, q1,q2,q3,q4,q5, average, text1,text2,text3, student_name, class_number, d_teacher, co_teacher, tel,start_date,oridinal
*/
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
$stmt = $pdo->query("SELECT class_id,
class_stage, class_number,
d_teacher,co_teacher,start_date,open1,open2,open3,graduate_date
FROM classes");//
// /* q1,q2,q3,q4,q5, */
// <td> q1</td><td>q2</td><td>q3</td><td>q4</td><td>q5</td> 
?>
<tr>
<td>class_id</td>
<td>class stage</td><td>class number</td>
<td>main teacher</td>
<td>co-teacher</td>
<td>start date</td><td>open1</td><td>open2</td><td>open3</td> 
<td>graduate date</td>
<td></td>
</tr>
<?php
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
	echo ("<tr><td>");//row start
	echo(htmlentities($row['class_id']));
	echo("</td>");
	//
	echo("<td>");
	echo(htmlentities($row['class_stage']));//alter key name
    echo("</td>");
	//
		//
	echo("<td>");
	echo(htmlentities($row['class_number']));//alter key name
    echo("</td>");
	/*
	echo("<td>");
	echo(htmlentities($row['q1']));
	echo("</td>");
	//
	echo("<td>");
	echo(htmlentities($row['q2']));
	echo("</td>");
	//
		//
	echo("<td>");
	echo(htmlentities($row['q3']));
	echo("</td>");
	//
		//
	echo("<td>");
	echo(htmlentities($row['q4']));
	echo("</td>");
		//
	echo("<td>");
	echo(htmlentities($row['q5']));
	echo("</td>");
	*/
	echo("<td>");
	echo(htmlentities($row['d_teacher']));
	echo("</td>");
	//
	echo("<td>");
	echo(htmlentities($row['co_teacher']));
	echo("</td>");
	//
		//
	echo("<td>");
	echo(htmlentities($row['start_date']));
	echo("</td>");
	//
	//
	echo("<td>");
	echo(htmlentities($row['open1']));
	echo("</td>");
	//
	//
	//
	echo("<td>");
	echo(htmlentities($row['open2']));
	echo("</td>");
	//
	//
	echo("<td>");
	echo(htmlentities($row['open3']));
	echo("</td>");
	//
	echo("<td>");
	echo(htmlentities($row['graduate_date']));
	echo("</td>");
	//
    echo("<td>");
    //echo("</td><td>");
    echo('<a href="edit.php?class_id='.$row['class_id'].'">Edit</a> / '); 
    echo('<a href="delete.php?class_id='.$row['class_id'].'">Delete</a>'); 
    echo("</td></tr>\n");
}
?>
</table>
<a href="add.php">Add New</a>
<a href="coming_open_course.php">coming_open_course</a>
<a href="read_csv.php">read_csv</a>
