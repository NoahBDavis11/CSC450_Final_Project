<?php
    ini_set('error_reporting', E_ALL); // Turns on error reporting - remove once everything works.
    require_once '../mysqli_config.php'; // Connect to the database
    
    $query = "SELECT *, GROUP_CONCAT(DISTINCT emp_id SEPARATOR ', ') AS opEmps 
              FROM parkConcessions c 
              LEFT JOIN employees_concessions_operate eco ON c.cons_id = eco.cons_id  
              GROUP BY c.cons_id";
    
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
    <title>Concessions</title>
    <meta charset="utf-8"> 
</head>
<body>
    <h2>Concessions</h2>

    <table>
        <tr>
            <th>Concession</th>
            <th>Name</th>
            <th>Type</th>
            <th>Open Time</th>
            <th>Close Time</th>
            <th>Company</th>
            <th>Employees Assigned</th>
            <th>Building</th>
            <th>Section</th>
        </tr>   
    
        <?php foreach ($all_rows as $row) { ?>
            <tr>
                <td><?php echo $row['cons_id']; ?></td>
                <td><?php echo $row['cons_name']; ?></td>
                <td><?php echo $row['cons_type']; ?></td>
                <td><?php echo $row['cons_open']; ?></td>
                <td><?php echo $row['cons_close']; ?></td>
                <td><?php echo $row['cons_company_name']; ?></td>
                <td><?php echo $row['opEmps']; ?></td>
                <td><?php echo $row['build_id']; ?></td>
                <td><?php echo $row['section_id']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
