<?php
require 'form.php';
function connect_to_database(){
  $connection = mysqli_connect('localhost','root','','web_tech');
  
		if($connection){
			echo "Connected to the server <br/>";
		}
		else{
			die("Connection failed");
		}
}

function add_information(){
	global $connection;
	
	$query = "INSERT INTO users(first_name,last_name,username,password) ";
			$query .="VALUES('$first_name','$last_name','$username','$password')";
			global $connection;
			$result = mysqli_query($connection,$query);
			if(!$result){
				die('Fields could not be entered');
			}
}
?>