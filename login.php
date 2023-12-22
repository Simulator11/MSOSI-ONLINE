<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #f4f4f4;
}

.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    width: 400px;
}

form {
    display: flex;
    flex-direction: column;
}

h2 {
    text-align: center;
    color: #333;
}

label {
    margin-top: 15px;
    color: #555;
}

input {
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.password-container {
    position: relative;
    display: flex;
    flex-direction: column;
}

#password, #confirmPassword {
    width: calc(100% - 22px);
}

#showPassword, #showConfirmPassword {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #3498db;
}
button {
    background-color: #4caf50;
    color: white;
    padding: 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.login-link {
    text-align: center;
    margin-top: 20px;
}

.login-link a {
    color: #007bff;
    text-decoration: none;
}

.login-link a:hover {
    text-decoration: underline;
}

    </style>
    <title>Msosi Online - Login</title>
</head>
<body>
    <div class="container">
        <form id="loginForm" action="loginconnect.php" method="POST">
            <h2>Login</h2>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <div class="password-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <span id="showPassword" onclick="togglePassword('password')">Show</span>
            </div>

            <button type="submit">Login</button>
        </form>

        <p class="signup-link">Don't have an account? <a href="signup.php">Signup</a></p>
        <p class="forgot-password-link"><a href="forgot password.php">Forgot Password?</a></p>
    </div>
    <script>
        function togglePassword(inputId) {
            var passwordInput = document.getElementById(inputId);
            var showPasswordSpan = document.getElementById('show' + inputId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showPasswordSpan.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                showPasswordSpan.textContent = 'Show';
            }
        }
    </script>
</body>
</html>
