<?php
require_once("dbConnector.php");

function checkUserStatus(){
	$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	$sql = "SELECT vote from users where username = ?";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt,'s',$_SESSION['username']);
	if(mysqli_stmt_execute($stmt)) {
		mysqli_stmt_store_result($stmt);
		if (mysqli_stmt_num_rows($stmt) == 1) {
			mysqli_stmt_bind_result($stmt, $vote);
			mysqli_stmt_fetch($stmt);
			if ($vote == 0) {
				return "enabled";
			}
			else
				return "disabled";
		}
	}
}
?>