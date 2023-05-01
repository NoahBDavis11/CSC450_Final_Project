<?php
	if(!empty($_GET['ride_id']) and !empty($_GET['rep_num'])) {
		$ride_id = $_GET['ride_id'];
		$ride_id = $_GET['rep_num'];
		
		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		//Retrieve specific vendor data using prepared statements:
		$query = "SELECT * FROM replacementParts WHERE ride_id = ? and rep_num = ?";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "s", $ride_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt); 
		$rows = mysqli_num_rows($result);
		$client = mysqli_fetch_assoc($result); //Fetches the row as an associative array with DB attributes as keys
		$ride_id = $client['ride_id'];
		$rep_num = $client['rep_num'];
		$rep_part= $client['replacement_part'];
	}
	else {
		echo "You have reached this page in error";
		exit;
	}
	//Clients found, output results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Repairs</title>
	<meta charset ="utf-8"> 
	<!-- Add some spacing to each table cell -->
	<style> td, th {padding: 1em;} </style>
</head>
<body>
	<h2>Ride: <?php echo "$ride_id";?></h2>
	<h3>Repair Num.: <?php echo "$rep_num";?></h2> 
	<h3>Part Name: <?php echo "$rep_part";?></h2> 
	<h3><a href="find_parts.html">Lookup another repair</a></h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>