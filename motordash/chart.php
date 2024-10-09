<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Page</title>
    <link rel="stylesheet" href="chatstyle.css">
</head>
<body>

<div class="chat-container">
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

<script src="chat.js"></script>

</body>
</html>
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

// Save a new message
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

// Load chat messages
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sender_id = $_GET['sender_id'];
    $receiver_id = $_GET['receiver_id'];

    $sql = "SELECT * FROM chat WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $chats = [];
    while ($row = $result->fetch_assoc()) {
        $chats[] = $row;
    }

    echo json_encode($chats);
    $stmt->close();
}

$conn->close();
?>
