<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require_once '../mysqli_config.php'; // Connect to the database	

	if(!empty($_GET['emp_id'])) {
		$emp_id = $_GET['emp_id'];
		
		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		//Retrieve specific vendor data using prepared statements:
		$query = "SELECT *, concat(street_name_num, ' ', city, ' ', emp_state, ' ', zip, ' ', country) as address FROM employees natural join (SELECT emp_id, emp_FN, emp_LN, years_hired(date_hired) AS 'Years working at park' FROM employees) as ed WHERE emp_id = ? order by emp_id";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "i", $emp_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt); 
		$rows = mysqli_num_rows($result);
		$client = mysqli_fetch_assoc($result); //Fetches the row as an associative array with DB attributes as keys
		$emp_id = $client['emp_id'];
		$emp_FN = $client['emp_FN'];
		$emp_LN= $client['emp_LN'];
		$primary_phone = $client['primary_phone'];
		$emp_role = $client['emp_role'];
		$wage= $client['wage'];
		$date_hired = $client['date_hired'];
		$email = $client['email'];
		$salary= $client['salary'];
		$address= $client['address'];
		$years_worked= $client['years_worked'];
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
	<h2>Employee ID: <?php echo "$emp_id";?></h2>
	<h2>First Name: <?php echo "$emp_FN";?></h2> 
	<h2>Last Name: <?php echo "$emp_LN";?></h2> 
	<h3>Phone: <?php echo "$primary_phone";?></h2>
	<h3>Role: <?php echo "$emp_role";?></h2> 
	<h3>Wage: <?php echo "$wage";?></h2> 
	<h3>Salary: <?php echo "$salary";?></h2>
	<h3>Date Hired: <?php echo "$date_hired";?></h2>
	<h3>Address: <?php echo "$address";?></h2> 
	<h3>Years Worked: <?php echo "$years_worked";?></h2> 
	<h3><a href="find_employee.html">Lookup another employee</a></h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
