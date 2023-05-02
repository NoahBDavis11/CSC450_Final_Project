<?php
    ini_set('display_errors', 1); error_reporting(E_ALL);
	require_once('../mysqli_config.php'); //Connect to the database
	$query = "SELECT sum(max_occupancy) as maxCount,sum(floor_size_sqft) as maxSize, event_id, event_name, event_start_date, event_end_date, event_description, section_name, group_concat(distinct build_id SEPARATOR ', ') as bldgs, group_concat(distinct emp_id SEPARATOR ', ') as emps, group_concat(distinct section_name SEPARATOR ', ') as locs 
    FROM parkEvents 
    NATURAL JOIN parkEvents_parkLocations_resides 
    NATURAL JOIN parkLocations 
    NATURAL JOIN parkEvents_buildings_occureAt_at 
    NATURAL JOIN buildings 
    NATURAL JOIN employees_parkEvents_host 
    NATURAL JOIN employees group 
    by event_id";
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
			<th>Sections</th>
			<th>Buildings</th>
			<th>Maximum Participants</th>
			<th>Total Floor ft^2</th>
			<th>Employees Assigned</th>
		</tr>	
		<?php foreach ($all_rows as $event) {
			echo "<tr>";
			echo "<td>".$event['event_id']."</td>";
			echo "<td>".$event['event_name']."</td>";
			echo "<td>".$event['event_start_date']."</td>";
			echo "<td>".$event['event_end_date']."</td>";
			echo "<td>".$event['event_description']."</td>";
			echo "<td>".$event['locs']."</td>";
			echo "<td>".$event['bldgs']."</td>";
			echo "<td>".$event['maxSize']."</td>";
			echo "<td>".$event['maxCount']."</td>";
			echo "<td>".$event['emps']."</td>";
			echo "</tr>";
		}
		?>
	</table>
</body>    
</html>
