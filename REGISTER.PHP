<?php
	ob_start();
	session_start();
	include_once 'dbconnect.php';

	$error = false;

	if ( isset($_POST['btn-signup']) ) {
		
		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);

		$username = trim($_POST['username']);
		$username = strip_tags($username);
		$username = htmlspecialchars($username);
		
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$phone = trim($_POST['phone']);
		$phone = strip_tags($phone);
		$phone = htmlspecialchars($phone);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		$street = trim($_POST['street']);
		$street = strip_tags($street);
		$street = htmlspecialchars($street);
		
		$city = trim($_POST['city']);
		$city = strip_tags($city);
		$city = htmlspecialchars($city);

		// basic name validation
		if (empty($name)) {
			$error = true;
			$nameError = "Please enter your full name.";
		} else if (strlen($name) < 3) {
			$error = true;
			$nameError = "Name must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		}
		
		//username validation
		if (empty($username)) {
			$error = true;
			$userError = "Please enter a username.";
		} else if (strlen($username) < 3) {
			$error = true;
			$userError = "Username must have atleat 3 characters.";
		} else {
			// check username exists or not
			$query = "SELECT username FROM users WHERE username='$username'";
			$result = mysqli_query($conn,$query);
			$count = mysqli_num_rows($result);
			if($count!=0){
				$error = true;
			}
		}
		
		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		} else {
			// check email exist or not
			$query = "SELECT email FROM users WHERE email='$email'";
			$result = mysqli_query($conn,$query);
			$count = mysqli_num_rows($result);
			if($count!=0){
				$error = true;
				$emailError = "Provided Email is already in use.";
			}
		}
		
		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have atleast 6 characters.";
		}

		//phone validation
		if (empty($phone)){
			$error = true;
			$passError = "Please enter phone.";
		}
		
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);

		// if there's no error, continue to signup
		if( !$error ) {

			$query = "INSERT INTO users(username,password,name,phone,email) VALUES('$username','$pass','$name',$phone,'$email')";
			$res = mysqli_query($conn,$query);
			$query1 = "INSERT INTO user_address(username,city,street) VALUES('$username','$city','$street')";
			$res1 = mysqli_query($conn,$query1);
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				unset($name);
				unset($email);
				unset($pass);
				header("Location: signin.php");
			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopper|SignUp</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="css/materialize.css">
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
	<div id="upar" class="scrollspy" ></div>
  <nav>
    <div class="col s12 m12 l12 nav-wrapper black">
      <ul id="nav-mobile" class="right hide-on-med-and-down">
      </ul>
    </div>
  </nav>

<div class="container">

	<div id="login-form">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">

    	<div class="col-md-12">

        	<div class="form-group">
            	<h2>Sign Up</h2>
            </div>
			<br>
            <?php
			if ( isset($errMSG) ) {

				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" />
                </div>
                <span class="text-danger"></span>
            </div>
			<div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="username" class="form-control" placeholder="Enter Username" maxlength="50" />
                </div>
                <span class="text-danger"></span>
            </div>
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                </div>
                <span class="text-danger"></span>
            </div>
			<div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" />
                </div>
                <span class="text-danger"></span>
            </div>
			<div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="text" name="phone" class="form-control" placeholder="Enter Your Phone" maxlength="40"/>
                </div>
                <span class="text-danger"></span>
            </div>
			<div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="text" name="city" class="form-control" placeholder="Enter Your City" maxlength="40"  />
                </div>
                <span class="text-danger"></span>
            </div>
			<div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="text" name="street" class="form-control" placeholder="Enter Your Street" maxlength="40" />
                </div>
                <span class="text-danger"></span>
            </div>
            
            <center><div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div></center>
			<br>
        </div>
    </form>
    </div>
</div>

</body>
</html>
<?php ob_end_flush(); ?>
