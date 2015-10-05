<?php
	session_start();
	if(!isset($_SESSION['login-user'])){
        header("location: index.php");
    }
	include 'dbcon.php';
	include 'header.php';
	$user = $_SESSION['view-profile'];
	$query_posts = mysql_query("SELECT * FROM `posts` as P join `users` as U on P.user_id = U.user_id WHERE P.user_id = $user ORDER BY `timestamp` DESC");

	
?>

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">IIITM Student Election</a>
            </div>
             <ul class="nav navbar-nav">
             <li>
                       <a href="logout.php"><button class="btn btn-sm btn-danger" href="logout.php">Logout</button></a>
                    </li>
                   </ul>

        </div>
    </nav>
</br>
</br></br></br></br>

<div class="container">
	<div class="row">
	<?php 
		if($user == $_SESSION['login-user-id']){
	?>
	<form action = 'post.php' method = 'POST'>
		<div class="form-group">
			<label for = 'post'>Add Post</label>
			<textarea type = 'text' name = 'post' class="form-control"></textarea>
		</div>
		<div class="form-group">
			<button type="submit" name = "add-post" value = '<?php echo $user ?>' class = "btn btn-success">Post</button>
		</div>
	</form>
	<?php
		}
	?>
	</div>

	<div class="row">
		<div>
			<h2><?php $p = mysql_fetch_assoc($query_posts);
				echo $p['fname'].' '.$p['lname'];
				if(mysql_num_rows($query_posts) != 0)
					mysql_data_seek($query_posts, 0);
				?> feed</h2>
		</div>
		<div>
			<?php
				while($iter = mysql_fetch_assoc($query_posts)){
					$post = $iter['post'];
					$timestamp = $iter['timestamp'];
					echo "<div class='alert alert-info'>
							<strong>
								$post 
							</strong>
							<br>
							<span>
								$timestamp 
							</span>
							</div>
						";
				}
			?>
		</div>
	</div>
</div>

</body>