<?php
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
	//Now plop them into the database, but first I need to sleep.
	//Oh and you'll need to add /some/ kind of authentication system
	//To keep people from screwing with it.
}
?>