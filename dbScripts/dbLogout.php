<?php

session_start();

$_SESSION["loggedin"] = false;
$_SESSION["adminlogin"] = false;
header("location: ../index.php");

?>