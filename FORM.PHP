
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300|Oswald:200,300,400,500,600,700|Roboto+Slab:300" rel="stylesheet">

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
			<form name="signup_form" id="container" ACTION = "signup_form_action.php" METHOD = "POST">

				<input type = "text" class="textbox" placeholder = "Name" name = "name">
				<input type = "email" class="textbox" placeholder = "Email" name = "email"><br/><br/>
				
				<input type = "password" class="textbox" placeholder = "Password" name = "password">
				<input type = "password" class="textbox" placeholder = "Confirm Password" name = "con_pass">
				<br/><br/>
				
				
				<input type = "text" class = "address" placeholder = "Mobile Number" name = "mobile_number"><br/><br/>
				<input type = "text" class = "address" placeholder = "Address Line 1" name = "Address_line_two"><br/><br/>
				<input type = "text" class = "address" placeholder = "Address Line 2" name = "Address_line_three"><br/><br/>
				
				
				<input type="radio" name="gender" value="male" checked> Male
				<input type="radio" name="gender" value="female"> Female
				<input type="radio" name="gender" value="other"> Other <br/><br/>
				
				Date of Birth : <input type="date" name = "dob">
				<br/><br/><br/>
				<input id = "submit" name = "submit" type = "submit" value = "Submit" >
				<input id = "submit" style="width:140px" type="reset" name="resetBtn" value="Reset the form" />
								<a href="home.html"><input id = "submit" name = "submit" type = "button" value = "Home" ></a>

			</form>
		</center>
		
		<center>
			<form id="container2" action = "login_form_action.php" METHOD = "POST">
				<input type = "text" class="textbox" placeholder = "Email Id" name = "email">
				<input type = "password" class="textbox" placeholder = "Password" name = "password"><br/><br/>
				
				
				<input id = "submit" type = "submit" value = "Login" name ="submit" ><br/><br/>
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
			function validateForm() {
				var x = document.forms["signup_form"]["name"].value;
				if (x == "") {
				alert("Name must be filled out");
				return false;
			}
}
		</script>
	</body>
</html>




