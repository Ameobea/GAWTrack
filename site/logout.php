<?php
session_start();

if (isset($_SESSION['username'])) {
	unset($_SESSION['username']);
	echo "Successfully logged out.";
	die();
} else {
	echo "No user logged in!";
	die();
}
?>