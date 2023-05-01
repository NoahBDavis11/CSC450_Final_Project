<?php
	if(!empty($_GET['event_name'])) {
		$event_name = $_GET['event_name'];
		
		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		//Retrieve specific vendor data using prepared statements:
		$query = "SELECT * FROM parksEvents WHERE event_name = ?";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "s", $event_name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt); 
		$rows = mysqli_num_rows($result);
		if($rows==1){ //Client found
			$event = mysqli_fetch_assoc($result); //Fetches the row as an associative array with DB attributes as keys
			$event_id = $event['event_id'];
			$event_name = $event['event_name'];
			$event_start_date = $event['event_start_date'];
			$event_end_date = $event['event_end_date'];
			$event_description = $event['event_description'];
		} // end if($result)
		else {
			echo "<h2>That event was not found</h2>";
			mysqli_close($dbc);
			exit;
		}
	}
	else {
		echo "You have reached this page in error";
		exit;
	}
	//Events found, output results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Park Events</title>
	<meta charset ="utf-8"> 
	<!-- Add some spacing to each table cell -->
	<style> td, th {padding: 1em;} </style>
</head>
<body>
	<h2>Event ID: <?php echo "$event_id";?></h2>
	<h3>Event Name: <?php echo "$event_name";?></h2> 
	<h3>Event Start Date: <?php echo "$event_start_date";?></h2> 
	<h3>Event End Date: <?php echo "$event_end_date";?></h2> 
	<h3>Event Description: <?php echo "$event_description";?></h2> 
	<h3><a href="find_event.html">Lookup another event</a></h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
