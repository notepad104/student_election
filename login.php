<?php
	include "dbcon.php";
	//include "session.php";
	//session_start();
	$error = '';
	if (isset($_POST['submit'])){
		if (empty($_POST['lg_username']) || empty($_POST['lg_password'])){
			$error = "Username or Password is invalid";
		}
		else{
			$username = $_POST['lg_username'];
			$password = $_POST['lg_password'];
			
			// To protect MySQL injection for Security purpose
			$roll_no = stripslashes($username);
			$password = stripslashes($password);
			$roll_no = mysql_real_escape_string($username);
			
			$password = md5(mysql_real_escape_string($password));
			$query = mysql_query("select * from users where password='$password' AND roll_no='$roll_no'", $connection);
			
			$rows = mysql_num_rows($query);
			if ($rows == 1){
					//$roll_no = $user['roll_no'];
					$_SESSION['login-user'] = $roll_no;
					header('location: profile.php');
			}
			else {
				$error = "Username or Password is invalid";
			}

			mysql_close($connection);	

		}
	}
?>