<?php 

// This file contains the database access information. 
// This file establishes a connection to MySQL and selects the database.

// Set the database access information as constants:
DEFINE ('DB_USER', 'ajc7186');  //replace yourusername with your own username
DEFINE ('DB_PASSWORD', 'Ca05Ma10Pr16Lu20%'); //replace yourDBpassword with your own DB password which (was originally sent via email from "root")
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'ajc7186'); //replace yourusername with your own username or your group db

// Make the connection:
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
//$dbc is a variable representing the current database connection which will be used by other pages to execute queries

echo "Connection successful!";  //remove this statement once you know it is working
?>