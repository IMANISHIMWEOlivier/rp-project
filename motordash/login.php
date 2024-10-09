<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form id="loginForm" action="login.php" method="POST" onsubmit="return validateForm()">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>

            <p class="forgot-password">
                <a href="forgot-password.html">Forgot your password?</a>
            </p>

            <p class="register-link">
                Don't have an account? <a href="register.php">Register here</a>
            </p>
        </form>
    </div>

    <script src="loginscript.js"></script>
</body>
</html>
<?php
session_start();

// Replace with your database connection details
$host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "ride_hailing";

// Create connection
$conn = new mysqli($host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Assuming passwords are stored hashed
        if (password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('No user found with that email.');</script>";
    }
    $stmt->close();
}

$conn->close();
?>
