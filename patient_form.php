<?php
session_start();
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Entry Form</title>

    <!-- Include jQuery and Inputmask library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://rawgit.com/RobinHerbots/Inputmask/5.x/dist/jquery.inputmask.min.js"></script>

</head>
<body>
    <h2>Patient Entry Form</h2>

    <!-- Form to add or edit patient details -->
    <form action="add_patient.php" method="post">
        <label for="patient_id">Patient ID:</label>
        <input type="text" name="patient_id" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="dob">DOB:</label>
        <input type="date" name="dob" required><br>

        <label for="sex">Sex:</label>
        <select name="sex" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
			<option value="other">Other</option>

        </select><br>

        <label for="insurance_provider">Insurance Provider:</label>
        <input type="text" name="insurance_provider" required><br>

        <label for="insurance_number">Insurance Number:</label>
        <input type="text" name="insurance_number" required><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" id="phone_number" required><br>

        <label for="patient_address">Patient Address:</label>
        <textarea name="patient_address" required></textarea><br>

        <label for="blood_type">Blood Type:</label>
        <select name="blood_type" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">AB</option>
            <option value="O">O</option>
        </select><br>

        <input type="submit" value="Add Patient">
    </form>

    <a href="dashboard.php">Back to Dashboard</a>

    <!-- Script to initialize Inputmask for phone number -->
    <script>
        $(document).ready(function(){
            $('#phone_number').inputmask('(999) 999-9999'); // Example format: (123) 456-7890
        });
    </script>
</body>
</html>
