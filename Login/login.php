<?php
	require_once 'config.php';
	require_once 'inc/function.inc.php';
	require_once 'inc/session.php';

	error_reporting(E_ERROR | E_PARSE);

	$errormsg = array("Login successful", "Access disabled", "Incorrect Username - Password combination",);

	if(isLoggedin())
	{
		header("Location: doctor.php");
	}

	if(isset($_POST['submit']))
	{
		$entered_username 	= ($_POST['username']);
		$entered_pass		= md5($_POST['pass']);
		
		$query = "SELECT * FROM `patients` WHERE `name`='$entered_username' AND `password`='$entered_pass'";

		$query_row = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($query_row)>0){
        
		if(isset($query_row['did'])) 
		{
			
				$_SESSION['dname']= $query_row['name'];
				$error = 0;
			
		} 
		else
		{
			$error = 2;
		}
	}
		$message = $errormsg[$error];
		if($error==0)
			header("Location: doctor.php");
		else
			echo "<script type='text/javascript'>alert('$message');</script>";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="images/icon.png">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	
	<title>Login</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<header>
				<div class="col-md-6 col-sm-4 col-xs-4">
					<img src="images/csi_logo.png" alt="CSI NSIT Logo">
				</div>

				<div class="col-md-6 col-sm-8 col-sm-8 text-right text-uppercase">
					
				</div>
			</header>
		</div>
		
		<div class="row">
			<div class="col-md-12">
			<hr>
				<form  action="login.php" id = "login_form" method="POST" >
					<div class="form-group">
						<label>Username*</label>
						<input type="username" class="form-control" placeholder="username" name="username" required autofocus>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" placeholder="Password" name="pass" required>
					</div>
					<button type="submit" class="btn btn-default" name="submit" >Submit</button>
				</form>
				<hr>
				<a href ="Login\reg.html"><button class="btn btn-default">New user? Register</button>
			</div>
		</div>		
	</div>

</body>
</html>
