<?php
include 'includes/db_connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_type'] = $row['user_type'];

            if ($row['user_type'] == 'seller') {
                header("Location: seller_dashboard.php");
            } else {
                header("Location: buyer_dashboard.php");
            }
        } else {
            echo "<p class='error'>Invalid password</p>";
        }
    } else {
        echo "<p class='error'>No user found</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - ENHA Water</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>
</body>
</html>
