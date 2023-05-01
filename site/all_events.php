<?php
	ini_set ('error_reporting', 1); //Turns on error reporting - remove once everything works.
	require_once('../mysqli_config.php'); //Connect to the database
	$query = 'SELECT event_id, event_name, event_start_date, event_end_date, event_description FROM parkEvents';
	$result = mysqli_query($dbc, $query);
	//Fetch all rows of result as an associative array
	if($result)
		$all_rows= mysqli_fetch_all($result, MYSQLI_ASSOC); //get the result as an associative, 2-dimensional array
	else { 
		echo "<h2>We are unable to process this request right now.</h2>"; 
		echo "<h3>Please try again later.</h3>";
		exit;
	} 
	mysqli_close($dbc);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Park Events</title>
	<meta charset ="utf-8"> 
</head>
<body>
	<h2>Park Events</h2>

	<table>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Description</th>
		</tr>	
		<?php foreach ($all_rows as $event) {
			echo "<tr>";
			echo "<td>".$event['event_id']."</td>";
			echo "<td>".$event['event_name']."</td>";
			echo "<td>".$event['event_start_date']."</td>";
			echo "<td>".$event['event_end_date']."</td>";
			echo "<td>".$event['event_description']."</td>";
			echo "</tr>";
		}
		?>
	</table>
</body>    
</html>
