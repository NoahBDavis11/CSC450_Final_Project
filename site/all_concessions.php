<?php
	ini_set ('error_reporting', 1); //Turns on error reporting - remove once everything works.
	require_once('../mysqli_config.php'); //Connect to the database
	$query = 'SELECT *, GROUP_CONCAT(distinct emp_id SEPARATOR ', ') as opEmps FROM parkConcessions c left join employees_concessions_operate eco on c.cons_id = eco.cons_id group by c.cons_id;';
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
    <title>Concessions</title>
	<meta charset ="utf-8"> 
</head>
<body>
	<h2>Concessions</h2>

	<table>
		<tr>
			<th>Concession</th>
			<th>Name</th>
			<th>Type</th>
			<th>Open Time</th>
			<th>Close Time</th>
			<th>Company</th>
			<th>Employees Assigned</th>
			<th>Building</th>
			<th>Section</th>
		</tr>	
		<?php foreach ($all_rows as $event) {
			echo "<tr>";
			echo "<td>".$event['event_id']."</td>";
			echo "<td>".$event['event_name']."</td>";
			echo "<td>".$event['event_start_date']."</td>";
			echo "<td>".$event['event_end_date']."</td>";
			echo "<td>".$event['event_description']."</td>";
			echo "<td>".$event['section_name']."</td>";
			echo "<td>".$event['build_id']."</td>";
			echo "<td>".$event['emp_id']."</td>";
			echo "</tr>";
			<h2>Concession: <?php echo "$cons_id";?></h2>
			<h3>Name: <?php echo "$cons_name";?></h2> 
			<h3>Type: <?php echo "$cons_type";?></h2> 
			<h2>Open Time: <?php echo "$cons_open";?></h2>
			<h3>Close Time: <?php echo "$cons_close";?></h2> 
			<h3>Company: <?php echo "$cons_company_name";?></h2> 
			<h3>Employees Assigned: <?php echo "$opEmps";?></h2>
			<h3>Building: <?php echo "$build_id";?></h2> 
			<h3>Section: <?php echo "$section_id";?></h2>
		}
		?>
	</table>
</body>    
</html>
