<?php
require_once "../modules/login/register.php";

if (isset($_POST['user'])) {
	$username = $_POST['user'];
	$username = mysql_escape_string($username);
} else {
	echo "Please specify a valid username.";
	die();
}

if (isset($_POST['pass1'])) {
	$pass1 = $_POST['pass1'];
	$pass1 = mysql_escape_string($pass1);
} else {
	echo "Please specify a valid password.";
	die();
}

if (isset($_POST['pass2'])) {
	$pass2 = $_POST['pass2'];
	$pass2 = mysql_escape_string($pass2);
} else {
	echo "Please retype your password.";
	die();
}

if (isset($_POST['email'])) {
	$email = $_POST['email'];
	$email = mysql_escape_string($email);
} else {
	echo "Please specify a valid email address.";
	die();
}

if($pass1 != $pass2) {
	echo "Passwords do not match!";
	die();
}

$result = register::doRegister($username, $pass2, $email);
if($result == 1) {
	echo "User successfully registered!";
	die();
} else {
	echo "Username already registered!";
	die();
}
?>