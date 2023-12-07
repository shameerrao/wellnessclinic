<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientID = $_POST['patient_id'];

    $deleteSql = "DELETE FROM patients WHERE PatientID = '$patientID'";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Patient deleted successfully!";
    } else {
        echo "Error deleting patient: " . $conn->error;
    }
}

$conn->close();
?>
