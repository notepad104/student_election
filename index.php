<?php
session_start();
if (isset($_SESSION['login-user'])){
	header('location: profile.php');
}	
include 'login.php'; // Includes Login Script



?>

<?php
	include 'header.php';
?>

<style type="text/css">
body{
	background: url('/vote/voting/images/logo200.png') no-repeat center bottom;
  	background-size: 300px, 130px, auto;
}
</style>
</head>
<body>
<div id = 'header'>
</div>
<div id = 'content'>
<div class="container">
	<div class="text-center" style="padding:50px 0;">
		<div class="logo">
		<h1>login</h1>
		</div>
		<!-- Main Form -->
		<div class="login-form-1">
			<form action = "" class="text-left" method = "POST">
				<div class="login-form-main-message"></div>
				<div class="main-login-form">
					<div class="login-group">
						<div class="form-group">
							<label for="lg_username" class="sr-only">Roll No</label>
							<input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="Roll No">
						</div>
						<div class="form-group">
							<label for="lg_password" class="sr-only">Password</label>
							<input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
						</div>
					</div>
					<button type="submit" name = 'submit' class="login-button"><i class="fa fa-chevron-right"></i>Login</button>
					<span style = "color:red;"><?php echo $error; ?></span>
				</div>
			</form>
			
		</div>
		<!-- end:Main Form -->
	</div>

</div>
</div>

	</body>
</html>