<?php
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $user_type = $_POST['user_type'];
    $national_id = $_POST['national_id'];
    $address = $_POST['address'];
    $language = $_POST['language'];
    $emergency_contact = $_POST['emergency_contact'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check for file upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $file_name = $_FILES['profile_picture']['name'];
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $target_directory = "uploads/";
        $target_file = $target_directory . basename($file_name);

        if (move_uploaded_file($file_tmp, $target_file)) {
            $sql = "UPDATE users SET first_name = ?, last_name = ?, age = ?, sex = ?, national_id = ?, address = ?, language = ?, emergency_contact = ?, email = ?, password = ?, profile_picture = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssissssssssi", $first_name, $last_name, $age, $sex, $national_id, $address, $language, $emergency_contact, $email, $password, $file_name, $user_id);
        } else {
            echo "Error uploading profile picture.";
            exit();
        }
    } else {
        $sql = "UPDATE users SET first_name = ?, last_name = ?, age = ?, sex = ?, national_id = ?, address = ?, language = ?, emergency_contact = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisssssssi", $first_name, $last_name, $age, $sex, $national_id, $address, $language, $emergency_contact, $email, $password, $user_id);
    }

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
