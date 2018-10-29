<?php

	session_start();
	
	if (!isset($_SESSION['user'])) {
		header("Location: index.html");
	} else if(isset($_SESSION['user'])!="") {
		header("Location: form_again.php");
	}
	
	if (isset($_GET['logout'])) {
		unset($_SESSION['user']);
		session_unset();
		session_destroy();
		header("Location: form_again.php");
		exit;
	}
	?>