<?php
/*
alter classes,
alter columns class_id, q1,q2,q3,q4,q5, average, text1,text2,text3, student_name, class_number, d_teacher, co_teacher, tel,start_date,oridinal
*/
require_once "pdo.php";
session_start();
$input_class='';
?>
<html>
<head></head>
<body>
<form method="post">
<p>which class
<input type="text" name="class_number">
<input type="submit" value="Start Queue"/>
</form>

<a href="add.php">Add New</a> | 
<a href="coming_open_course.php">coming_open_course</a> | 
<a href="read_csv.php">read_csv</a>
<?php
if(isset($_POST['class_number'])){
    echo "<br>class_number is set<br>";
    $input_class=$_POST['class_number'];
    echo "input_class is : $input_class";
?>
<?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}




//table opened
//alter keys and dbname here

//
// /* q1,q2,q3,q4,q5, */
// <td> q1</td><td>q2</td><td>q3</td><td>q4</td><td>q5</td> 
}
echo('<table border="1">'."\n");
?>
<tr>
<td>class_counter</td>
<td>class_id</td>
<td>class stage</td><td>class number</td>
<td>main teacher</td>
<td>co-teacher</td>
<td>start date</td><td>open1</td><td>open2</td><td>open3</td> 
<td>graduate date</td>
<td></td>
</tr>
<?php
$class_counter=1;
$stmt = $pdo->query("SELECT class_id,
	class_stage, class_number,
	d_teacher,co_teacher,start_date,open1,open2,open3,graduate_date
	FROM classes 
	");
if(isset($_POST['class_number'])){
	$stmt = $pdo->prepare("SELECT class_id,
	class_stage, class_number,
	d_teacher,co_teacher,start_date,open1,open2,open3,graduate_date
	FROM classes 
	WHERE class_number = :class_number
	");//
	$stmt->execute(array(
        ':class_number'=>$input_class
    ));
}

while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
	echo ("<tr><td>");//row start
	echo $class_counter;
	echo "</td><td>";
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
    $class_counter++;
}
?>
</table>

</body>
</html>