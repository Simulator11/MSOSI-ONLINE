<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result === FALSE) {
        echo "Error checking email: " . $conn->error;
        exit;
    }

    if ($result->num_rows > 0) {
        echo "Email already exists. Please use a different email.";
        exit;
    }

    // Insert user data into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php"); // Redirect to login.php
        exit;
    } else {
        echo "Error registering user: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
