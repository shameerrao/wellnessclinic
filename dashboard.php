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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $first_name . ' ' . $last_name; ?>!</h2>

    <!-- Add links for actions -->
    <ul>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="edit_profile.php">Edit Profile</a></li>
    </ul>
</body>
</html>