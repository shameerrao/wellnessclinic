<?php
session_start();
include('header.php');
?>

<h2>Login Form</h2>
<form action="login.php" method="post">
    <!-- Your login form content goes here -->
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Login">
</form>
