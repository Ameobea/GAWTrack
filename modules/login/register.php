<?php
require_once('const.php');
class register {
	public static function doRegister($username, $password, $email) {
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
			$query = "INSERT INTO `gawtrack`.`users` (`id`, `username`, `firstlogin`, `lastlogin`, `hash`, `email`) VALUES (NULL, '$username', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$hash', '$email');";
			$result = mysqli_query($con, $query);
			return 1;//success
		}
	}
}
?>