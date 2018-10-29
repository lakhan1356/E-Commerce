<?php   
    @$name = $_POST["name"];
    @$con_pass = $_POST['con_pass'];
    @$username = $_POST['username'];
    @$password = $_POST['password'];
    @$addr_line_one = $_POST['Address_line_one'];
    @$addr_line_two = $_POST['Address_line_two'];
    @$addr_line_three = $_POST['Address_line_three'];
	@$submit = $_POST['submit'];
    if(isset($submit)){
		
		$connection = mysqli_connect('localhost','root','','web_tech');
		if($connection){
			echo "Connected to the server <br/>";
		}
		else{
			die("Connection failed");
		}
		
        if(isset($name) && isset($con_pass) && isset($username) && isset($password) && isset($addr_line_one) && isset($addr_line_two)
			&& !empty($name) && !empty($con_pass) && !empty($username) && !empty($password) && !empty($addr_line_one) && !empty($addr_line_two)){
			echo "Done";
			
			$query = "INSERT INTO users(name,con_pass,username,password) ";
			$query .="VALUES('$name','$con_pass','$username','$password')";
			
			$result = mysqli_query($connection,$query);
			if(!$result){
				die('Fields could not be entered');
			}
		}
		else{
			echo "Please fill in all the details";
		}
    }
?>
<script>
  alert("Congratulation you have been registered");
</script>