<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Msosi Online</title>
    <style>
        /* Your existing styles go here */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
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

        .hero {
            text-align: center;
            padding: 100px 0;
            background-color: #f4f4f4;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db; /* Light blue color */
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }

        .featured-products {
            text-align: center;
            padding: 100px 0;
        }

        .product-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .product {
            width: calc(15% - 30px); /* Adjust the width based on the number of products per row */
            margin: 20px;
            padding: 20px;
            background-color: grey;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product img {
            max-width: 100%;
            border-radius: 5px;
        }

        .testimonials {
            background-color: lightblue;
            text-align: center;
            padding: 50px 0;
            font-size: 20px;
            font-family: sans-serif;

        }

        .testimonial {
            margin-bottom: 30px;
        }

        footer {
            background-color: #2ecc71; /* Green color */
            color: white;
            text-align: center;
            padding: 10px;
        }

        /* Add styles for the search bar */
        .search-bar {
            text-align: center;
            margin: 20px 0;
        }

        .search-bar input {
            padding: 10px;
            width: 60%;
        }

        .search-bar button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
<script>
    function search() {
        // Get the search query
        var query = document.getElementById("searchInput").value;

        // Make an AJAX request to the backend to fetch search results
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Update the product container with the search results
                document.querySelector(".product-container").innerHTML = xhr.responseText;
            }
        };
        xhr.open("GET", "search.php?q=" + query, true);
        xhr.send();
    }
</script>
<script>
        // JavaScript for search functionality
        function search() {
            // Get the search query
            var query = document.getElementById("searchInput").value;

            // Implement your search logic here
            // For simplicity, let's just log the query to the console
            console.log("Search query: " + query);
        }
    </script>
<script>
    function addToCart(productId, productName, productPrice) {
        // Make an AJAX request to the back-end to add the product to the cart
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Handle the success response (you can customize this based on your needs)
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert(productName + ' added to cart successfully!');
                    } else {
                        alert('Failed to add ' + productName + ' to cart.');
                    }
                } else {
                    // Handle the error response
                    alert('Error adding ' + productName + ' to cart.');
                }
            }
        };

        xhr.open('POST', 'cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var data = 'productId=' + encodeURIComponent(productId) + '&productName=' + encodeURIComponent(productName) + '&productPrice=' + encodeURIComponent(productPrice);
        xhr.send(data);
    }
</script>

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


     
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search...">
        <button onclick="search()">Search</button>
    </div>

    <section class="hero">
        <h1>Welcome to Msosi Online</h1>
        <p>Discover a variety of delicious dishes made with love!</p>
        <a href="#" class="cta-button">Explore Menu</a>
    </section>

    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="product-container">
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

// Display products
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product">';
        echo '<img src="' . $row['image_url'] . '" alt="' . $row['product_name'] . '">';
        echo '<h3>' . $row['product_name'] . '</h3>';
        echo '<p>' . $row['description'] . '</p>';
        echo '<p class="price">Price: TZS ' . $row['price'] . '</p>';
        echo '<button onclick="addToCart(' . $row['id'] . ', \'' . $row['product_name'] . '\', ' . $row['price'] . ')">Add to Cart</button>';
        echo '</div>';
    }
} else {
    echo "No products found";
}
            // Close connection
            $conn->close();
            ?>
        </div>
    </section>

    <!-- The rest of your HTML content and scripts go here -->

    <footer>
        <p>&copy; 2023 Msosi Online. All rights reserved.</p>
    </footer>
</body>
</html>
