<?php
session_start();

// Check if the user is already logged in, if yes then redirect to dashboard
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IoT SmartHome</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to IoT SmartHome</h1>
        <p>Manage your smart home devices easily and efficiently.</p>
        <div class="buttons">
            <a href="pages/signin.php">Sign In</a>
            <a href="pages/signup.php">Sign Up</a>
        </div>
    </div>
</body>
</html>
