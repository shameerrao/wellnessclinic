<?php
session_start();
include('header.php');
include('db_connection.php');

// Fetch all patient details from the database
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Data</title>
</head>
<body>
    <h2>View Patient Data</h2>

    <!-- Display patient data in a table -->
    <table border="1">
        <tr>
            <th>Patient ID</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Sex</th>
            <th>Insurance Provider</th>
            <th>Insurance Number</th>
            <th>Phone Number</th>
            <th>Patient Address</th>
            <th>Blood Type</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['patientID'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['dob'] . "</td>";
                echo "<td>" . $row['sex'] . "</td>";
                echo "<td>" . $row['InsuranceProvider'] . "</td>";
                echo "<td>" . $row['InsuranceNumber'] . "</td>";
                echo "<td>" . $row['PhoneNumber'] . "</td>";
                echo "<td>" . $row['PatientAddress'] . "</td>";
                echo "<td>" . $row['BloodType'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No patients found</td></tr>";
        }
        ?>
    </table>

    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
