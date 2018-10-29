<?php

@$name = $_POST["name"];
@$email = $_POST['email'];
@$password = $_POST['password'];
@$submit = $_POST['submit'];
if(isset($submit)){
	
		$connection = mysqli_connect('localhost','root','','web_tech');
		if(!$connection){
			die("Connection failed");
		}
		
	if(isset($email) && isset($password) && !empty($email) && !empty($password)){
		$query = "SELECT email, password FROM users WHERE email = '".$email."' AND  password = '".$password."'";
		$result = mysqli_query($connection,$query);
		if($result){
			if(mysqli_num_rows($result) == 1 )
			{ 
			echo "<script>alert('Successfully login')</script>";
			echo "<h1>Welcome to you Shopfreak Account</h1>";
			$query = "SELECT $name FROM users WHERE email = '".$email."' , password = '".$password."'";
			$result = mysqli_query($connection,$query);
			if($result){
				$row = mysql_fetch_array($result);
				echo $row[$name];
			}
			}
			else
			{
				echo "<script>alert('Incorrect email or password')</script>";
				echo 'Login unsuccessful';
			}
		}
	}
	else{
		echo 'query failed';
	}
}
?>