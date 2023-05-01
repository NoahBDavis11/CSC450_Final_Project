<?php
	//Make sure this page was called from find_manager.html
	if(!empty($_GET['mgr_id'])) {
		$id = $_GET['mgr_id'];
		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		//Retrieve specific vendor data using prepared statements:
		$query = "SELECT * FROM HAmanager WHERE managerid = ?";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "s", $id); //second argument one for each ? either i(integer), d(double), b(blob), s(string or anything else)
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt); 
		
		if($result){ //it ran successfully
			$manager= mysqli_fetch_assoc($result); //Fetches the row as an associative array with DB attributes as keys
			//Assign the array variable to scalar variables to simplify output statements
			$fname = $manager['mfname'];
			$lname = $manager['mlname'];
			$bd = $manager['mbdate'];
			$salary = $manager['msalary'];
			$bonus = $manager['mbonus'];
			$res = $manager['mresbuildingid'];
			
		}
		else {
			echo "That manager was not found";
			mysqli_close($dbc);
			exit;
		}
	} // end isset
	else {
		echo "You have reached this page in error";
		exit;
	}
	//Vendor found, output results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>HAFA</title>
	<meta charset ="utf-8"> 
</head>
<body>
	<h2>Manager Data:</h2>
	<?php
		echo "<h3>$fname $lname</h3>";
		echo "<h3>DOB: $bd</h3>";
		echo "<h3>Salary: $salary</h3>";
		echo "<h3>Annual bonus: $bonus</h3>";
		echo "<h3>Buidling residence: $res</h3>";
	?>
	<br>
	<h3><a href="find_manager.php">Lookup another manager</a></h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>