<?php
require_once "pdo.php";
session_start();
?>
<html>
<head>
<meta content="text/html; charset=utf-8">
</head>
<body>
<a href="index.php">back</a>
<br><br>

<?php
$sum_id='';
$open_date=0;
$class_name=0;
$main_teacher=0;
$co_teacher=0;
$average=0;
$text1=0;
$text2=0;
$text3=0;
echo('<table border="1">'."\n");
//table begins
$stmt = $pdo->query("SELECT 
*
FROM 
survey_sum");//
?>
<tr>
<td>sum_id</td><td>open_date</td>
<td>main_teacher</td> <td>co_teacher</td> 
<td>average</td>
<td> text1</td><td>text2</td><td>text3</td>
</tr>
<?php
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
	//
$sum_id='';
$open_date=0;
$class_name=0;
$main_teacher=0;
$co_teacher=0;
$average=0;
$text1=0;
$text2=0;
$text3=0;
	echo ("<tr><td>");//row start
	echo(htmlentities($row['sum_id']));
	echo("</td>");
	//
	
	echo "<td>";
    echo('<a href="edit.php?sum_id='.$row['sum_id'].'">Edit</a> / ');
    echo('<a href="delete.php?sum_id='.$row['sum_id'].'">Delete</a>');
    echo("</td></tr>\n");
}
?>
</table>