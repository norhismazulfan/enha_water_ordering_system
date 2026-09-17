<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'buyer') {
    header("Location: login.php");
    exit();
}

include 'includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];
    $quantity = $_POST['quantity'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $recipient_name = $_POST['recipient_name'];
    $payment_method = $_POST['payment_method'];
    $delivery_option = $_POST['delivery_option'];

    // Fetch product price
    $sql = "SELECT price FROM products WHERE product_id='$product_id'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
    $price = $product['price'];

    // Calculate total price
    $total_price = $price * $quantity;

    $sql = "INSERT INTO orders (product_id, user_id, quantity, address, phone, recipient_name, payment_method, delivery_option) 
            VALUES ('$product_id', '$user_id', '$quantity', '$address', '$phone', '$recipient_name', '$payment_method', '$delivery_option')";

    if ($conn->query($sql) === TRUE) {
        // Show success message
        echo "<script>
                if (confirm('Order placed successfully! Do you want to go back to the dashboard?')) {
                    window.location = 'buyer_dashboard.php';
                } else {
                    window.location = 'index.php';
                }
              </script>";
    } else {
        echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    $conn->close();
} else {
    $product_id = $_GET['product_id'];

    // Fetch product details
    $sql = "SELECT * FROM products WHERE product_id='$product_id'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order - ENHA Water</title>
    <link rel="stylesheet" type="text/css" href="css/order.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        function calculateTotal() {
            var price = parseFloat(document.getElementById('price').value);
            var quantity = parseInt(document.getElementById('quantity').value);
            var total = price * quantity;
            document.getElementById('total').innerText = 'Total Price: ' + total.toFixed(3);
        }
    </script>
    <style>
        /* Additional CSS for notification popup */
        .success-message {
            background-color: #5cb85c;
            color: white;
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
    <div class="order-container">
        <h2>Order Product</h2>
        <form method="post" action="">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" value="<?php echo $product['product_name']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" value="<?php echo $product['price']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" oninput="calculateTotal()" required>
            </div>
            <div class="form-group">
                <p id="total">Total Price: </p>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="recipient_name">Recipient Name</label>
                <input type="text" id="recipient_name" name="recipient_name" required>
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="bank">Bank Transfer</option>
                    <option value="qris">QRIS</option>
                    <option value="cod">Cash on Delivery (COD)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="delivery_option">Delivery Option</label>
                <select id="delivery_option" name="delivery_option" required>
                    <option value="diantar">Delivered</option>
                    <option value="ambil">Pick Up</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Place Order</button>
            </div>
            <div class="form-group">
                <button type="button" onclick="window.location.href='buyer_dashboard.php';">Back</button>
            </div>
        </form>
    </div>

    <!-- Notification Popup -->
    <div id="success-popup" class="success-message">
        <p>Order placed successfully!</p>
        <button onclick="window.location = 'buyer_dashboard.php';">Go to Dashboard</button>
        <button onclick="window.location = 'index.php';">Back to Home</button>
    </div>

    <script>
        // Show success popup on successful order
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $conn->query($sql) === TRUE) : ?>
        document.getElementById('success-popup').style.display = 'block';
        <?php endif; ?>
    </script>
</body>
</html>
