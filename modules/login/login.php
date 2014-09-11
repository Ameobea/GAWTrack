<?php
require_once('const.php');

session_start();
class login {
	public static function doLogin($username, $password) {
		//$users = yaml_parse_file("users/users.yml");
		$con = mysqli_connect(Passwords::DB_IP,Passwords::DB_USERNAME,
			Passwords::DB_PASSWORD,Passwords::DB_DATABASE);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$query = "SELECT * FROM `users` WHERE `username` = '$username';";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		if (isset($row)) {
			if (password_verify($password, $row['hash'])) {
				if (isset($_SESSION['username'])) {
					return 3; //user already logged in
					die();
				} else {
					$_SESSION['username'] = $username;
					return 1; //successful login
				}
			} else {
				return 2; //incorrect password
			}
		} else {
			//username not found in file
			return 4; //user not registered
		}
	}

	public static function register($username, $password) {
		$con = mysqli_connect(Passwords::DB_IP,Passwords::DB_USERNAME,
			Passwords::DB_PASSWORD,Passwords::DB_DATABASE);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$query = "SELECT * FROM `users` WHERE `username` = '$username';";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		if(isset($row)) {
			return 2;//user already registered
		} else {
			//assuming we've done verification on the password to make sure it's not shit on the clientside:
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$query = "INSERT INTO `space`.`users` (`id`, `username`, `firstlogin`, `lastlogin`, `hash`) VALUES (NULL, '$username', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$hash');";
			$result = mysqli_query($con, $query);
			return 1;//success
		}
	}

	public static function logged() {
		if (isset($_SESSION['username'])) {
			return $_SESSION['username'];
		} else {
			return 0;
		}
	}
}
?>