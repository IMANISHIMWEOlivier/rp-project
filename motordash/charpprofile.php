<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ride_hailing";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details (assuming user ID 9 is hardcoded for now)
$sql = "SELECT * FROM users WHERE id = 9";  // Replace 9 with session user ID for dynamic content
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

$stmt->close();

// Save a new message (if POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];

    $sql = "INSERT INTO chat (sender_id, receiver_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message);
    if ($stmt->execute()) {
        echo "Message sent!";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorist Profile and Chat</title>
    <link rel="stylesheet" href="profilestyle.css">
    <link rel="stylesheet" href="chatstyle.css">
    <style>
        /* Add custom styles here */
        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            gap: 20px; /* Add some space between columns */
        }

        /* Profile Section */
        .profile {
            flex: 1;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-picture img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .profile-info p {
            font-size: 16px;
            margin: 5px 0;
        }

        .profile-info a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .profile-info a:hover {
            background-color: #0056b3;
        }

        /* Chat Section */
        .chat-container {
            flex: 1;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .chat-box {
            height: 400px;
            overflow-y: auto;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }

        .chat-box .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            background-color: #e6f7ff;
            font-size: 16px;
        }

        .chat-box .message.sender {
            background-color: #e0ffe0;
            text-align: right;
        }

        #chat-form {
            display: flex;
            gap: 10px;
        }

        #message {
            width: 80%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Profile Section -->
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

    <!-- Chat Section -->
    <div class="chat-container">
        <h1>Chat</h1>
        <div class="chat-box" id="chat-box">
            <!-- Messages will be loaded here -->
        </div>
        
        <form id="chat-form">
            <input type="hidden" id="sender_id" value="1"> <!-- Passenger or motorist's ID -->
            <input type="hidden" id="receiver_id" value="2"> <!-- Motorist or passenger's ID -->
            <textarea id="message" placeholder="Type your message..."></textarea>
            <button type="submit">Send</button>
        </form>
    </div>
</div>

<script src="chat.js"></script>

</body>
</html>
