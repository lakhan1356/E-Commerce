<?php   
    @$name = $_POST["name"];
    @$con_pass = $_POST['con_pass'];
    @$email = $_POST['email'];
    @$password = $_POST['password'];
    @$mobile_number = $_POST['mobile_number'];
    @$addr_line_two = $_POST['Address_line_two'];
    @$addr_line_three = $_POST['Address_line_three'];
	@$submit = $_POST['submit'];
	
    if(isset($submit)){
		
		
		$connection = mysqli_connect('localhost','root','','web_tech');
		if(!$connection){
			die("Connection failed");
		}
		
        if(isset($name) && isset($con_pass) && isset($email) && isset($password) && isset($mobile_number) && isset($addr_line_two) &&isset($addr_line_three)
			&& !empty($name) && !empty($con_pass) && !empty($email) && !empty($password) && !empty($mobile_number) && !empty($addr_line_two) && !empty($addr_line_three)){
			if($password == $con_pass){
				$password = mysqli_real_escape_string($connection , $password);
				$name = mysqli_real_escape_string($connection , $name);
				$query = "INSERT INTO users(name,email,password,mobile_number,addr_line_one,addr_line_two) ";
				$query .="VALUES('$name','$email','$password',$mobile_number,'$addr_line_two','$addr_line_three')";
				
				$result = mysqli_query($connection,$query);
				if(!$result){
					die('Fields could not be entered');
				}
					$name = "Anurags";
					$value = 100;
					$expiration = time() + (60*60*24*7);
					if(!setcookie($name,$value,$expiration)){
						echo 'Cookie not set';
					}
					if(session_start()){
						echo 'session started';
					}
					echo '<script>alert("Congratulation you have been registered");</script>';
			}
			else{
				echo "<script>alert('Password does not match');</script>";
				die();
			}
		}
		else{
			echo "<script>alert('Please fill in all details');</script>";
			die();
		}
    }
?>
