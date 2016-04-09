<?php

$req=$_SERVER['REQUEST_METHOD'];

if($req=='POST'){
	if(isset($_POST['action'])){

if($_POST['action']=='register'){
	
	
}
elseif($_POST['action']=='login'){
	
}
elseif($_POST['action']=='alert'){
	
}
	}
	else
	{
	die("require action");
	}
}elseif($req=='GET')
{
	
}

?>