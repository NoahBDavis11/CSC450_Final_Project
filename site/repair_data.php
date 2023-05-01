<?php
if(!empty($_GET['ride_id'])) {
	$ride_id = $_GET['ride_id'];

	require_once('../mysqli_config.php');

	$query = "SELECT *, concat(r.rep_num, r.ride_id) as combKey, count(rp.rep_num) as rep_count, GROUP_CONCAT(distinct erp.emp_id SEPARATOR ', ') as assignedEmps 
		FROM repairs r 
		LEFT JOIN replacementParts rp ON r.rep_num = rp.rep_num AND r.ride_id = rp.ride_id 
		LEFT JOIN employees_repairs_perform erp ON r.rep_num = erp.rep_num AND r.ride_id = erp.ride_id 
		WHERE r.ride_id = ?
		GROUP BY combKey";
	$stmt = mysqli_prepare($dbc, $query);
	mysqli_stmt_bind_param($stmt, "i", $ride_id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt); 
	$rows = mysqli_num_rows($result);

	if ($rows > 0) {
		$client = mysqli_fetch_assoc($result);
		$ride_id = $client['ride_id'];
		$rep_num = $client['rep_num'];
		$rep_st = $client['rep_start_date'];
		$rep_fin_date = $client['rep_fin_date'];
		$rep_cost = $client['total_cost'];
		 $rep_comp = $client['rep_company_name'];
		$rep_desc = $client['rep_description'];
		$emps = $client['assignedEmps'];
		$rep_cnt = $client['rep_count'];
	} else {
		echo "No repairs found for this ride ID";
		exit;
	}
}
else {
	echo "You have reached this page in error";
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Repairs</title>
	<meta charset="utf-8"> 
	<!-- Add some spacing to each table cell -->
	<style> td, th {padding: 1em;} </style>
</head>
<body>
	<h2>Ride: <?php echo $ride_id;?></h2>
	<h2>Repair Num: <?php echo $rep_num;?></h3> 
	<h3>Start Date: <?php echo $rep_st;?></h3> 
	<h3>Finish Date: <?php echo $rep_fin_date;?></h3>
	<h3>Total Cost: <?php echo $rep_cost;?></h3> 
	<h3>Parts Count: <?php echo $rep_cnt;?></h3> 
	<h3>Assigned Mechanics: <?php echo $emps;?></h3> 
	<h3>Company: <?php echo $rep_comp;?></h3> 
	<h3>Description: <?php echo $rep_desc;?></h3>
	<h3><a href="find_repair.html">Lookup another repair</a></h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
