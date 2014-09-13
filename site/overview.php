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
	$i=0;
	while($row = mysqli_fetch_array($result)) {
		$events[$i] = $row;
		$i++;
	}
	//var_dump($events);

	$o=0;
	$j=0;
	$netbtcprofit=0;
	$nethpprofit=0;
	for($i=0; $i<count($events); $i++) {
		if($events[$i]["type"] == "payout" || $events[$i]["type"] == "service charge") {
			if (strpos($events[$i]["data"], 'HashPoints') !== FALSE) {
				$sploded = explode(" ", $events[$i]["data"]);
				$amount = $sploded[3];
				$nethpprofit = $nethpprofit + $amount;
				$hptrans[$j]['amount'] = $amount;
				$hptrans[$j]['date'] = strtotime($events[$i]["date"])*1000;
				$j++;
			} else {
				$sploded = explode(" ", $events[$i]["data"]);
				$amount = $sploded[3];
				$netbtcprofit = $netbtcprofit + $amount;
				$btctrans[$o]['amount'] = $amount;
				$btctrans[$o]['date'] = strtotime($events[$i]["date"])*1000;
				$o++;
			}
		}
	}
	//var_dump($btctrans);
	//var_dump($hptrans)
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
		<h2>Net Profit History</h2>
		<div id="netbtcprofit" style='width: 100%; height: 500px;'></div>
	</div>
	<?php include("assets/footer.php"); ?>
<script type='text/javascript'>
	//toggleSection('#ppRankChart');
	$('#netbtcprofit').highcharts({
		chart: {
			type: 'line',
			zoomType: 'x'
		},
		exporting: {
			enabled: false
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Net Profit'
		},
		plotOptions: {
			line: {
				cropThreshold: 5000,
				marker: {
					enabled:false
				}
			},
			series: {
				pointInterval: 100
			}
		},
		xAxis: {
			type: 'datetime',
			dateTimeLabelFormats: {
				hour: '%I %p',
				minute: '%I:%M %p',
				month: '%b %e',
				year: '%b'
			},
			title: {
				text: 'Date'
			}
		},
        yAxis: [{ //--- Primary yAxis
        	title: {
        		text: 'BTC'
        	}
		}],
		tooltip: {
			formatter: function() {
				return '<b>'+this.series.name+'</b><br>'+
					Highcharts.dateFormat('%e %b %l:%M %p', this.x) + ': ' + this.y;
			}
		},

		series: [{
			name: 'PP',
			yAxis: 0,
			data: [
			<?php
			function cmp($a, $b) {
		        return $a["date"] - $b["date"];
			}
	        usort($btctrans, "cmp");
			?>
			<?php $net=0; for($i=0; $i < count($btctrans); $i++):?>[<?php echo $btctrans[$i]['date']; ?>, <?php $net = $net + $btctrans[$i]['amount']; echo $net;?>],
			<?php endfor; ?>
			]
		}]
	});
</script>
</body>
</html>