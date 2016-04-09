<?php
require_once('connection.inc.php');

$req=$_SERVER['REQUEST_METHOD'];

if($req=='POST'){
	if(isset($_POST['action'])){

if($_POST['action']=='register'){
	
		$result=mysqli_query($connection,"SELECT `mobile` FROM `app`.`users` WHERE `mobile`='{$_POST['mobile']}'");
		$row_cnt = mysqli_num_rows($result);
		if($row_cnt>0)
		{
			$error=1;
			$message="This mobile number is already registered!!";
            return $message;
		}

		else{
			$password=md5($_POST['pass']);
		$sql="INSERT INTO `app`.`users`(`name`,`mobile`,`gender`,`password`)VALUES('{$_POST['name']}','{$_POST['mobile']}','{$_POST['gender']}','$password')";
		mysqli_query($connection,$sql);
	        }
	
}
elseif($_POST['action']=='login'){
	
   $result=mysqli_query($connection,"SELECT `password`,`name` FROM `app`.`users` WHERE `mobile`='{$_POST['mobile']}'");
   $row_cnt = mysqli_num_rows($result);
   if($row_cnt>0)
   {
     $login=mysqli_fetch_assoc($result);
     $login_pass=$login['password'];
     $login_name=$login['name'];
     if($login_pass==md5($_POST['pass'])){
     	$_SESSION['name']=$login_name;
     	return true;
     }
     else{ 
     $error=1;   
     $message="Password and email address combination does not match!!";
     return $message;
     }
   }
   else
   {
   	$error=1;
   	$message="Entered email address is not registered!!";
   	return $message;
   }
}
elseif($_POST['action']=='alert'){
$type=$_POST['type'];
	$result=mysqli_query($connection,"SELECT `password`,`name` FROM `app`.`users` WHERE `mobile`='{$_POST['mobile']}'");
    $row_cnt = mysqli_num_rows($result);
     if($row_cnt>0)
   {
     $user=mysqli_fetch_assoc($result);
   }
	if($type=="road-accident"){
    $amb=1;
    $pol=1;
    $data = array( $user,$amb,$pol,$fb);
	}
	elseif($type=="earthquake"){
    $amb=1;
    $data = array( $user,$amb,$pol,$fb);
	}
	elseif($type=="fire"){
    $amb=1;
    $pol=1;
	$fb=1;
	$data = array( $user,$amb,$pol,$fb);
	}	
}
	}
	else
	{
	die("require action");
	}
}elseif($req=='GET')
{
	
}
echo json_encode( $data);
?>
