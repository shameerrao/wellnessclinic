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

    $sql = "INSERT INTO patients (PatientID, Name, DOB, Sex, InsuranceProvider, InsuranceNumber, PhoneNumber, PatientAddress, BloodType)
            VALUES ('$patientID', '$name', '$dob', '$sex', '$insuranceProvider', '$insuranceNumber', '$phoneNumber', '$patientAddress', '$bloodType')";

    if ($conn->query($sql) === TRUE) {
        echo "Patient added successfully!";
    } else {
        echo "Error adding patient: " . $conn->error;
    }
}

$conn->close();
?>
