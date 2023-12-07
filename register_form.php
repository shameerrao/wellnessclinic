<?php
session_start();
include('header.php');
?>

<h2>Registration Form</h2>
<form action="register.php" method="post">
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

    <label for="role">Role:</label>
    <select name="role" required>
        <option value="Admin">Admin</option>
        <option value="Doctor">Doctor</option>
        <option value="Nurse">Nurse</option>
        <option value="Staff">Staff</option>
    </select><br>

    <input type="submit" value="Register">
</form>
