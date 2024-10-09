<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ride_hailing";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data and sanitize
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $age = $conn->real_escape_string($_POST['age']);
    $sex = $conn->real_escape_string($_POST['sex']);
    $user_type = $conn->real_escape_string($_POST['user_type']);
    $national_id = $conn->real_escape_string($_POST['national_id']);
    $address = $conn->real_escape_string($_POST['address']);
    $language = $conn->real_escape_string($_POST['language']);
    $emergency_contact = $conn->real_escape_string($_POST['emergency_contact']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $referral_code = !empty($_POST['referral_code']) ? $conn->real_escape_string($_POST['referral_code']) : null;
    $two_factor = isset($_POST['2fa']) ? 1 : 0;

    // Handle profile picture upload
    $profile_picture = $_FILES['profile_picture']['name'];
    $profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];

    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (!empty($profile_picture)) {
        if (!move_uploaded_file($profile_picture_tmp, $upload_dir . $profile_picture)) {
            $error = "Profile picture upload failed. Error: " . $_FILES['profile_picture']['error'];
        }
    } else {
        $error = "Profile picture was not uploaded.";
    }

    // Check if email is already registered
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Email is already registered.";
    } else {
        // Insert into users table
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, age, sex, user_type, national_id, address, language, emergency_contact, email, password, profile_picture, referral_code, two_factor)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssssi", $first_name, $last_name, $age, $sex, $user_type, $national_id, $address, $language, $emergency_contact, $email, $password, $profile_picture, $referral_code, $two_factor);

        if ($stmt->execute()) {
            // If motorcyclist, insert motor details
            if ($user_type === 'motorcyclist') {
                $motor_registration = $conn->real_escape_string($_POST['motor_registration']);
                $motor_type = $conn->real_escape_string($_POST['motor_type']);
                $motor_color = $conn->real_escape_string($_POST['motor_color']);
                $motor_model = $conn->real_escape_string($_POST['motor_model']);

                $stmt_motor = $conn->prepare("INSERT INTO motorcycles (user_id, motor_registration, motor_type, motor_color, motor_model) 
                                              VALUES (LAST_INSERT_ID(), ?, ?, ?, ?)");
                $stmt_motor->bind_param("ssss", $motor_registration, $motor_type, $motor_color, $motor_model);
                if (!$stmt_motor->execute()) {
                    $error = 'Error inserting motorcyclist details: ' . $stmt_motor->error;
                }
            }
            $success = 'Registration successful. You can now log in.';
        } else {
            $error = 'Error occurred during registration. ' . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration</title>
    <link rel="stylesheet" href="registerstyle.css"> 

<style>
    General Reset
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    display: flex;
    justify-content: center;
    align-items: center;
    /* height: 1000vh; */
    padding: 20px;
}

.registration-container {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    width: 100%;
}

h2 {
    margin-left: -250px;;
    color: #333;
    margin-bottom: 20px;
    padding: 40px;
    font-size: 24px;
    font-weight: bold;
    
}

label {
    display: block;
    text-align: left;
    margin-bottom: 5px;
    /* font-weight: bold; */
    color: #333;
}

select, button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 10px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}
input{
    width: 100%;
            height: 20%;
            border:none;
            border-radius: none; /* Square corners */
}

input[type="file"] {
    padding: 5px;
    border-radius: none;
}

button {
    background-color: #28a745;
    color: white;
    font-weight: bold;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #218838;
}

/* Styling for Error and Success Messages */
.error {
    text-align:center;
    background-color: cyan;
    color: red;
    padding: 15px;
    margin-bottom: 15px;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    font-size:20px;
}

.success {
    text-align:center;
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #c3e6cb;
    border-radius: 5px;
}

/* Motorcycle Details Section */
#motorcycle-details {
    background-color: #f9f9f9;
    padding: 20px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    margin-bottom: 15px;
}

#motorcycle-details label {
    margin-top: 10px;
}

/* Footer */
footer {
    text-align: center;
    margin-top: 20px;
}

footer a {
    color: #007bff;
    text-decoration: none;
}

footer a:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 600px) {
    .registration-container {
        padding: 20px;
    }

    input, select, button {
        font-size: 14px;
        padding: 8px;
    }
}

</style>
    
</head>
<body>

    <!-- Registration Form -->
    <div class="registration-container">
        <h2>Registration</h2>
        
        <!-- Display error or success messages -->
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form id="registrationForm" action="register.php" method="POST" enctype="multipart/form-data">
            
            <!-- First and Last Name -->
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" readonly>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" readonly>

            <!-- Age Range -->
            <label for="age">Age Range:</label>
            <select id="age" name="age">
                <option value="18-25">18-25</option>
                <option value="26-35">26-35</option>
                <option value="36-45">36-45</option>
                <option value="46+">46+</option>
            </select>

            <!-- Sex -->
            <label for="sex">Sex:</label>
            <select id="sex" name="sex">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <!-- User Type -->
            <label for="user_type">User Type:</label>
            <select id="user_type" name="user_type">
                <option value="passenger">Passenger</option>
                <option value="motorcyclist">Motorcyclist</option>
            </select>

            <!-- Profile Picture -->
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture" readonly>

            <!-- National ID / License Number -->
            <label for="national_id">National ID (Passenger) or License Number (Motorcyclist):</label>
            <input type="text" id="national_id" name="national_id" readonly>

            <!-- Address -->
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" readonly>

            <!-- Motorcycle Details (Only if user is motorcyclist) -->
            <div id="motorcycle-details" style="display: none;">
                <label for="motor_registration">Motor Registration Number:</label>
                <input type="text" id="motor_registration" name="motor_registration">

                <label for="motor_type">Motor Type:</label>
                <input type="text" id="motor_type" name="motor_type">

                <label for="motor_color">Motor Color:</label>
                <input type="text" id="motor_color" name="motor_color">

                <label for="motor_model">Motor Model/Make:</label>
                <input type="text" id="motor_model" name="motor_model">
            </div>

            <!-- Preferred Language -->
            <label for="language">Preferred Language:</label>
            <select id="language" name="language">
                <option value="en">English</option>
                <option value="fr">French</option>
                <option value="rw">Kinyarwanda</option>
            </select>

            <!-- Emergency Contact -->
            <label for="emergency_contact">Emergency Contact:</label>
            <input type="tel" id="emergency_contact" name="emergency_contact" readonly>

            <!-- Email and Password -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" readonly>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" readonly>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" readonly>

            <!-- Terms and Conditions -->
            <label>
                <input type="checkbox" name="terms" readonly> I agree to the <a href="terms.html">Terms and Conditions</a>
            </label>

            <!-- Referral Code -->
            <label for="referral_code">Referral Code (Optional):</label>
            <input type="text" id="referral_code" name="referral_code">

            <!-- 2-Factor Authentication -->
            <label for="2fa">Enable 2-Factor Authentication:</label>
            <input type="checkbox" id="2fa" name="2fa">

            <button type="submit">Register</button>
        </form>


        <footer>
            Already have an account? <a href="login.php">Log in here</a>.
        </footer>
    </div>

    <script src="registerscript.js"></script>
</body>
</html>
