<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['username'])) {
    header("Location: login_form.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch user details from the database
$sql = "SELECT first_name, last_name FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result && $result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
} else {
    // Handle the case where user details are not found or query fails
    $first_name = "Unknown";
    $last_name = "Unknown";
}

// Update user profile on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newFirstName = $_POST['new_first_name'];
    $newLastName = $_POST['new_last_name'];

    $updateSql = "UPDATE users SET first_name='$newFirstName', last_name='$newLastName' WHERE username='$username'";

    if ($conn->query($updateSql) === TRUE) {
        echo "Profile updated successfully!";
        // Refresh user details after update
        $first_name = $newFirstName;
        $last_name = $newLastName;
    } else {
        echo "Error updating profile: " . $conn->error;
    }
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
    <p>Current First Name: <?php echo $first_name; ?></p>
    <p>Current Last Name: <?php echo $last_name; ?></p>

    <!-- Form to edit user details -->
    <form action="" method="post">
        <label for="new_first_name">New First Name:</label>
        <input type="text" name="new_first_name" required><br>

        <label for="new_last_name">New Last Name:</label>
        <input type="text" name="new_last_name" required><br>

        <input type="submit" value="Update Profile">
    </form>

    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
