 <?php
 	ini_set ('error_reporting', 1); //Turns on error reporting - remove once everything works.
 	require_once('../mysqli_config.php'); //Connect to the database
 	$query = 'SELECT BuildingID, InsName, DateLast, DateNext, CONCAT(MFirstName," ",MLastName) AS ManagerName
  FROM HAinspecting NATURAL JOIN HAinspector NATURAL JOIN HAbuilding LEFT JOIN HAmanager ON (ManagerID = BManagerID)
  ORDER BY BuildingID, DateLast; ';
 	$result = mysqli_query($dbc, $query);
 	//Fetch all rows of result as an associative array
 	if($result)
 		$all_rows= mysqli_fetch_all($result, MYSQLI_ASSOC); //get the result as an associative, 2-dimensional array
 	else {
 		echo "<h2>We are unable to process this request right now.</h2>";
 		echo "<h3>Please try again later.</h3>";
 		exit;
 	}
 	mysqli_close($dbc);
 ?>
 <!DOCTYPE html>
 <!-- Alexander J. Cossifos -->
 <html lang="en">
 <head>
     <title>IR</title>
 	<meta charset ="utf-8">
 </head>
 <body>
 	<h2>Inspection Report</h2>

 	<table>
 		<tr>
 			<th>BuildingID</th>
 			<th>Inspector Name</th>
 			<th>Last Inspection Date</th>
      <th>Next Inspection Date</th>
      <th>Buidling Manager Name</th>
 		</tr>
 		<?php foreach ($all_rows as $client) {
 			echo "<tr>";
 			echo "<td>".$client['BuildingID']."</td>";
 			echo "<td>".$client['InsName']."</td>";
 			echo "<td>".$client['DateLast']."</td>";
 			echo "<td>".$client['DateNext']."</td>";
      echo "<td>".$client['ManagerName']."</td>";
 			echo "</tr>";
 		}
 		?>
 	</table>
 </body>
 </html>
