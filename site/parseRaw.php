<?php
require_once "../modules/login/const.php";

if (isset($_POST['json'])) {
	$raw = $_POST['json'];
	//$raw = mysql_escape_string($raw);
} else {
	echo "Bad JSON string supplied; unable to decode.";
	die();
}

if (isset($_POST['uid'])) {
	if($_POST['uid'] != "") {
		$uid = $_POST['uid'];
		//$raw = mysql_escape_string($raw);
	} else {
		echo "Need to supply a UID.";
		die();
	}
} else {
	echo "No UID provided.  ";
	die();
}

//var_dump(json_decode($raw));
$parsed = json_decode($raw);
$username = $parsed->aaData[0]->user->email;
//echo $username;
//That worked on the first try - it's a glorious day to be alive.
for($i=0; $i<$parsed->iTotalRecords; $i++) {
	$event = $parsed->aaData[$i];
	$date = $event->updatedAt;
		$time = strtotime($date);
		//2014-09-10 00:00:00
		$fixed = date("Y-m-d H:i:s", $time);
		//echo $fixed;
		//sweet jesus it's a miracle.  Worked again.
	$type = $event->action;
	$data = $event->details;
	$id = $event->_id;

	$con = mysqli_connect(Passwords::DB_IP,Passwords::DB_USERNAME,
		Passwords::DB_PASSWORD,Passwords::DB_DATABASE);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$uuid = $username . "*" . $uid;
	$query = "INSERT INTO `gawtrack`.`events` (`username`, `date`, `type`, `data`, `uid`, `pass`, `uuid`) VALUES ('$username', '$fixed', '$type', '$data', '$id', '$uid', '$uuid');";
	//echo $query;
	$result = mysqli_query($con, $query);
	//var_dump($result);
	//Oh and you'll need to add /some/ kind of authentication system
	//To keep people from screwing with it.
}

echo "Data has successfully been processed and stored.  Click the button below to view your graphs and stats!\n<br>";
echo "\n<form method='post' action='overview.php'><input type='hidden' name='user' value='" . $username . "'><input type='hidden' name='uid' value='" . $uid . "'><input type='submit' value='View Stats'></form>";
?>