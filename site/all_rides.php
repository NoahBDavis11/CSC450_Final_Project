<?php
    ini_set('error_reporting', E_ALL); // Turns on error reporting - remove once everything works.
    require_once '../mysqli_config.php'; // Connect to the database
    
    $query = "SELECT *, GROUP_CONCAT(distinct pr.ride_restrictions SEPARATOR ', ') as rstcts, GROUP_CONCAT(distinct emp_id SEPARATOR ', ') as opEmps FROM rides r left join passengerRestrictions pr on r.ride_id = pr.ride_id left join employees_rides_operates ero on r.ride_id = ero.ride_id WHERE r.ride_id = ? group by r.ride_id";

    $result = mysqli_query($dbc, $query);
    
    // Fetch all rows of result as an associative array
    if ($result) {
        $all_rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else { 
        echo "<h2>We are unable to process this request right now.</h2>"; 
        echo "<h3>Please try again later.</h3>";
        exit;
    } 
    mysqli_close($dbc);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rides</title>
    <meta charset="utf-8"> 
</head>
<body>
    <h2>Rides</h2>

    <table>
        <tr>
            <th>Ride</th>
            <th>Name</th>
            <th>Type</th>
            <th>Open Time</th>
            <th>Close Time</th>
            <th>Max Passengers</th>
            <th>Restrictions</th>
            <th>Employees Assigned</th>
            <th>Building</th>
            <th>Section</th>
        </tr>   

        <?php foreach ($all_rows as $row) { ?>
            <tr>
                <td><?php echo $row['r.ride_id']; ?></td>
                <td><?php echo $row['ride_name']; ?></td>
                <td><?php echo $row['ride_type']; ?></td>
                <td><?php echo $row['ride_open']; ?></td>
                <td><?php echo $row['ride_close']; ?></td>
                <td><?php echo $row['max_passengers']; ?></td>
                <td><?php echo $row['rstcts']; ?></td>
                <td><?php echo $row['opEmps']; ?></td>
                <td><?php echo $row['build_id']; ?></td>
                <td><?php echo $row['section_id']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
