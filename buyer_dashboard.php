<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'buyer') {
    header("Location: login.php");
    exit();
}

include 'includes/db_connect.php';

// Fetch all products
$sql = "SELECT * FROM products LIMIT 12";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buyer Dashboard - ENHA Water</title>
    <link rel="stylesheet" type="text/css" href="css/buyer_dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <div class="hamburger-menu" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <h1>ENHA Water</h1>
        <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    </header>
    <nav id="navMenu" class="nav-menu">
        <a href="index.php">Beranda</a>
    </nav>
    <div class="container">
        <h2>Available Products</h2>
        <div class="products">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>
                            <img src='{$row['product_image']}' alt='{$row['product_name']}'>
                            <h3>{$row['product_name']}</h3>
                            <p>{$row['product_description']}</p>
                            <p>Price: {$row['price']}</p>
                            <p>Stock: {$row['stock']}</p>
                            <a href='order.php?product_id={$row['product_id']}' class='btn'>Order Now</a>
                          </div>";
                }
            } else {
                echo "<p>No products available</p>";
            }
            ?>
        </div>
    </div>

    <!-- Chatbot Section -->
    <div class="chatbot-container">
        <h2>Ask our Chatbot</h2>
        <div class="chatbox" id="chatbox">
            <div class="messages" id="messages"></div>
            <div class="input-box">
                <input type="text" id="userInput" placeholder="Ask me anything..." />
                <button onclick="sendMessage()">Send</button>
            </div>
        </div>
    </div>

    <script>
        function sendMessage() {
            var userInput = document.getElementById('userInput').value;
            if (userInput.trim() === '') return;

            var userMessage = document.createElement('div');
            userMessage.className = 'user-message';
            userMessage.textContent = userInput;
            document.getElementById('messages').appendChild(userMessage);

            fetch('chatbot.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ message: userInput })
            })
            .then(response => response.json())
            .then(data => {
                var botMessage = document.createElement('div');
                botMessage.className = 'bot-message';
                botMessage.textContent = data.response;
                document.getElementById('messages').appendChild(botMessage);
            });

            document.getElementById('userInput').value = '';
        }

        function toggleMenu() {
            var navMenu = document.getElementById('navMenu');
            if (navMenu.style.transform === 'translateX(0px)') {
                navMenu.style.transform = 'translateX(-250px)';
            } else {
                navMenu.style.transform = 'translateX(0px)';
            }
        }
    </script>
</body>
</html>
