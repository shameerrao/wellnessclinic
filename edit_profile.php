<?php
session_start();
include('header.php');
include('db_connection.php');

if (!isset($_SESSION['username'])) {
    header("Location: login_form.php");
    exit();
}

$username = $_SESSION['username'];


// Fetch user details from the database
$sql = "SELECT email, first_name, last_name, employee_id, role FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result && $result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $employee_id = $row['employee_id'];
    $role = $row['role'];
} else {
    // Handle the case where user details are not found or query fails
    $email = "Unknown";
    $first_name = "Unknown";
    $last_name = "Unknown";
    $employee_id = "Unknown";
    $role = "Unknown";
}

// Update user profile on form submission
$updateMessage = ''; // Variable to store update success or error message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newEmail = $_POST['new_email'];
    $newFirstName = $_POST['new_first_name'];
    $newLastName = $_POST['new_last_name'];
    $newEmployeeID = $_POST['new_employee_id'];
    $newRole = $_POST['new_role'];

    $updateSql = "UPDATE users SET email='$newEmail', first_name='$newFirstName', last_name='$newLastName', employee_id='$newEmployeeID', role='$newRole' WHERE username='$username'";

    if ($conn->query($updateSql) === TRUE) {
        $updateMessage = "Profile updated successfully!";
        // Refresh user details after update
        $email = $newEmail;
        $first_name = $newFirstName;
        $last_name = $newLastName;
        $employee_id = $newEmployeeID;
        $role = $newRole;
    } else {
        $updateMessage = "Error updating profile: " . $conn->error;
    }

    // Redirect to dashboard with update message
    header("Location: dashboard.php?updateMessage=" . urlencode($updateMessage));
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>

    <!-- Display current user details -->
    <p>Current Email: <?php echo $email; ?></p>
    <p>Current First Name: <?php echo $first_name; ?></p>
    <p>Current Last Name: <?php echo $last_name; ?></p>
    <p>Current Employee ID: <?php echo $employee_id; ?></p>
    <p>Current Role: <?php echo $role; ?></p>

    <!-- Display update message -->
    <?php
    if (!empty($updateMessage)) {
        echo "<p>$updateMessage</p>";
    }
    ?>

    <!-- Form to edit user details -->
    <form action="" method="post">
        <label for="new_email">New Email:</label>
        <input type="email" name="new_email" value="<?php echo $email; ?>" required><br>

        <label for="new_first_name">New First Name:</label>
        <input type="text" name="new_first_name" value="<?php echo $first_name; ?>" required><br>

        <label for="new_last_name">New Last Name:</label>
        <input type="text" name="new_last_name" value="<?php echo $last_name; ?>" required><br>

        <label for="new_employee_id">New Employee ID:</label>
        <input type="text" name="new_employee_id" value="<?php echo $employee_id; ?>" required><br>

        <label for="new_role">New Role:</label>
        <select name="new_role" required>
            <option value="Admin" <?php echo ($role == 'Admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="Doctor" <?php echo ($role == 'Doctor') ? 'selected' : ''; ?>>Doctor</option>
            <option value="Nurse" <?php echo ($role == 'Nurse') ? 'selected' : ''; ?>>Nurse</option>
            <option value="Staff" <?php echo ($role == 'Staff') ? 'selected' : ''; ?>>Staff</option>
        </select><br>

        <input type="submit" value="Update Profile">
    </form>
</body>
</html>
