<?php
session_start();
include('header.php');
?>

<h2>Login Form</h2>
<form action="login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Login">
</form>

<!-- Button to navigate to the registration form -->
<form action="register_form.php">
    <input type="submit" value="Register Here">
</form>
