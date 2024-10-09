<?php
$servername = "localhost"; // Your database server (could be '127.0.0.1' or other)
$username = "root"; // Your database username
$password = ""; // Your database password (if any)
$dbname = "ride_hailing"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
