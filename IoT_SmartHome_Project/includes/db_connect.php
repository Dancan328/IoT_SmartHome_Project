<?php
$servername = "localhost"; // Change this if your MySQL server is on a different host
$username = "root"; // Change this to your MySQL username
$dbname = "iot"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, '', $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
