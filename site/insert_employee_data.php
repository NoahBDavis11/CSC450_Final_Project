<?php
/*This code assumes user input is valid and correct only for demo purposes - it does NOT validate form data.*/
	if(!empty($_GET['id'])) { //must have at least a employeeid not = NULL
		$id = $_GET['id'];
		$last = $_GET['last'];
		$first = $_GET['first'];
		$dob = $_GET['dob'];
		$salary = $_GET['salary'];
		$bonus = $_GET['bonus'];
		$bid = $_GET['mresbid'];
		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		
		//Make sure manager id doesn't already exist in the db
		$query1 = "SELECT * FROM HAmanager where managerid = ?";
		$stmt1 = mysqli_prepare($dbc, $query1);
		mysqli_stmt_bind_param($stmt1, "s", $id);
		mysqli_stmt_execute($stmt1);
		$result=mysqli_stmt_get_result($stmt1);
		$rows=mysqli_num_rows($result);
		if ($rows >=1) {
			echo "<h2>That manager id is already in use. Please go back and choose another.</h2>";
			mysqli_close($dbc);
			exit;
		}
		
		//Make sure the BuildingID exists in the DB to prevent referential integrity violation
		//Make sure manager id doesn't already exist in the db
		$query2 = "SELECT * FROM HAbuilding where buildingid = ?";
		$stmt2 = mysqli_prepare($dbc, $query2);
		mysqli_stmt_bind_param($stmt2, "s", $bid);
		mysqli_stmt_execute($stmt2);
		$result=mysqli_stmt_get_result($stmt2);
		$rows=mysqli_num_rows($result);
		if ($rows ==0) {
			echo "<h2>That building id does not exist. Please go back and choose another.</h2>";
			mysqli_close($dbc);
			exit;
		}
		
		
		$query3 = "INSERT INTO HAmanager VALUES (?,?,?,?,?,?,?)";
		$stmt3 = mysqli_prepare($dbc, $query3);
		
		//second argument one for each ? either i(integer), d(double), b(blob), s(string or anything else)
		mysqli_stmt_bind_param($stmt3, "ssssdds", $id, $first, $last, $dob, $salary, $bonus, $bid); 
		
		if(!mysqli_stmt_execute($stmt3)) { //it did not run successfully
			echo "<h2>We were unable to add the manager at this time.</h2>";
			mysqli_close($dbc);
			exit;
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
    <title>HAFA</title>
	<meta charset ="utf-8"> 
</head>
<body>
	<h2>Manager <?php echo "$first $last";?> was successfully added</h2>
	<h3><a href="add_manager.html">Add another manager</a><h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
