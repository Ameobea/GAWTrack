<?php
require_once "../modules/login/login.php";

if (isset($_POST['user'])) {
	$username = $_POST['user'];
	$username = mysql_escape_string($username);
} else {
	echo "Please specify a username.";
	die();
}

if (isset($_POST['pass'])) {
	$password = $_POST['pass'];
	$password = mysql_escape_string($password);
} else {
	echo "Please specify a password.";
	die();
}

$result = login::doLogin($username, $password);
if ($result == 1) {
	echo "Successfully logged in!";
} elseif ($result = 2) {
	echo "Incorrect password!";
} elseif ($result = 3) {
	echo "Already logged in!";
} elseif ($result = 4) {
	echo "Username not registered.";
}
?>