<?php
require_once "pdo.php";
session_start();

if(isset($_POST['name'])&& isset($_POST['email'])
    && isset($_POST['password']) ){
    //
	echo "1";
	
    if(strlen($_POST['name'])<1 ||strlen($_POST['password'])<1 ){
        $_SESSION['error']='Missing data';
        header("Location: add.php");
        return;
    }
	/*
    if(strpos($_POST['email'],'@')===false){
        $_SESSION['error']='bad data';
        header("Location: add.php");
        return;
    }
	*/

    $sql="INSERT INTO teachers (teacher_name, email, password)
    VALUES (:name, :email, :password)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password']
    ));
    $_SESSION['success'] = 'record added';
    header('Location: home.php');
    return;
}

if(isset($_SESSION['error'])){
    echo '<p stype="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
?>
<p> add a new user</p>
<form method="post" action="add.php">
<p>name:<input type="text" name="name"></p>
<p>email:<input type="text" name="email"></p>
<p>password:<input type="password" name="password"></p>
<p><input type="submit" value="add new" />
<a href="home.php">cancel</a></p>
</form>
