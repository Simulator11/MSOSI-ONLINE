<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shopping Cart</title>
    <style>

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* This ensures that the body takes at least the full height of the viewport */
        }

        .cart {
            text-align: center;
            padding: 20px;
        }

        #cartContents {
            display: flex;
            flex-wrap: wrap; /* Allow items to wrap to the next line */
            justify-content: space-around; /* Distribute items evenly along the main axis */
        }

        .cart-item {
            width: 200px; /* Adjust the width based on your design */
            margin: 10px; /* Add some margin between items */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #2ecc71; /* Green color */
            color: white;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        nav ul {
            list-style-type: none;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav a {
            text-decoration: none;
            color: white;
        }

        footer {
            background-color: #2ecc71; /* Green color */
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Msosi Online</div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Specials</a></li>
            </ul>
        </nav>
    </header>

    <section class="cart">
        <h2>Your Shopping Cart</h2>
        <div id="cartContents"></div>
    </section>

    <!-- Payment Form -->
    <section class="cart">
        <h2>Payment</h2>
        <form id="paymentForm">
            <label for="cardNumber">Card Number:</label>
            <input type="text" id="cardNumber" placeholder="Enter card number" required>
            
            <label for="expiryDate">Expiry Date:</label>
            <input type="text" id="expiryDate" placeholder="MM/YYYY" required>
            
            <label for="cvc">CVC:</label>
            <input type="text" id="cvc" placeholder="CVC" required>

            <button type="button" onclick="makeDemoPayment()">Make Payment</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2023 Msosi Online. All rights reserved.</p>
    </footer>

    <script>
        // Fetch and display cart contents using JavaScript and AJAX
        function fetchCartContents() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("cartContents").innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", "cart.php", true);
            xhr.send();
        }

        // Call the function on page load
        window.onload = function () {
            fetchCartContents();
        };

        // Add this function inside the existing <script> tag in your HTML file
        function removeFromCart(productId) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Refresh the cart contents after removing an item
                        fetchCartContents();
                    } else {
                        alert('Failed to remove item from the cart. ' + response.message);
                    }
                }
            };
            xhr.open('POST', 'remove_from_cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data = 'productId=' + encodeURIComponent(productId);
            xhr.send(data);
        }

        // Add the function for the simulated payment
        function makeDemoPayment() {
            // Collect payment details
            var cardNumber = document.getElementById('cardNumber').value;
            var expiryDate = document.getElementById('expiryDate').value;
            var cvc = document.getElementById('cvc').value;

            // Simulate a successful payment response
            var paymentResponse = {
                success: true,
                message: 'Payment successful. Thank you for your purchase!'
            };

            // Display the payment result
            if (paymentResponse.success) {
                alert(paymentResponse.message);

                // Clear the cart or perform any other necessary actions

                // Optionally, redirect to a confirmation page
                // window.location.href = 'confirmation.php';
            } else {
                alert('Payment failed. ' + paymentResponse.message);
            }
        }
        // Add the function for the simulated payment
function makeDemoPayment() {
    // Collect payment details
    var cardNumber = document.getElementById('cardNumber').value;
    var expiryDate = document.getElementById('expiryDate').value;
    var cvc = document.getElementById('cvc').value;

    // Prepare data for the server
    var paymentData = {
        cardNumber: cardNumber,
        expiryDate: expiryDate,
        cvc: cvc
    };

    // Send payment data to the server for processing
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Payment successful
                alert(response.message);

                // Clear the cart or perform any other necessary actions

                // Optionally, redirect to a confirmation page
                // window.location.href = 'confirmation.php';
            } else {
                // Payment failed
                alert('Payment failed. ' + response.message);
            }
        }
    };
    xhr.open('POST', 'process_payment.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(paymentData));
}
// Add the function for the simulated payment
function makeDemoPayment() {
    // Collect payment details
    var cardNumber = document.getElementById('cardNumber').value;
    var expiryDate = document.getElementById('expiryDate').value;
    var cvc = document.getElementById('cvc').value;

    // Get the total value of products in the cart
    var cartTotal = calculateCartTotal();

    // Check if the cart is empty
    if (cartTotal === 0) {
        alert('Cannot proceed with payment. Your cart is empty.');
        return;
    }

    // Prepare data for the server
    var paymentData = {
        cardNumber: cardNumber,
        expiryDate: expiryDate,
        cvc: cvc,
        cartTotal: cartTotal
    };

    // Send payment data to the server for processing
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Payment successful
                alert(response.message);

                // Clear the cart or perform any other necessary actions

                // Optionally, redirect to a confirmation page
                // window.location.href = 'confirmation.php';
            } else {
                // Payment failed
                alert('Payment failed. ' + response.message);
            }
        }
    };
    xhr.open('POST', 'process_payment.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(paymentData));
}

// Function to calculate the total value of products in the cart
function calculateCartTotal() {
    var cartContents = document.getElementById('cartContents');
    var cartItems = cartContents.getElementsByClassName('cart-item');
    var total = 0;

    for (var i = 0; i < cartItems.length; i++) {
        var item = cartItems[i];
        var priceElement = item.querySelector('.price');
        var quantityElement = item.querySelector('.quantity');

        if (priceElement && quantityElement) {
            var price = parseFloat(priceElement.innerText.replace('$', '')); // Assuming the price is in dollars
            var quantity = parseInt(quantityElement.innerText);

            total += price * quantity;
        }
    }

    return total;
}
    </script>
</body>
</html>
