<?php
include 'includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    $sql = "INSERT INTO users (username, password, email, user_type) VALUES ('$username', '$password', '$email', '$user_type')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('success-popup').style.display = 'block';
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 3000);
                });
              </script>";
    } else {
        echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - ENHA Water</title>
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Additional CSS for notification popup */
        .success-popup {
            background-color: white;
            color: black;
            text-align: center;
            padding: 1em;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
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
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>      
            </div>
            <div class="form-group">
                <label for="user_type">User Type</label>
                <select id="user_type" name="user_type">
                    
                    <option value="buyer">Buyer</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>

    <!-- Notification Popup -->
    <div id="success-popup" class="success-popup">
        <p>Account registered successfully!</p>
    </div>
</body>
</html>
