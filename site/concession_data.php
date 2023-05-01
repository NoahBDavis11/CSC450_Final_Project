<?php
	if(!empty($_GET['cons_id'])) {
		$cons_id = $_GET['cons_id'];
		
		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		//Retrieve specific vendor data using prepared statements:
		$query = "SELECT *, GROUP_CONCAT(distinct emp_id SEPARATOR ', ') as opEmps FROM parkConcessions c left join employees_concessions_operates eco on c.cons_id = eco.cons_id WHERE c.cons_id = ? group by c.cons_id";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "i", $cons_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt); 
		$rows = mysqli_num_rows($result);
		$client = mysqli_fetch_assoc($result); //Fetches the row as an associative array with DB attributes as keys
		$cons_id = $client['c.cons_id'];
		$cons_name = $client['cons_name'];
		$cons_type= $client['cons_type'];
		$cons_open = $client['cons_open'];
		$cons_close = $client['cons_close'];;
		$cons_company_name = $client['cons_company_name'];
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
	<h2>Concession: <?php echo "$cons_id";?></h2>
	<h3>Name: <?php echo "$cons_name";?></h2> 
	<h3>Type: <?php echo "$cons_type";?></h2> 
	<h2>Open Time: <?php echo "$cons_open";?></h2>
	<h3>Close Time: <?php echo "$cons_close";?></h2> 
	<h3>Company: <?php echo "$cons_company_name";?></h2> 
	<h3>Employees Assigned: <?php echo "$opEmps";?></h2>
	<h3>Building: <?php echo "$build_id";?></h2> 
	<h3>Section: <?php echo "$section_id";?></h2>
	<h3><a href="find_concession.html">Lookup another Concession</a></h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>