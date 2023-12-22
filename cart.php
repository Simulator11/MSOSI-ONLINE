<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the cart is set in the session
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        // Loop through the cart items and display them
        foreach ($_SESSION['cart'] as $index => $product) {
            echo '<div class="cart-item">';
            echo '<p>Product Name: ' . (isset($product['name']) ? $product['name'] : 'N/A') . '</p>';
            echo '<p>Price: TZS ' . (isset($product['price']) ? $product['price'] : 'N/A') . '</p>';
            echo '<button onclick="removeFromCart(' . $index . ')">Remove</button>';
            echo '</div>';
        }
    } else {
        echo '<p>Your cart is empty</p>';
    }
} else {
    // Handle other request methods if needed
    // For example, you might want to handle POST requests to update the cart
    // or remove items from the cart
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
