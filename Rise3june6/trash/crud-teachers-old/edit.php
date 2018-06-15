<body>
<?php
require_once "pdo.php";
session_start();

//$b1=isset($_POST['teacher_name']);
//echo "<p>$b1</p>";

/*
if( isset($_POST['teacher_id'])
&& isset($_POST['teacher_name'])
&& isset($_POST['email'])
&& isset($_POST['password'])
){

	//echo "1";
    $sql="UPDATE teachers SET teacher_name=:name,email=:email,password=:password
    WHERE teacher_id=:teacher_id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
        ':teacher_name'=>$_POST['teacher_name'],
        ':email'=>$_POST['email'],
        ':password'=>$_POST['password'],
        ':teacher_id'=>$_POST['teacher_id']
    ));
    $_SESSION['success']='Record updated';
    header('Location: edit.php');
    return;
}
*/

$stmt=$pdo->prepare("SELECT * FROM teachers WHERE teacher_id=:xyz");
$stmt->execute(array(":xyz"=>$_GET['teacher_id']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

/*
if($row===false){
	//echo "2";
    $_SESSION['error']="Bad value for teacher_id";
    header('Location: edit.php');
    return;
}
*/
$n=htmlentities($row['teacher_name']);
$e=htmlentities($row['email']);
$p=htmlentities($row['password']);
$teacher_id=$row['teacher_id'];
?>

<p>edit teachers</p>
<form method="post" action="">
    <p>name: <input type="text" name="teacher_name" value="<?= $n ?>"></p>
    <p>email: <input type="text" name="email" value="<?= $e ?>"></p>
    <p>password: <input type="password" value="<?= $p ?>"></p>
    <input type="hidden" name="teacher_id" value="<?= $teacher_id ?>">
	<p><input type="submit" value="update">
    <a href="home.php">cancel</a></p>
</form>
</body>
