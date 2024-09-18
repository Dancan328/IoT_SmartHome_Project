<?php
session_start();

// Check if the user is logged in, if not redirect to signin page
if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
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
    <title>Dashboard</title>
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
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <h3>Your Devices</h3>
    <table>
        <tr>
            <th>Device Name</th>
            <th>Status</th>
        </tr>
        <?php
        if ($deviceResult->num_rows > 0) {
            // Output data of each row
            while ($row = $deviceResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No devices found.</td></tr>";
        }
        ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>
