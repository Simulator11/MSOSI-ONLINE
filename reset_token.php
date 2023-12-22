<?php
// Include your database connection code here
$servername = "localhost";
$username = "root";
$password ="";
$dbname = "signup_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission

    // Get the user's email from the form
    $email = $_POST['email'];

    // Generate a unique reset token (you can use a function to generate this)
    $resetToken = bin2hex(random_bytes(32));

    // Store the reset token in the database (replace with your database logic)
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the user's row with the reset token
    $updateSql = "UPDATE users SET reset_token = '$resetToken' WHERE email = '$email'";
    $conn->query($updateSql);

    // Close the database connection
    $conn->close();

    // Send the reset link to the user's email
    $resetLink = "http://yourwebsite.com/reset_password_confirm.php?email=$email&token=$resetToken";
    $to = $email;
    $subject = "Password Reset";
    $message = "Click the following link to reset your password: $resetLink";
    $headers = "From: webmaster@example.com"; // Replace with your email or leave it blank

    // Uncomment the following line to send the email (make sure your server is configured to send emails)
    mail($to, $subject, $message, $headers);

    // For testing purposes, let's just echo the reset link
    echo "Reset link: $resetLink";
} else {
    // Display the form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Msosi Online - Forgot Password</title>
    </head>
    <body>
        <div class="container">
            <form id="forgotPasswordForm" action="reset_password.php" method="POST">
                <h2>Forgot Password</h2>
                <label for="email">Enter your email:</label>
                <input type="email" id="email" name="email" required>

                <button type="submit">Reset Password</button>
            </form>

            <p class="login-link">Remember your password? <a href="login.php">Login</a></p>
        </div>
    </body>
    </html>
    <?php
}
?>
