<?php
    if(!empty($_GET['ride_id'])) {
        $ride_id = $_GET['ride_id'];
        
        require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
        //Retrieve specific vendor data using prepared statements:
		$query = "SELECT *, r.rep_num as rep_id, count(part) as pt_count,  IFNULL(GROUP_CONCAT(distinct erp.emp_id SEPARATOR ', '), 'none') as assignedEmps 
			FROM repairs r 
			LEFT JOIN replacementParts rp ON r.rep_num = rp.rep_num AND r.ride_id = rp.ride_id 
			LEFT JOIN employees_repairs_perform erp ON r.rep_num = erp.rep_num AND r.ride_id = erp.ride_id 
			WHERE r.ride_id = ?
			GROUP BY r.rep_num";        
		$stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "i", $ride_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 
        $rows = mysqli_num_rows($result);
        mysqli_close($dbc);
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
    <meta charset ="utf-8"> 
    <!-- Add some spacing to each table cell -->
    <style> td, th {padding: 1em;} </style>
</head>
<body>
    <h2>Replacement Parts</h2>
    <?php if($rows > 0): ?>
    <table>
        <thead>
            <tr>
				<th>Repair Num</th>
                <th>Start Date</th>
				<th>Finish Date</th>
				<th>Total Cost</th>
				<th>Part Count</th>
				<th>Assigned Mechanics</th>
				<th>Company</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['rep_id']; ?></td>
                <td><?php echo $row['rep_start_date']; ?></td>
				<td><?php echo $row['rep_fin_date']; ?></td>
                <td><?php echo $row['total_cost']; ?></td>
				<td><?php echo $row['pt_count']; ?></td>
				<td><?php echo $row['assignedEmps']; ?></td>
                <td><?php echo $row['rep_company_name']; ?></td>
				<td><?php echo $row['rep_description']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No replacement parts found for the given ride and repair number.</p>
    <?php endif; ?>
    <h3><a href="find_repair.html">Lookup another repair</a></h3>
    <h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
