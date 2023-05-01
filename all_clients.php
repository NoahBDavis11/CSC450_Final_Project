<?php
	ini_set ('error_reporting', 1); //Turns on error reporting - remove once everything works.
	require_once('../mysqli_config.php'); //Connect to the database
	$query = 'SELECT ccid, ccname, ccindustry, cclocation FROM HAcorpclient';
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
    <title>HAFA</title>
	<meta charset ="utf-8"> 
</head>
<body>
	<h2>HAFA Corporate Clients</h2>

	<table>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Industry</th>
			<th>Location</th>
		</tr>	
		<?php foreach ($all_rows as $client) {
			echo "<tr>";
			echo "<td>".$client['ccid']."</td>";
			echo "<td>".$client['ccname']."</td>";
			echo "<td>".$client['ccindustry']."</td>";
			echo "<td>".$client['cclocation']."</td>";
			echo "</tr>";
		}
		?>
	</table>
</body>    
</html>


