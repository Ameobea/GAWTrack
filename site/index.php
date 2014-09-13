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
	<title>GAWTrack Homepage</title>
</head>
<body>
	<?php include("assets/header.php"); ?>
	<div class='container content'>
		<h1>About GAWTrack</h1>
		<p>GAWTrack is a tool that allows you to view in detail the history of your payments, payouts, and other events from GAW's cloud mining service.  </p>
		<p>It works by taking the list of all your past events from the official GAW website's API and translating it into charts, graphs, and numbers that make sense and have meaning.  
			<br>Try it for yourself!  Click the button below to get started.</p>
		<a href="input.php">Click Here to Begin</a>
		<br>
		<hr>
		<h2>Todo</h2>
		<p>Stuff to add:</p>
		<div class="left-align">
			<ul>
				<li>Charts showing net profit over time as well as profit/day and possibly individual charts for fees and payouts.</li>
				<li>Hashlet overview showing a list of all hashlets, their names, mhz, etc.</li>
				<li>%ROI calculations as well as estimed time to ROI</li>
				<li>(maybe) A timeline with events such as hashlet purchases, renames, merges, etc.</li>
			</ul>
		</div>
	</div>
	<?php include("assets/footer.php"); ?>
</body>
</html>