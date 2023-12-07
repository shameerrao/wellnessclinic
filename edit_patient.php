<?php
session_start();
include('header.php');
include('db_connection.php');

if (!isset($_SESSION['username'])) {
    header("Location: login_form.php");
    exit();
}

$editMessage = '';
$showEnterPatientIDForm = true;
$patientID = '';

// Update patient details on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['patient_id'])) {
    $patientID = $_POST['patient_id'];

    // Check if the PatientID is provided
    if (!empty($patientID)) {
        // Fetch patient details from the database
        $sql = "SELECT * FROM patients WHERE PatientID = '$patientID'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $dob = $row['dob'];
            $sex = $row['sex'];
            $insuranceProvider = $row['InsuranceProvider'];
            $insuranceNumber = $row['InsuranceNumber'];
            $phoneNumber = $row['PhoneNumber'];
            $patientAddress = $row['PatientAddress'];
            $bloodType = $row['BloodType'];

            $showEnterPatientIDForm = false; // Do not display the first form
            $editMessage = "Patient found. You can now edit the details.";
        } else {
            $editMessage = "Patient not found. Please enter a valid Patient ID.";
        }
    } else {
        $editMessage = "Please enter a Patient ID.";
    }
}

// Handle form submission for updating patient details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_patient'])) {
    $newName = $_POST['new_name'];
    $newDob = $_POST['new_dob'];
    $newSex = $_POST['new_sex'];
    $newInsuranceProvider = $_POST['new_insurance_provider'];
    $newInsuranceNumber = $_POST['new_insurance_number'];
    $newPhoneNumber = $_POST['new_phone_number'];
    $newPatientAddress = $_POST['new_patient_address'];
    $newBloodType = $_POST['new_blood_type'];

    // Add a check to ensure $patientID is defined
    if (!empty($patientID)) {
        $updateSql = "UPDATE patients SET 
                      name='$newName', 
                      dob='$newDob', 
                      sex='$newSex', 
                      InsuranceProvider='$newInsuranceProvider', 
                      InsuranceNumber='$newInsuranceNumber', 
                      PhoneNumber='$newPhoneNumber', 
                      PatientAddress='$newPatientAddress', 
                      BloodType='$newBloodType' 
                      WHERE PatientID='$patientID'";

        if ($conn->query($updateSql) === TRUE) {
            $editMessage = "Patient details updated successfully!";
        } else {
            $editMessage = "Error updating patient details: " . $conn->error;
        }
    } else {
        $editMessage = "Error: Patient ID not defined.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Details</title>
    <style>
        /* Add your styling here */
    </style>
</head>
<body>
    <h2>Edit Patient Details</h2>

    <!-- Display edit message -->
    <?php
    if (!empty($editMessage)) {
        echo "<p>$editMessage</p>";
    }
    ?>

    <!-- Form to enter Patient ID -->
    <?php if ($showEnterPatientIDForm) { ?>
        <form action="" method="post">
            <label for="patient_id">Enter Patient ID:</label>
            <input type="text" name="patient_id" required>
            <input type="submit" name="find_patient" value="Find Patient">
        </form>
    <?php } ?>

    <?php if (!empty($name)) { ?>
        <!-- Form to edit patient details -->
        <form action="" method="post">
            <input type="hidden" name="patient_id" value="<?php echo $patientID; ?>">
            <label for="new_name">New Name:</label>
            <input type="text" name="new_name" value="<?php echo $name; ?>" required><br>

            <label for="new_dob">New DOB:</label>
            <input type="date" name="new_dob" value="<?php echo $dob; ?>" required><br>

            <label for="new_sex">New Sex:</label>
            <select name="new_sex" required>
                <option value="male" <?php echo ($sex == 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo ($sex == 'female') ? 'selected' : ''; ?>>Female</option>
				<option value="other" <?php echo ($sex == 'other') ? 'selected' : ''; ?>>Other</option>
            </select><br>

            <label for="new_insurance_provider">New Insurance Provider:</label>
            <input type="text" name="new_insurance_provider" value="<?php echo $insuranceProvider; ?>"><br>

            <label for="new_insurance_number">New Insurance Number:</label>
            <input type="text" name="new_insurance_number" value="<?php echo $insuranceNumber; ?>"><br>

            <label for="new_phone_number">New Phone Number:</label>
            <input type="tel" name="new_phone_number" value="<?php echo $phoneNumber; ?>"><br>

            <label for="new_patient_address">New Patient Address:</label>
            <input type="text" name="new_patient_address" value="<?php echo $patientAddress; ?>"><br>

            <label for="new_blood_type">New Blood Type:</label>
            <select name="new_blood_type" required>
                <option value="A" <?php echo ($bloodType == 'A') ? 'selected' : ''; ?>>A</option>
                <option value="B" <?php echo ($bloodType == 'B') ? 'selected' : ''; ?>>B</option>
                <option value="AB" <?php echo ($bloodType == 'AB') ? 'selected' : ''; ?>>AB</option>
                <option value="O" <?php echo ($bloodType == 'O') ? 'selected' : ''; ?>>O</option>
            </select><br>

            <input type="submit" name="update_patient" value="Update Patient Details">
        </form>
    <?php } ?>
</body>
</html>
