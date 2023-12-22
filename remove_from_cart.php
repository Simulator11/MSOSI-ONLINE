<?php
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the product ID from the POST data
    $productId = $_POST['productId'];

    // Check if the cart is set in the session
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        // Remove the product with the specified ID from the cart
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($product) use ($productId) {
            return $product['id'] != $productId;
        });

        // Send a JSON response indicating success
        echo json_encode(['success' => true]);
    } else {
        // Send a JSON response indicating failure (cart is empty)
        echo json_encode(['success' => false, 'message' => 'Cart is empty']);
    }
} else {
    // Send a JSON response indicating failure (invalid request method)
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
