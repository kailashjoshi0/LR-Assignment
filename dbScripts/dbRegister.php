<?php
session_start();

require_once("dbConnector.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$number = trim($_POST['mnumber']);
	$sql = "INSERT INTO users (username,password,email,mobile) values(?,?,?,?)";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, 'ssss',$username, $password, $username, $number);
	if(mysqli_stmt_execute($stmt)) {
		$_SESSION['registered'] = true;
		header("location: ../index.php");
	}
	else {
		$_SESSION['registered'] = false;
		header("location: ../index.php");
	}
}

?>