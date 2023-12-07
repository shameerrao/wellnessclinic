<?php
session_start();
include('header.php');
?>

<h2>Registration Form</h2>
<form action="register.php" method="post">
    <!-- Your registration form content goes here -->
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required><br>

    <label for="employee_id">Employee ID:</label>
    <input type="text" name="employee_id" required><br>

    <input type="submit" value="Register">
</form>
