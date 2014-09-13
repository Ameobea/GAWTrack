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
	<script>var x = 0;</script>
</head>
<body>
	<?php include("assets/header.php"); ?>
	<div class='container content'>
		<h1>Event History Data Entry</h1>
		<p>In order to make sure that your data remains private from other users, enter a unique username below that will allow you to access the data that you're about to input.
		<br>Please not that at this time the phare you enter is stored unencrypted and not sent via a secure connection.  Don't pick something you use as a password elsewhere.</p>
		<form>
			<input type="password" id="passwd">
		</form>
		<p>GAWTrack uses the event history data from the GAWMiners API as the source of its information.  This data is availiable on the zenminer website here: <br><a href="https://cloud.zenminer.com/api/activity" target="_blank">https://cloud.zenminer.com/api/activity</a><br>(Please note that you must be logged in to your zenminer account)</p>
		<p>Click the above link and copy the contents of the displayed page into the text box below.  Then press submit.</p>
		<textarea id="raw" rows="6" cols="50"></textarea><br><br>
		<input type="button" id="submitData" value="Submit">
		<br>
		<div id="response"></div>
	</div>
	<script type="text/javascript">
		$("#submitData").click(function(event) {
			event.preventDefault();
			if(x===0) {
				var raw = $('textarea#raw').val();
				var parsed = $.parseJSON(raw);
				console.log(parsed);
				var records = parsed.iTotalRecords;
				var reply = "<p>After processing the data, it has been determined that your account has " + records + " total event records in its history.  <br>In order for GAWTrack to be able to read all of them, you have to perform one more maunal query to the API.  </p>";
				reply += "<p>Navigate to the following page in your browser and copy the entire contents of that page into the box above, then press submit again: </p>";
				reply += "<p><a href='https://cloud.zenminer.com/api/activity?iDisplayStart=0&iDisplayLength=" + records + "'  target='_blank'>https://cloud.zenminer.com/api/activity?iDisplayStart=0&iDisplayLength=" + records + "</a></p>";
				$('textarea#raw').val("");
				$("#response").html(reply);
				x = 1;
			} else {
				var raw = $('textarea#raw').val();
				var parsed = $.parseJSON(raw);
				var pass = $('#passwd').val();
				console.log(parsed);
				$("#response").html("Sending data to the server for processing...");
		    	var posting = $.post( 'parseRaw.php',{uid: pass, json: raw});
		    	posting.done(function( data ) {
		    		$( "#response" ).html( "<b>" + data + "</b>");
		    	})
			}
		})
	</script>
</body>
</script>