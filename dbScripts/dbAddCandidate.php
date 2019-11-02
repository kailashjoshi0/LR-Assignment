<?php
session_start();

require_once("dbConnector.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = trim($_POST['name']);
	$location = trim($_POST['loc']);
	$sql = "INSERT INTO candidates (candidate_name,candidate_region) values(?,?)";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, 'ss',$name, $location);
	if(mysqli_stmt_execute($stmt)) {
		$_SESSION['added'] = true;
		header("location: ../viewVoteDetails.php");
	}
	else {
		$_SESSION['added'] = false;
		header("location: ../viewVoteDetails.php");
	}
}

?>