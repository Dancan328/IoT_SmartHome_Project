<?php
session_start();

// Include database connection
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid email or password";
        }
    } else {
        $error = "User not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>
    <h2>Sign In</h2>
    <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="post" action="">
        Email: <input type="text" name="email"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Sign In">
    </form>
</body>
</html>
