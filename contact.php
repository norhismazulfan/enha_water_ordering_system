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
            <h2>Get in Touch</h2>
            <form method="post" action="send_contact.php">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br>
                <label for="message">Message:</label><br>
                <textarea id="message" name="message" rows="4" required></textarea><br>
                <input type="submit" value="Send">
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 ENHA Water. All rights reserved.</p>
    </footer>
</body>
</html>
