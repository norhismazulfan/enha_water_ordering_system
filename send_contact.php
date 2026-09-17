<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Simpan atau kirim pesan kontak ke email atau database
    // Contoh: kirim email (konfigurasi pengiriman email diperlukan)
    $to = "your-email@example.com";
    $subject = "Contact Form Submission from $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    if (mail($to, $subject, $body)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us - ENHA Water</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Contact Us</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Thank You</h2>
            <p>Your message has been sent. We will get back to you soon.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 ENHA Water. All rights reserved.</p>
    </footer>
</body>
</html>
