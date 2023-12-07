<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Project Wellness Clinic</title>
</head>
<body>

<!-- Navigation Bar -->
<nav>
    <ul>
        <li <?php echo isPageActive('dashboard.php'); ?>><a href="dashboard.php">Dashboard</a></li>
        <li <?php echo isPageActive('patient_form.php'); ?>><a href="patient_form.php">Add Patient</a></li>
        <li <?php echo isPageActive('view_patient.php'); ?>><a href="view_patient.php">View Patient Data</a></li>
        <li <?php echo isPageActive('delete_patient.php'); ?>><a href="delete_patient.php">Delete Patient</a></li>
        <li <?php echo isPageActive('edit_patient.php'); ?>><a href="edit_patient.php">Edit Patient</a></li>
        <li <?php echo isPageActive('edit_profile.php'); ?>><a href="edit_profile.php">Edit Profile</a></li>
        <li <?php echo isPageActive('logout.php'); ?>><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<!-- Add this function at the bottom of header.php or in a separate file -->
<?php
function isPageActive($page)
{
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($currentPage == $page) {
        return 'class="active"';
    }
    return '';
}
?>
