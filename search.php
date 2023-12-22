<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Check if the query executed successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Display products
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product">';
        echo '<img src="' . $row['image_url'] . '" alt="' . $row['product_name'] . '">';
        echo '<h3>' . $row['product_name'] . '</h3>';
        echo '<p>' . $row['description'] . '</p>';
        echo '<p class="price">Price: TZS ' . $row['price'] . '</p>';
        echo '</div>';
    }
} else {
    echo "No products found";
}

// Close connection
$conn->close();
?>
