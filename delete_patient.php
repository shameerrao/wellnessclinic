<?php
session_start();
include('header.php');
include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login_form.php");
    exit();
}

$confirmationMessage = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredPatientID = $_POST['patient_id'];

    // Check if entered patient ID matches the one to be deleted
    if (isset($_SESSION['patientToDelete']) && $_SESSION['patientToDelete'] == $enteredPatientID) {
        // Confirm deletion
        $deleteSql = "DELETE FROM patients WHERE PatientID = '$enteredPatientID'";

        if ($conn->query($deleteSql) === TRUE) {
            $confirmationMessage = "Patient with ID $enteredPatientID deleted successfully!";
            unset($_SESSION['patientToDelete']); // Clear the stored patient ID
        } else {
            $confirmationMessage = "Error deleting patient: " . $conn->error;
        }
    } else {
        // Store patient ID for confirmation
        $_SESSION['patientToDelete'] = $enteredPatientID;
        $confirmationMessage = "Are you sure you want to delete the patient with ID $enteredPatientID?";
    }

    // Redirect to the dashboard with the confirmation message
    header("Location: dashboard.php?confirmationMessage=" . urlencode($confirmationMessage));
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Patient</title>
</head>
<body>
    <h2>Delete Patient</h2>

    <!-- Display confirmation message -->
    <?php
    if (!empty($confirmationMessage)) {
        echo "<p>$confirmationMessage</p>";
    }
    ?>

    <!-- Form to enter patient ID for deletion -->
    <form action="" method="post">
        <label for="patient_id">Enter Patient ID:</label>
        <input type="text" name="patient_id" required>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
