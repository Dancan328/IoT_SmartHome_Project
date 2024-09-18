<?php
session_start();

// Check if the user is logged in, if not redirect to signin page
if (!isset($_SESSION['username'])) {
    header("Location: ../pages/signin.php");
    exit;
}

// Include database connection
require_once '../includes/db_connect.php';

// Fetch user ID from session (assuming you store it in session during login)
$username = $_SESSION['username'];
$userQuery = "SELECT id FROM users WHERE username='$username'";
$userResult = $conn->query($userQuery);

if ($userResult->num_rows > 0) {
    $userRow = $userResult->fetch_assoc();
    $userId = $userRow['id'];

    // Handle device control actions
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $deviceId = $_POST['device_id'];
        $newStatus = $_POST['new_status'];

        $updateQuery = "UPDATE devices SET status='$newStatus' WHERE id='$deviceId' AND user_id='$userId'";
        if ($conn->query($updateQuery) === TRUE) {
            $message = "Device status updated successfully.";
        } else {
            $error = "Error updating device status: " . $conn->error;
        }
    }

    // Fetch devices for the logged-in user
    $deviceQuery = "SELECT * FROM devices WHERE user_id='$userId'";
    $deviceResult = $conn->query($deviceQuery);
} else {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Control</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Device Control</h2>
    <p>Welcome, <?php echo $_SESSION['username']; ?></p>
    <?php if(isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
</body>
</html>
       
