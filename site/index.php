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
		<a href="input.php"><b id="important">Click Here to Begin</b></a>
		<br>
		<hr>
		<p>Already done that?  Enter the email address of your zenminer account below to view your stats.</p>
		<form method="post" action="overview.php">
			<p>Email Address: <input type="text" id="uname" name="user"></p>
			<p>Unique Identifier: <input type="text" id="uid" name="uid"></p>
			<input type="submit" id="statsbut" value="Submit">
		</form>
	</div>
	<?php include("assets/footer.php"); ?>
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-50797586-1', 'ameobea.me');
	ga('send', 'pageview');

	</script>
</body>
</html>