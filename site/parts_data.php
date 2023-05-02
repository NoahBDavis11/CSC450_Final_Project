<?php
    if(!empty($_GET['rep_num'])) {
        $rep_num = $_GET['rep_num'];
        
        require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
        //Retrieve specific vendor data using prepared statements:
        $query = "SELECT * FROM replacementParts natural join repairs natural join rides WHERE rep_num = ?";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "i", $rep_num);
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
                <th>Ride ID</th>
				<th>Ride Name</th>
                <th>Replacement Part</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
				<td><?php echo $row['ride_id']; ?></td>
                <td><?php echo $row['ride_name']; ?></td>
                <td><?php echo $row['part']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No replacement parts found for the given ride and repair number.</p>
    <?php endif; ?>
    <h3><a href="find_parts.html">Lookup another repair</a></h3>
    <h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
