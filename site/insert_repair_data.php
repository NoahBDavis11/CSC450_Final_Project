<?php
	ini_set('display_errors', 1); error_reporting(E_ALL);
/*This code assumes user input is valid and correct only for demo purposes - it does NOT validate form data.*/
	if(!empty($_GET['ride_id'])) { //must have at least a managerid not = NULL
		$ride_id = $_GET['ride_id'];
		$rep_company_name = $_GET['rep_company_name'];
		$rep_start_date = $_GET['rep_start_date'];
		$rep_start_date = date('Y-m-d', strtotime($rep_start_date));
		$rep_fin_date = $_GET['rep_fin_date'];
		$rep_fin_date = date('Y-m-d', strtotime($rep_fin_date));
		$rep_description = $_GET['rep_description'];
		$total_cost = $_GET['total_cost'];


		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		
		$query3 = "INSERT INTO repairs (ride_id,rep_company_name,rep_start_date,rep_fin_date,rep_description,total_cost) VALUES (?,?,?,?,?,?)";
		$stmt3 = mysqli_prepare($dbc, $query3);
		
		//second argument one for each ? either i(integer), d(double), b(blob), s(string or anything else)
		mysqli_stmt_bind_param($stmt3, "issssi", $ride_id, $rep_company_name, $rep_start_date, $rep_fin_date, $rep_description, $total_cost); 
		mysqli_stmt_execute($stmt3);

		$rep_num = mysqli_insert_id($dbc);

		$parts = $_GET['parts'];
		$parts_array = explode(',', $parts);

		foreach ($parts_array as $part) {
			$query4 = "INSERT INTO replacementParts (part, rep_num, ride_id) VALUES (?, ?, ?)";
			$stmt4 = mysqli_prepare($dbc, $query4);
			mysqli_stmt_bind_param($stmt4, "sii", $part, $rep_num, $ride_id);
			mysqli_stmt_execute($stmt4);
			mysqli_stmt_close($stmt4);
		}

		mysqli_close($dbc);
	} 
	else {
		echo "<h2>You have reached this page in error</h2>";
		mysqli_close($dbc);
		exit;
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>New Repair</title>
	<meta charset ="utf-8"> 
</head>
<body>
	<h2>Repair was successfully added</h2>
	<h3><a href="add_repair.html">Add another repair</a><h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
