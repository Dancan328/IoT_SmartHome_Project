<?php
session_start();

// Include database connection
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="post" action="">
        Username: <input type="text" name="username"><br>
        Email: <input type="text" name="email"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Sign Up">
    </form>
</body>
</html>
