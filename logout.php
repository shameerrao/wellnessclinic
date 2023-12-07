<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>

<script>
    // JavaScript function to show the confirmation dialog
    function confirmLogout() {
        var result = confirm("Are you sure you want to logout?");
        if (result) {
            // If the user clicks 'Yes', redirect to login page
            window.location.href = 'login_form.php';
        } else {
            // If the user clicks 'No', redirect back to the dashboard
            window.location.href = 'dashboard.php';
        }
    }

    // Call the function when the page loads
    confirmLogout();
</script>

</body>
</html>
