<?php
session_start();
require_once("dbConnector.php");
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	$sql = "UPDATE candidates set vote_count = vote_count+1 where candidate_id =".$_POST['submitbtn'];
	$stmt = mysqli_prepare($conn, $sql);
	if(mysqli_stmt_execute($stmt)) {
		$updateSQL = "UPDATE users set vote = 1 where username = ?";
		$newStmt = mysqli_prepare($conn, $updateSQL);
		mysqli_stmt_bind_param($newStmt, "s", $_SESSION['username']);
		if(mysqli_stmt_execute($newStmt)) {
			$_SESSION["voted"] = true;
			header("location: ../startVote.php");
		}

	}
}
?>