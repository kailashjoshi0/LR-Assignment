<?php
session_start();

require_once("dbConnector.php");
$username = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty(trim($_POST['username'])) || empty(trim($_POST['password']))) {
		alertAndNavigate("Please enter valid username and password");
	}
	else {
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$sql = "SELECT vote, username from users where username=? and password=?";
		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, "ss", $username, $password);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		if (mysqli_stmt_num_rows($stmt) == 1) {
			mysqli_stmt_bind_result($stmt, $isVoted, $username);
			if (mysqli_stmt_fetch($stmt)) {
				$_SESSION["loggedin"] = true;
	            $_SESSION["isVoted"]  = $isVoted;
	        	$_SESSION["username"] = $username;
	        	header("location: ../startVote.php");
	        }
		}
		else {
			$msg = "Wrong username or password";
			alertAndNavigate($msg);
		}
	}
}

function alertAndNavigate($msg){
	echo '<script language="javascript">';
    echo 'alert("' . $msg . '");';
    echo 'window.location.href = "../index.php";';
    echo '</script>';
}

?>