<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'seller') {
    header("Location: login.php");
    exit();
}

include 'includes/db_connect.php';

// Handle adding a new product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

    $sql = "INSERT INTO products (product_name, product_description, price, stock, product_image) VALUES ('$product_name', '$product_description', '$price', '$stock', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle updating stock and product name
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $new_stock = $_POST['new_stock'];
    $new_product_name = $_POST['new_product_name'];

    $sql = "UPDATE products SET stock = '$new_stock', product_name = '$new_product_name' WHERE product_id = '$product_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all products
$sql = "SELECT * FROM products";
$products_result = $conn->query($sql);

// Fetch all orders with additional user and product data
$sql = "SELECT orders.order_id, orders.product_id, orders.user_id, orders.quantity, orders.order_date, products.product_name, users.username, orders.address, orders.phone, orders.recipient_name, orders.payment_method, orders.delivery_option
        FROM orders
        JOIN products ON orders.product_id = products.product_id
        JOIN users ON orders.user_id = users.user_id";
$orders_result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Dashboard - ENHA Water</title>
    <link rel="stylesheet" type="text/css" href="css/seller_dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>ENHA Water - Seller Dashboard</h1>
            <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
        </div>
    </header>
    <nav>
        <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
        <ul id="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="?page=add_product">Add Product</a></li>
            <li><a href="?page=update_stock">Update Product</a></li>
            <li><a href="?page=view_orders">View Orders</a></li>
        </ul>
    </nav>
    <div class="container">
        <?php
        if (isset($_GET['page']) && $_GET['page'] == 'add_product') {
            ?>
            <h2>Add New Product</h2>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" required>
                </div>
                <div class="form-group">
                    <label for="product_description">Product Description</label>
                    <textarea id="product_description" name="product_description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" required>
                </div>
                <div class="form-group">
                    <label for="product_image">Product Image</label>
                    <input type="file" id="product_image" name="product_image" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="add_product">Add Product</button>
                </div>
            </form>
            <?php
        } elseif (isset($_GET['page']) && $_GET['page'] == 'update_stock') {
            ?>
            <h2>Update Product</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="product_id">Product</label>
                    <select id="product_id" name="product_id" required onchange="populateForm(this.value)">
                        <option value="">Select a product</option>
                        <?php
                        if ($products_result->num_rows > 0) {
                            while ($row = $products_result->fetch_assoc()) {
                                echo "<option value='{$row['product_id']}' data-name='{$row['product_name']}' data-stock='{$row['stock']}'>{$row['product_name']}</option>";
                            }
                        } else {
                            echo "<option value=''>No products available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="new_product_name">New Product Name</label>
                    <input type="text" id="new_product_name" name="new_product_name" required>
                </div>
                <div class="form-group">
                    <label for="new_stock">New Stock</label>
                    <input type="number" id="new_stock" name="new_stock" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="update_product">Update Product</button>
                </div>
            </form>
            <script>
                function populateForm(productId) {
                    const select = document.getElementById('product_id');
                    const option = select.querySelector(`option[value='${productId}']`);
                    document.getElementById('new_product_name').value = option.getAttribute('data-name');
                    document.getElementById('new_stock').value = option.getAttribute('data-stock');
                }
            </script>
            <?php
        } elseif (isset($_GET['page']) && $_GET['page'] == 'view_orders') {
            ?>
            <h2>View Orders</h2>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Buyer</th>
                        <th>Quantity</th>
                        <th>Order Date</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Recipient Name</th>
                        <th>Payment Method</th>
                        <th>Delivery Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($orders_result->num_rows > 0) {
                        while ($row = $orders_result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['order_id']}</td>
                                    <td>{$row['product_name']}</td>
                                    <td>{$row['username']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>{$row['order_date']}</td>
                                    <td>{$row['address']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['recipient_name']}</td>
                                    <td>{$row['payment_method']}</td>
                                    <td>{$row['delivery_option']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No orders available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            ?>
            <h2>Welcome to the Seller Dashboard</h2>
            <p>Select an option from the menu to get started.</p>
            <?php
        }
        ?>
    </div>
    <script>
        function toggleMenu() {
            var links = document.getElementById('nav-links');
            if (links.style.display === 'flex') {
                links.style.display = 'none';
            } else {
                links.style.display = 'flex';
            }
        }
    </script>
</body>
</html>
