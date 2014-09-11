<?php
require_once("../modules/login/login.php");
session_start();
?>
<html>
<head>
	<script src="/../sources/jquery-2.1.0.min.js"></script>
	<link rel="stylesheet" href="assets/style.css">
	<link rel="stylesheet" href="/../sources/bootstrap/css/bootstrap.css">
	<script src="/../sources/bootstrap/js/bootstrap.min.js"></script>
	<title>GAWTrack Data Entry</title>
</head>
<body>
	<?php include("assets/header.php"); ?>
	<div class='container content'>
		<p>GAWTrack uses the event history data from the GAWMiners API as the source of its information.  This data is availiable on the zenminer website here: <br><a href="https://cloud.zenminer.com/api/activity?iDisplayStart=0&iDisplayLength=10">https://cloud.zenminer.com/api/activity?iDisplayStart=0&iDisplayLength=10</a><br>(Please note that you must be logged in to your zenminer account)</p>
	</div>
</body>
</script>