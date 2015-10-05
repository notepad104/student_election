<?php 
	if(!isset($_SESSION['login-user'])){
		header('location: index.php');
	}
?>