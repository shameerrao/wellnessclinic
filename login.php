<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify the entered password with the stored hash
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session and redirect to the dashboard
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
        } else {
            // Debugging statements
            echo "Entered password: " . $password . "<br>";
            echo "Stored hashed password: " . $row['password'] . "<br>";
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}

$conn->close();
?>
