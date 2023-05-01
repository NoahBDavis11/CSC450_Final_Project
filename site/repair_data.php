<?php
	if(!empty($_GET['ride_id'])) {
		$ride_id = $_GET['ride_id'];
		
		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		//Retrieve specific vendor data using prepared statements:
		$query = "SELECT *, concat(str(rep_id),str(ride_id)) as combKey, count(*) as rep_count FROM repairs natural join replacementParts WHERE ride_id = ? group by combKey";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "s", $ride_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt); 
		$rows = mysqli_num_rows($result);
		$client = mysqli_fetch_assoc($result); //Fetches the row as an associative array with DB attributes as keys
		$ride_id = $client['ride_id'];
		$rep_num = $client['rep_num'];
		$rep_st= $client['rep_start_date'];
		$rep_fin_date = $client['rep_fin_date'];
		$rep_cost = $client['total_cost'];
		$rep_comp = $client['rep_company_name'];
		$rep_desc = $client['rep_description'];
		$rep_cnt = $client['rep_count'];

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
	<h3>Start Date: <?php echo "$rep_st";?></h2> 
	<h2>Finish Date: <?php echo "$rep_fin_date";?></h2>
	<h3>Total Cost.: <?php echo "$rep_cost";?></h2> 
	<h3>Part Count: <?php echo "$rep_cnt";?></h2> 
	<h3>Company: <?php echo "$rep_comp";?></h2> 
	<h3>Description: <?php echo "$rep_desc";?></h2>
	<h3><a href="find_client.html">Lookup another repair</a></h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>