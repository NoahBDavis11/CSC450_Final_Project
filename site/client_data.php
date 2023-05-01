<?php
	if(!empty($_GET['ccname'])) {
		$ccname = $_GET['ccname'];
		
		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		//Retrieve specific vendor data using prepared statements:
		$query = "SELECT * FROM HAcorpclient WHERE ccname = ?";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "s", $ccname);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt); 
		$rows = mysqli_num_rows($result);
		if($rows==1){ //Client found
			$client = mysqli_fetch_assoc($result); //Fetches the row as an associative array with DB attributes as keys
			$ccid = $client['ccid'];
			$ccindustry = $client['ccindustry'];
			$cclocation = $client['cclocation'];
		} // end if($result)
		else {
			echo "<h2>That client was not found</h2>";
			mysqli_close($dbc);
			exit;
		}
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
    <title>HAFA</title>
	<meta charset ="utf-8"> 
	<!-- Add some spacing to each table cell -->
	<style> td, th {padding: 1em;} </style>
</head>
<body>
	<h2>Corporate Client: <?php echo "$ccname";?></h2>
	<h3>Industry: <?php echo "$ccindustry";?></h2> 
	<h3>Location: <?php echo "$cclocation";?></h2> 
	<h3><a href="find_client.html">Lookup another client</a></h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>