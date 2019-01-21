<!doctype html>
<?php
	session_start();
 	$_SESSION = array();
	session_destroy();
 	header("location:https://plateforme.alwaysdata.net/index.php");
 	exit();
?>