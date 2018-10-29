<?php
	$has_error = false;
$error_message = array('username'=>'' , 'password'=>'' , 'phone'=>''); //An array which will have
validation message with key as form name
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (empty($_POST['username']))
{
$has_error = true;
$error_message['username'] = 'Username must not be blank';
}
else
{
if (strlen($_POST['username']) < 5)
{
$has_error = true;
$error_message['username'] = 'Username has to be atleast 5 charecter long';
}
	?>






