<?php
	include 'dbcon.php';
	session_start();
	if(isset($_POST['vote_button'])){
		
		$voter_id = $_SESSION['login-user-id'];
		$election_users_id = $_POST['vote_button'];
		echo $election_users_id;
		$query_election_users = mysql_query("SELECT * FROM `election_users` WHERE `election_users_id` = $election_users_id");
		$details = mysql_fetch_assoc($query_election_users);
		$new_votes = $details['votes'] + 1;
		$election_id = $details['election_id'];
		$user_id = $details['user_id'];

		$update_election_users = mysql_query("UPDATE `election_users` SET `votes` = $new_votes WHERE `election_users_id` = $election_users_id");
		$insert_votes = mysql_query("INSERT INTO `vote2`(`voter_id`, `election_id`, `nominee_id`) VALUES($voter_id, $election_id, $user_id)");

		if(!$update_election_users || !$insert_votes){
			die(mysql_error()." Something went wrong");
		}
		else{
			header("location: profile.php");
		}
	}
	else if(isset($_POST['view-profile'])){
		//echo $_POST['view-profile'];
		$_SESSION['view-profile'] = $_POST['view-profile'];
		header("location: nominee_profile.php");
	}
	else{
		header("location: index.php");
	}



?>