<?php
require_once "../modules/login/const.php";

if (isset($_POST['json'])) {
	$raw = $_POST['json'];
	//$raw = mysql_escape_string($raw);
} else {
	echo "Bad JSON string supplied; unable to decode.";
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
	$query = "INSERT INTO `gawtrack`.`events` (`username`, `date`, `type`, `data`, `uid`) VALUES ('$username', '$fixed', '$type', '$data', '$id');";
	$result = mysqli_query($con, $query);
	//Oh and you'll need to add /some/ kind of authentication system
	//To keep people from screwing with it.
}

echo "Data has successfully been processed and stored.  Click the link below to view your graphs and stats!\n<br>";
echo "\n<a href='overview.php?user=" . $username . "'>Detailed Stats + Data</a>";
?>