<?php
include "dbcon.php";

include "header.php";
session_start();
if(!isset($_SESSION['login-user']) && $_SESSION['role'] != 'admin'){
	header("location: index.php");
}
?>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">IIITM Student Election</a>
            </div>
        </div>
    </nav>

    <br>
    <br>
<div class="container">
<!-- header buttons -->
	<div>
		<form action="" method = "GET">
			<button class="btn btn-primary" name = "add-user">Add User</button>
			<button class="btn btn-success" name = "add-admin">Add Admin</button>
			<button class="btn btn-default" name = "add-position">Add Position</button>
			<button class="btn btn-warning" name = "add-election">Add Election</button>
			<button class="btn btn-warning" name = "add-nominees">Add Nominees</button>

			<button class="btn btn-danger" name = "update-result">Update Result</button>
			<a href="logout.php" class="btn btn-danger">Logout</a>
		</form>
	</div>


<!-- Add User -->
<?php
	if(isset($_GET['add-user'])){
?>
	<div>
		<form role="form" method = "POST" action="">
		  <div class="form-group">
		    <label for="fname">First Name</label>
		    <input type="text" class="form-control" id="fname" name="fname" required>
		  </div>
		  <div class="form-group">
		    <label for="lname">Last Name</label>
		    <input type="text" class="form-control" id="lname" name="lname" required>
		  </div>
		  <div class="form-group">
		    <label for="roll">Roll Number</label>
		    <input type="text" class="form-control" id="roll" name="roll" required>
		  </div>
		  <div class="form-group">
		    <label for="pass">Password</label>
		    <input type="password" class="form-control" id="pass" name="pass" required>
		  </div>
		  <div class="form-group">
		    <label for="bio">Bio</label>
		    <input type="text" class="form-control" id="bio" name="bio">
		  </div>
		  <button type="submit" name = "add-user" class="btn btn-default">Submit</button>
		</form>
	</div>

<?php
	}
?>

<!-- add admin -->
<?php
	if(isset($_GET['add-admin'])){
?>
	<div>
		<form role="form" method = "POST" action="">
		  <div class="form-group">
		    <label for="fname">First Name</label>
		    <input type="text" class="form-control" id="fname" name="fname" required>
		  </div>
		  <div class="form-group">
		    <label for="lname">Last Name</label>
		    <input type="text" class="form-control" id="lname" name="lname" required>
		  </div>
		  <div class="form-group">
		    <label for="roll">Roll Number</label>
		    <input type="text" class="form-control" id="roll" name="roll" required>
		  </div>
		  <div class="form-group">
		    <label for="pass">Password</label>
		    <input type="password" class="form-control" id="pass" name="pass" required>
		  </div>
		  <button type="submit" name = "add-admin" class="btn btn-default">Submit</button>
		</form>
		<span style="color:red;">Current user will be added as admin</span>
	</div>

<?php
	}
?>

<!-- Add Position -->
<?php
	if(isset($_GET['add-position'])){
?>
	<div>
		<form role="form" method = "POST" action="">
		  <div class="form-group">
		    <label for="position_name">Position</label>
		    <input type="text" class="form-control" id="position_name" name="position_name" required>
		  </div>
		  <div class="form-group">
		    <label for="details">Details</label>
		    <textarea type="text" class="form-control" id="details" name="details" required></textarea>
		  </div>
		  
		  <button type="submit" name = "add-position" class="btn btn-default">Submit</button>
		</form>
	</div>

<?php
	}
?>

<!-- add election -->
<?php
	
	if(isset($_GET['add-election'])){
		$position_query = mysql_query("SELECT * FROM `positions`");
?>
	<div>
		<form role="form" method = "POST" action="">
		  <div class="form-group">
		    <label for="ename">Election Name</label>
		    <input type="text" class="form-control" id="ename" name="ename" required	>
		  </div>


		  <div class="form-group">
		    <label for="position">Position</label>
		     <select class="form-control" name="position">
		    <?php

		    	while($iter = mysql_fetch_assoc($position_query)){
		    		 $position_id = $iter['position_id'];
		    		 $position_name = $iter['position_name'];
		    		 echo "<option value='$position_id'>$position_name</option>";
		    	}
		    ?>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="year">Year</label>
		    <input type="text" class="form-control" id="year" name="year" required>
		  </div>
		  <div class="form-group">
		    <label for="details">Details</label>
		    <textarea type="text" class="form-control" id="details" name="details"></textarea>
		  </div>
		  <button type="submit" name = "add-election" class="btn btn-default">Submit</button>
		</form>
	</div>

<?php
	}
?>

<!-- add nominees -->
<?php
	
	if(isset($_GET['add-nominees'])){
		$user_query = mysql_query("SELECT * FROM `users`");
	$election_query = mysql_query("SELECT * FROM `elections` WHERE `active` = 1 AND `members_added` = 0");
?>
	<div>
		<form role="form" method = "POST" action="">
		
		  <div class="form-group">
		    <label for="election">Election</label>
		     <select class="form-control" name="election">
		    <?php
		    	while($iter = mysql_fetch_assoc($election_query)){
		    		 $election_id = $iter['election_id'];
		    		 $election_name = $iter['election_name'];
		    		 echo "<option value='$election_id'>$election_name</option>";
		    	}
		    ?>
		    </select>
		  </div>

		  <div class="form-group">
		    <label for="user1">User 1</label>
		     <select class="form-control" name="user1">
		    <?php
		    	while($iter = mysql_fetch_assoc($user_query)){
		    		 $user_id = $iter['user_id'];
		    		 $roll_no = $iter['roll_no'];
		    		 echo "<option value='$user_id'>$roll_no</option>";
		    	}
		    	mysql_data_seek($user_query, 0);
		    ?>
		    </select>
		  </div>

		  <div class="form-group">
		    <label for="user2">User 2</label>
		     <select class="form-control" name="user2">
		    <?php
		    	while($iter = mysql_fetch_assoc($user_query)){
		    		 $user_id = $iter['user_id'];
		    		 $roll_no = $iter['roll_no'];
		    		 echo "<option value='$user_id'>$roll_no</option>";
		    	}
		    	mysql_data_seek($user_query, 0);
		    ?>
		    </select>
		  </div>

		  <div class="form-group">
		    <label for="user3">User 3</label>
		     <select class="form-control" name="user3">
		    <?php
		    	while($iter = mysql_fetch_assoc($user_query)){
		    		 $user_id = $iter['user_id'];
		    		 $roll_no = $iter['roll_no'];
		    		 echo "<option value='$user_id'>$roll_no</option>";
		    	}
		    	mysql_data_seek($user_query, 0);
		    ?>
		    </select>
		  </div>

		  <div class="form-group">
		    <label for="user4">User 4</label>
		     <select class="form-control" name="user4">
		    <?php
		    	while($iter = mysql_fetch_assoc($user_query)){
		    		 $user_id = $iter['user_id'];
		    		 $roll_no = $iter['roll_no'];
		    		 echo "<option value='$user_id'>$roll_no</option>";
		    	}
		    	mysql_data_seek($user_query, 0);
		    ?>
		    </select>
		  </div>
		  <button type="submit" name = "add-nominees" class="btn btn-default">Submit</button>
		</form>
	</div>

<?php
	}
?>

<!-- update result -->
<?php
	if(isset($_GET['update-result'])){
		$election_query = mysql_query("SELECT * FROM `elections` WHERE `active` = 1");
?>
	<div>
		<form role="form" method = "POST" action="">
		 
		  <div class="form-group">
		    <label for="election">Election</label>
		     <select class="form-control" name="election">
		    <?php

		    	while($iter = mysql_fetch_assoc($election_query)){
		    		 $election_id = $iter['election_id'];
		    		 $election_name = $iter['election_name'];
		    		 echo "<option value='$election_id'>$election_name</option>";
		    	}
		    ?>
		    </select>
		  </div>
		 
		  <button type="submit" name = "update-result" class="btn btn-default">Submit</button>
		</form>
	</div>

<?php
	}
?>

</div>
<?php
	// add-user
	if (isset($_POST['add-user'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$roll = $_POST['roll'];
		$pass = md5($_POST['pass']);
		$bio = $_POST['bio'];
		$insert_user = mysql_query("INSERT INTO `users`(`roll_no`, `fname`, `lname`, `password`, `bio`) VALUES ('$roll','$fname','$lname','$pass', '$bio')");
		if(!$insert_user){
			die(mysql_error()."Something went wrong");
		}
		else
			header('location: admin.php');

	}
	// add-admin
	if (isset($_POST['add-admin'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$roll = $_POST['roll'];
		$pass = md5($_POST['pass']);
		$insert_admin = mysql_query("INSERT INTO `users`(`roll_no`, `fname`, `lname`, `password`, `role`) VALUES ('$roll','$fname','$lname','$pass', 'admin')");
		if(!$insert_admin){
			die(mysql_error()."Something went wrong");
		}
		else
			header('location: admin.php');
	}

	// add-position
	if (isset($_POST['add-position'])){
		$position_name = $_POST['position_name'];
		$details = $_POST['details'];
		$insert_position = mysql_query("INSERT INTO `positions`(`position_name`, `details`) VALUES ('$position_name','$details')");
		if(!$insert_position){
			die(mysql_error()."Something went wrong");
		}
		else
			header('location: admin.php');

	}

	// add-election
	if (isset($_POST['add-election'])){
		$ename = $_POST['ename'];
		$position = $_POST['position'];
		$year = $_POST['year'];
		$details = $_POST['details'];
		$insert_election = mysql_query("INSERT INTO `elections`(`election_name`, `position_id`, `year`, `details`) VALUES ('$ename',$position,$year,'$details')");
		if(!$insert_election){
			die(mysql_error()."Something went wrong");
		}
		else
			header('location: admin.php');
	}

	// add-nominees
	if (isset($_POST['add-nominees'])){
		$election = $_POST['election'];
		$user1 = $_POST['user1'];
		$user2 = $_POST['user2'];
		$user3 = $_POST['user3'];
		$user4 = $_POST['user4'];

		$insert_nominees = mysql_query("INSERT INTO `election_users`(`election_id`, `user_id`) VALUES ('$election',$user1), ('$election',$user2), ('$election',$user3), ('$election',$user4)");
		$update_election = mysql_query("UPDATE `elections` SET `members_added`=1 WHERE `election_id` = $election");
		if(!$insert_nominees || !$update_election){
			die(mysql_error()."Something went wrong");
		}
		else
			header('location: admin.php');
	}

	// update-result
	if (isset($_POST['update-result'])){
		$election = $_POST['election'];
		$update_election = mysql_query("UPDATE `elections` SET `active`= 0 WHERE `election_id` = '$election'");
		$query_election_users = mysql_query("SELECT * from `election_users` where `election_id` = $election and `votes`in (SELECT MAX(votes) as votes from `election_users` where `election_id` = $election)");
		$user_id = mysql_fetch_assoc($query_election_users)['user_id'];
		
		$insert_result = mysql_query("INSERT INTO `results`(`election_id`, `user_id`) VALUES ('$election', '$user_id')");

		if(!$update_election || !$query_election_users || !$insert_result){
			die(mysql_error()."Something went wrong");
		}
		else
			header('location: admin.php');
		
	}

?>
</body>



