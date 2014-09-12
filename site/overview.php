<?php
require_once("../modules/login/const.php");
session_start();

//TODO: Some kind per-user authentication
//TODO: Allow for users to input the prices of pre-purchased hashlets that don't show up here.

if (isset($_GET['user'])) {
	$username = $_GET['user'];
} else {
	echo "No username specified.  ";
	die();
}

$con = mysqli_connect(Passwords::DB_IP,Passwords::DB_USERNAME,
		Passwords::DB_PASSWORD,Passwords::DB_DATABASE);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$query = "SELECT * FROM `gawtrack`.`events` WHERE `username` = '$username';";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result)) {
		$events[$i] = $row;
		$i++;
	}
	//var_dump($events);
?>
<html>
<head>
	<script src="/../sources/jquery-2.1.0.min.js"></script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<link rel="stylesheet" href="assets/style.css">
	<link rel="stylesheet" href="/../sources/bootstrap/css/bootstrap.css">
	<script src="/../sources/bootstrap/js/bootstrap.min.js"></script>
	<title>GAWTrack User Statistics</title>
</head>
<body>
	<?php include("assets/header.php"); ?>
	<div class='container content'>
		<h1>Data for user <?php echo $username;?></h1>
		<p>Stuff to add:</p>
		<ul>
			<li>Charts showing net profit over time as well as profit/day and possibly individual charts for fees and payouts.</li>
			<li>Hashlet overview showing a list of all hashlets, their names, mhz, etc.</li>
			<li>%ROI calculations as well as estimed time to ROI</li>
			<li>(maybe) A timeline with events such as hashlet purchases, renames, merges, etc.</li>
		</ul>
	</div>
</body>
</html>