<?php
	session_start();
	if(!isset($_SESSION['login-user'])){
        header("location: index.php");
    }
	include 'dbcon.php';
	if(isset($_POST['add-post'])){
		$post = $_POST['post'];
		$user = $_POST['add-post'];
		$insert_post = mysql_query("INSERT INTO `posts`(`user_id`, `post`) VALUES ($user,'$post')");
		if(!$insert_post){
			die(mysql_error()."Something went wrong");
		}
		else
			header("location: nominee_profile.php");
	}
	

?>