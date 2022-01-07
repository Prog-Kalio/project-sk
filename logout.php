<?php session_start();

	unset($_SESSION['cust_email']);
	session_destroy();

	header("Location: index.php");

?>