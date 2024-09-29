<?php
// Database configuration
$host = 'localhost';      // Replace with your database host (e.g., localhost)
$dbname = 'ride_hailing';  // Replace with your database name
$username = 'root';        // Replace with your database username
$password = '';            // Replace with your database password

try {
    // Create a PDO instance (connect to the database)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optional: Set default fetch mode to fetch associative arrays
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Connection successful message (you can remove this in production)
    // echo "Connected to the database successfully!";
} catch (PDOException $e) {
    // If there is an error in the connection, display an error message
    die("Connection failed: " . $e->getMessage());
}
?>
