<?php
	if(!empty($_GET['ride_id'])) {
		$ride_id = $_GET['ride_id'];
		
		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		//Retrieve specific vendor data using prepared statements:
		$query = "SELECT *, GROUP_CONCAT(ride_restrictions SEPARATOR ', ') as rstcts, GROUP_CONCAT(emp_id SEPARATOR ', ') as opEmps FROM rides natural join passengerRestrictions natural join employees_rides_operates WHERE ride_id = ? group by ride_id";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "i", $ride_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt); 
		$rows = mysqli_num_rows($result);
		$client = mysqli_fetch_assoc($result); //Fetches the row as an associative array with DB attributes as keys
		$ride_id = $client['ride_id'];
		$ride_name = $client['ride_name'];
		$ride_type= $client['ride_type'];
		$ride_open = $client['ride_open'];
		$ride_close = $client['ride_close'];
		$max_passengers = $client['max_passengers'];
		$rstcts = $client['rstcts'];
		$opEmps = $client['opEmps'];
		$build_id = $client['build_id'];
		$section_id = $client['section_id'];

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
	<h3>Name: <?php echo "$ride_name";?></h2> 
	<h3>Type: <?php echo "$ride_type";?></h2> 
	<h2>Open Time: <?php echo "$ride_open";?></h2>
	<h3>Close Time: <?php echo "$ride_close";?></h2> 
	<h3>Max Passengers: <?php echo "$max_passengers";?></h2> 
	<h3>Restrictions: <?php echo "$rstcts";?></h2> 
	<h3>Employees Assigned: <?php echo "$opEmps";?></h2>
	<h3>Building: <?php echo "$build_id";?></h2> 
	<h3>Section: <?php echo "$section_id";?></h2>
	<h3><a href="find_ride.html">Lookup another ride</a></h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>