<?php
require_once 'config.php';

	$errormsg = array("Registration successful", "Username already used", "Technical glitch. Try again.");

	if(isset($_POST['submit']))
	{   
		$entered_username		= $_POST['username'];
		$entered_pass			= md5($_POST['pass']);
		$entered_conf_pass		= md5($_POST['confpass']);
 
		$query = "SELECT `name` FROM `doctors` WHERE `name`='{$entered_username}'";
		
		if(mysqli_num_rows(mysqli_query($conn, $query))!=0)
		{
			$error = 1;
		} 
		else 
		{   
			if($entered_pass==$entered_conf_pass){
			$query = "INSERT INTO `doctors` (`Name`,`password`) 
			VALUES ('$entered_username','$entered_pass')";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
			if($result)
			{
				$error = 0;
			} 
			else 
			{
				$error = 2;
			}
		}

	else{
		$error=1;
	}
	}
		echo "<script>alert('".$errormsg[$error]."');</script>";
		if($error==0)
			header("Location:Login\login.php");
		else
			header("Location:Login\reg.php");
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
	
	<title>Registrartion</title>
</head>
<body>
	<div class="container">
		
		<div class="row">
			<div class="col-md-12">
			<hr>
				<form  action="reg.php"  method="POST" >
					<div class="form-group">
						<label>Username *</label>
						<input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
					</div>
					<div class="form-group">
						<label>Password *</label>
						<input type="password" class="form-control" placeholder="Password" name="pass" required>
					</div>
					<div class="form-group">
						<label>Confirm Password *</label>
						<input type="password" class="form-control" placeholder="Password" name="confpass" required autocomplete="off">
					</div>
					<button type="submit" class="btn btn-default" name="submit">Submit</button>
				</form>
			</div>
		</div>		
	</div>
</body>
</html>
