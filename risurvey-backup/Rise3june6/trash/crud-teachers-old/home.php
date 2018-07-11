<?php
require_once 'pdo.php';
//session_start();
?>
<html>
<head></head>
<body>
<?php
if(isset($_SESSION['error'])){
?>	<p style="color:red"><?= $_SESSION['error'] ?></p>
<?php
	unset($_SESSION['error']);
}
if(isset($_SESSION['success'])){
?>	<p style="color:green"><?= $_SESSION['success'] ?></p>
<?php
	unset($_SESSION['success']);
}
?>

<table border="1">
<tr>
		<td></td>
		<td>teacher name</td>
		<td>teacher's email</td>
		<td>teacher's password</td>
		<td></td>
	</tr>
<?php //print a table out
$stmt = $pdo->query("SELECT teacher_id,teacher_name,password,email FROM teachers");

//while loop
$fake_id=1;
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
?>	
	<tr>
		<td><?=$fake_id?></td>
		<td>
			<?= htmlentities($row['teacher_name']) ?>
		</td><td>
			<?= htmlentities($row['email']) ?>
		</td><td>
			<?= htmlentities($row['password']) ?>
		</td><td>
	<?php	
			/*<a href="edit.php?teacher_id="<?= $row['teacher_id']?>"">Edit</a> */
			echo('<a href="edit.php?teacher_id='  .  $row['teacher_id']  .  '">Edit</a> /');
			/*<a href="delete.php?teacher_id='<?php $row['teacher_id'] ?>'">Delete</a>*/
			echo('<a href="delete.php?teacher_id='  .  $row['teacher_id']  .  '">Delete</a>');
	?>
		</td></tr>
<?php
	$fake_id++;
} // I forget to close while loop.
?>

</table>
<a href="add.php">Add New</a>

</body>
</html>
