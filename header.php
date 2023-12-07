<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website Title</title>
</head>
<body>

<div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="register_form.php">Register</a></li>
            <li><a href="login_form.php">Login</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<!-- Content starts here -->
