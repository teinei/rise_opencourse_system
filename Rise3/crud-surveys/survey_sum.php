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
header('Location: ../crud-sums/index.php');
?>