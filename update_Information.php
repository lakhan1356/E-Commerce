<?php
  @$email = $_POST['email'];
  @$password = $_POST['password'];
  @$con_password = $_POST['con_password'];
  @$submit = $_POST['submit'];
  if(isset($submit)){
		
		$connection = mysqli_connect('localhost','root','','web_tech');
		if(!$connection){
			die('Cannot connect to the server at the moment');
		}
		
			if(isset($email) && isset($password) && isset($con_password) && !empty($email) && !empty($password) && !empty($con_password)){
				if($password != $con_password){
					echo 'Password does not match';
				}
				
			    else
				{
				$query = "UPDATE users SET";
				$query .= " password  = '$password' ";
				$query .="WHERE email = '$email'";
				
				$result = mysqli_query($connection , $query);
				if($result){
					echo "<script>alert('Password changed successfully');</script>";
				}
				if(!$result){
					echo 'Sorry information cannot be updated';
				}
			}
		}
		else{
			echo 'Please fill in all the details';
		}
	}
		
		
        

?>
<style>

#container{
			position:relative;
			margin-top:4%;
				border : 2px solid gray;
				width:35%;
				padding:10px;
				padding-top:41px;
				padding-bottom:41px;
				border-radius:10px;
				box-shadow: 1px 1px 10px 1px rgba(0, 0, 0, 0.6);
				transition:0.5s;
			}
			#container:hover{
				transform:scale(1.05);
				transition:0.5s;
				background:rgba(255,255,255,0.6);
			}
			.textbox{
			 width:45%;
			 height:6%;
			 padding:10px;
			 border-radius:5px;
			 border: 1px solid gray;
			 <!--transition:0.5s;-->
			 
			}
			.textbox:hover{
				transform:scale(1.05);                      
				<!--transition:0.5s;-->
				
			}
			#submit{
				width:30%;
				height:6%;
			border-radius:5px;
				cursor:pointer;
				background:rgba(255,255,255,0.5);
				
				border: 1px solid gray;
			}
			body{
			 background-image:url("bg.jpeg");
			 background-size:100% 100%;
			 font-family:'Oswald',sans-serif;
			}
		</style>
<body>
	<center>
		<div id='container'>
			<form action = "update_Information.php" method = "POST">
			  <input class = "textbox" type = "email" name = "email" placeholder = "Enter your Email "><br/><br/>
			  <input class = "textbox" type = "password" name = "con_password" placeholder = "Enter new password"><br/><br/>
			  <input class = "textbox" type = "password" name = "password" placeholder = "Re-enter new password"><br/>
			  <br/><br/>
			  <input id="submit" type = "submit" name = "submit" value = "Change Password">
			</form>
		</div>
	</center>
</body>