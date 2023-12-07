<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientID = $_POST['patient_id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $insuranceProvider = $_POST['insurance_provider'];
    $insuranceNumber = $_POST['insurance_number'];
    $phoneNumber = $_POST['phone_number'];
    $patientAddress = $_POST['patient_address'];
    $bloodType = $_POST['blood_type'];

    // Basic input validation
    if (empty($patientID) || empty($name) || empty($dob) || empty($sex) || empty($insuranceProvider) || empty($insuranceNumber) || empty($phoneNumber) || empty($patientAddress) || empty($bloodType)) {
        $errorMessage = "Error: All fields are required.";
        header("Location: dashboard.php?errorMessage=" . urlencode($errorMessage)); // Redirect to dashboard with error message
        exit();
    } else {
        // Sanitize input to prevent SQL injection
        $patientID = mysqli_real_escape_string($conn, $patientID);
        $name = mysqli_real_escape_string($conn, $name);
        $dob = mysqli_real_escape_string($conn, $dob);
        $sex = mysqli_real_escape_string($conn, $sex);
        $insuranceProvider = mysqli_real_escape_string($conn, $insuranceProvider);
        $insuranceNumber = mysqli_real_escape_string($conn, $insuranceNumber);
        $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);
        $patientAddress = mysqli_real_escape_string($conn, $patientAddress);
        $bloodType = mysqli_real_escape_string($conn, $bloodType);

        $sql = "INSERT INTO patients (PatientID, Name, DOB, Sex, InsuranceProvider, InsuranceNumber, PhoneNumber, PatientAddress, BloodType)
                VALUES ('$patientID', '$name', '$dob', '$sex', '$insuranceProvider', '$insuranceNumber', '$phoneNumber', '$patientAddress', '$bloodType')";

        if ($conn->query($sql) === TRUE) {
            $successMessage = "Patient added successfully!";
            header("Location: dashboard.php?successMessage=" . urlencode($successMessage)); // Redirect to dashboard with success message
            exit();
        } else {
            $errorMessage = "Error adding patient: " . $conn->error;
            header("Location: dashboard.php?errorMessage=" . urlencode($errorMessage)); // Redirect to dashboard with error message
            exit();
        }
    }
}

$conn->close();
?>
