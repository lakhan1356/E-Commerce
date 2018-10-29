<?php
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"shop");
	ob_start();
	session_start();
	

	$error = false;

	if ( isset($_POST['submit']) ) {
		
		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);

		
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$phone = trim($_POST['phone']);
		$phone = strip_tags($phone);
		$phone = htmlspecialchars($phone);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		$dob = trim($_POST['dob']);
		$dob = strip_tags($dob);
		$dob = htmlspecialchars($dob);
		
		$add1 = trim($_POST['Address_line_two']);
		$add1 = strip_tags($add1);
		$add1 = htmlspecialchars($add1);
		
		$add2 = trim($_POST['Address_line_three']);
		$add2 = strip_tags($add2);
		$add2 = htmlspecialchars($add2);
		
		$gen = trim($_POST['gender']);
		$gen = strip_tags($gen);
		$gen = htmlspecialchars($gen);
		
		
		
		

		// basic name validation
		if (empty($name)) {
			/*$error = true;
			$nameError = "Please enter your full name.";
			echo "$nameError";*/
		} else if (strlen($name) < 3) {
			$error = true;
			$nameError = "Name must have atleat 3 characters.";
			echo "$nameError";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
			echo "$nameError";
		}
		
		//username validation
		if (empty($gen)) {
			$error = true;
			$userError = "Please enter a gender.";
			echo "$userError";
		} 
		 
		
		
		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
			echo "$emailError";
		} else {
			// check email exist or not
			$query = "SELECT email FROM register WHERE email='$email'";
			$result = mysqli_query($con,$query);
			$count = mysqli_num_rows($result);
			if($count!=0){
				$error = true;
				$emailError = "Provided Email is already in use.";
				echo "$emailError";
			}
		}
		
		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have atleast 6 characters.";
			echo "$passError";
		}

		//phone validation
		if (empty($phone)){
			$error = true;
			$passError = "Please enter phone.";
			echo "$passError";
		}
		
		// password encrypt using SHA256();
		#$password = hash('sha256', $pass);

		// if there's no error, continue to signup
		if( !$error ) {

			echo "dasdsadas";
			$res = mysqli_query($con,"INSERT INTO register VALUES('$name','$pass','$email','$add1','$add2','$dob','$gen','$phone')");
			echo "dwqw";
			if (!$res)
				echo "run";
			
			
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				unset($name);
				unset($email);
				unset($pass);
				header("Location: home.html");
			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";
			}
		}
		else
			echo "danger";
		
	}
?>


<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300|Oswald:200,300,400,500,600,700|Roboto+Slab:300 rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
		<title>Login/Signup</title>
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
			
			#container2{
			visibility:hidden;
			position:relative;
			margin-top:-35%;
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
			#container2:hover{
				transform:scale(1.05);
				transition:0.5s;
				background:rgba(255,255,255,0.6);
			}
			.address{
			width:64%;
			height:6%;
			 padding:10px;
			 border-radius:5px;
			 border: 1px solid gray;
			 <!--transition:0.5s;-->
			 
			}
			.address:hover{
				transform:scale(1.05);
				<!--transition:0.5s;-->
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
				width:20%;
				height:6%;
			border-radius:5px;
				cursor:pointer;
				background:rgba(255,255,255,0.5);
				
				border: 1px solid gray;
			}
			#submit:hover{
			 transform : scale(1.05);
			 
			}
			
			#signup_btn{
				position:absolute;
				top:30%;
				left:20%;
				width:8%;
				height:6%;
				border-radius:5px;
				cursor:pointer;
				background:rgba(255,255,255,0.5);
				
				border: 1px solid gray;
			}
			#login_btn{
				position:absolute;
				top:30%;
				left:73%;
				width:8%;
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
			.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid black;
  border-bottom: 16px solid white;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  position:fixed;
  top:45%;
  left:45%;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
#overlay{
	height:100%;
	width:100%;
	background:rgba(0,0,0,1);
	z-index:11111;
	position:fixed;
	top:0;
	left:0;
}
		</style>
	</head>
	
	<body>
	<div id="overlay">
	<div class="loader"></div>
</div>
		<input id = "signup_btn" type = "button" onclick="show_signup()" value = "Signup" >
		<input id = "login_btn" type = "button" onclick="show_login()" value = "Login" >
		<center>
			<form name="myForm" id="container"   method="POST" action ="<?php echo $_SERVER['PHP_SELF'];?>">

				<input id="name" type = "text" class="textbox" placeholder = "Name" name = "name">
				<input type = "email" class="textbox" placeholder = "Email" name = "email"><br/><br/>
				
				<input type = "password" class="textbox" placeholder = "Password" name = "pass">
				<input type = "password" class="textbox" placeholder = "Confirm Password" name = "con_pass">
				<br/><br/>
				
				
				<input type = "number" class = "address" placeholder = "Mobile Number" name = "phone"><br/><br/>
				<input type = "text" class = "address" placeholder = "Address Line 1" name = "Address_line_two"><br/><br/>
				<input type = "text" class = "address" placeholder = "Address Line 2" name = "Address_line_three"><br/><br/>
				<div ng-app="" ng-init="col=''">
					<input class="textbox" style="background-color:{{col}}" ng-model="col" placeholder="Your favourite color?">
				</div>
				<br/>
				<input type="radio" name="gender" value="male" checked> Male
				<input type="radio" name="gender" value="female"> Female
				<input type="radio" name="gender" value="other"> Other <br/><br/>
				
				Date of Birth : <input type="date" name = "dob">
				<br/><br/><br/>
				<input id = "submit" name = "submit" type = "submit" value = "Submit"  >
				<input id = "submit" style="width:140px" type="reset" name="resetBtn" value="Reset the form" />
								<a href="home.html"><input id = "submit" name = "submit1" type = "button" value = "Home" ></a>

			</form>
		</center>
		
		<center>
			<form id="container2" action = "login.php" METHOD = "POST">
				<input type = "text" class="textbox" placeholder = "Email Id" name = "email">
				<input type = "password" class="textbox" placeholder = "Password" name = "password"><br/><br/>
				
				
				<input id = "submit" type = "submit" value = "Login" name ="submit2" ><br/><br/>
				<a href="update_Information.php">Forgot Password</a>
			</form>
		</center>
		
		<script type = "text/javascript">
		  
		  function show_login(){
			   container.style.cssText = "visibility:hidden !important;"
			   container2.style.cssText = "visibility:visible  !important;"
			   
			}
			
		  function show_signup(){
			  container2.style.cssText = "visibility:hidden  !important;"
			   container.style.cssText = "visibility:visible  !important;"
			   
			}
		</script>
		
		<script>
		  var overlay=document.getElementById("overlay");
		  window.addEventListener('load',function(){
			overlay.style.display="none";
		  })
		</script>
		<!--Validation-->
		<script>

}
$(document).ready(function(){
	$("input").focus(function(){
		$(this).css("background-color","#f2f2f2");
	});
});
$(document).ready(function(){
	$("input").blur(function(){
		$(this).css("background-color","white");
	});
});






</script>
	</body>
</html>




