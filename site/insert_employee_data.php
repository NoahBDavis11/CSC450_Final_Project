<?php
	ini_set('display_errors', 1); error_reporting(E_ALL);
/*This code assumes user input is valid and correct only for demo purposes - it does NOT validate form data.*/
	if(!empty($_GET['emp_FN']) or !empty($_GET['emp_LN'])) { 
		$emp_FN = $_GET['emp_FN'];
		$emp_LN = $_GET['emp_LN'];
		$street_name_num = $_GET['street_name_num'];
		$city = $_GET['city'];
		$emp_state = $_GET['emp_state'];
		$zip = $_GET['zip'];
		$country = $_GET['country'];
		$primary_phone = $_GET['primary_phone'];
		$email = $_GET['email'];
		$emp_role = $_GET['emp_role'];
		$salary = $_GET['salary'];

		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		
		$query3 = "INSERT INTO employees (emp_FN,emp_LN,street_name_num,city,emp_state,zip,country,primary_phone,email,emp_role,salary,date_hird) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		$stmt3 = mysqli_prepare($dbc, $query3);
		
		//second argument one for each ? either i(integer), d(double), b(blob), s(string or anything else)
		mysqli_stmt_bind_param($stmt3, "ssssssssssi", $emp_FN, $emp_LN, $street_name_num, $city, $emp_state, $zip, $country, $primary_phone, $email, $emp_role, $salary); 
		mysqli_stmt_execute($stmt3);
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
    <title>New Employee</title>
	<meta charset ="utf-8"> 
</head>
<body>
	<h2>Employee was successfully added</h2>
	<h3><a href="add_employee.html">Add another Employee</a><h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
