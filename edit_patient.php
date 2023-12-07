<?php
session_start();
include('header.php');
include('db_connection.php');

if (!isset($_SESSION['username'])) {
    header("Location: login_form.php");
    exit();
}

// Check if the PatientID is provided in the URL
if (!isset($_GET['PatientID'])) {
    echo "Patient ID not provided";
    exit();
}

$patientID = $_GET['PatientID'];

// Fetch patient details from the database
$sql = "SELECT * FROM patients WHERE PatientID = '$patientID'";
$result = $conn->query($sql);

if ($result && $result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $name = $row['Name'];
    $dob = $row['DOB'];
    $sex = $row['Sex'];
    // Add other fields similarly
} else {
    echo "Patient not found";
    exit();
}

// Update patient details on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST['new_name'];
    $newDob = $_POST['new_dob'];
    $newSex = $_POST['new_sex'];
    // Add other fields similarly

    $updateSql = "UPDATE patients SET Name='$newName', DOB='$newDob', Sex='$newSex' WHERE PatientID='$patientID'";

    if ($conn->query($updateSql) === TRUE) {
        echo "Patient details updated successfully!";
        // Refresh patient details after update
        $name = $newName;
        $dob = $newDob;
        $sex = $newSex;
        // Add other fields similarly
    } else {
        echo "Error updating patient details: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Details</title>
</head>
<body>
    <h2>Edit Patient Details</h2>

    <!-- Form to edit patient details -->
    <form action="" method="post">
        <label for="new_name">New Name:</label>
        <input type="text" name="new_name" value="<?php echo $name; ?>" required><br>

        <label for="new_dob">New DOB:</label>
        <input type="date" name="new_dob" value="<?php echo $dob; ?>" required><br>

        <label for="new_sex">New Sex:</label>
        <select name="new_sex" required>
            <option value="male" <?php echo ($sex == 'male') ? 'selected' : ''; ?>>Male</option>
            <option value="female" <?php echo ($sex == 'female') ? 'selected' : ''; ?>>Female</option>
            <!-- Add more options as needed -->
        </select><br>

        <!-- Add other fields similarly -->

        <input type="submit" value="Update Patient Details">
    </form>

    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
