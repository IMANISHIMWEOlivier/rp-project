<?php
// Assuming login is successful

// Database connection
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";      // Replace with your database password
$dbname = "ride_hailing"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming the user is logged in, we’ll retrieve the user ID from session (or you can pass it via GET parameter)
//session_start();
//$user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

// Fetch user details from the database
$sql = "SELECT * FROM users WHERE id = 9";
$stmt = $conn->prepare($sql);
//$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Fetch user details as an associative array
} else {
    echo "User not found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorist Profile</title>
    <link rel="stylesheet" href="profilestyle.css"> <!-- Include CSS for styling -->
</head>
<body>

<div class="profile">
    <h1>Motorist Profile</h1>

    <div class="profile-picture">
        <?php if (!empty($user['profile_picture'])): ?>
            <img src="uploads/<?php echo $user['profile_picture']; ?>" alt="Profile Picture">
        <?php else: ?>
            <img src="default-profile.png" alt="Default Profile Picture"> <!-- Default if no picture -->
        <?php endif; ?>
    </div>

    <div class="profile-info">
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
        <p><strong>Sex:</strong> <?php echo htmlspecialchars($user['sex']); ?></p>
        <p><strong>National ID:</strong> <?php echo htmlspecialchars($user['national_id']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
        <p><strong>Language:</strong> <?php echo htmlspecialchars($user['language']); ?></p>
        <p><strong>Emergency Contact:</strong> <?php echo htmlspecialchars($user['emergency_contact']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>User Type:</strong> <?php echo htmlspecialchars($user['user_type']); ?></p>
        <a href="dashmotor.php">Edit</a>
    </div>
</div>

</body>
</html>
