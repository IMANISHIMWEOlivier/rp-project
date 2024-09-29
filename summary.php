<?php
// Database connection (PHP & PDO)
$dsn = 'mysql:host=localhost;dbname=ride_hailing';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);

        if ($stmt->rowCount() > 0) {
            $emailError = "Email is already registered!";
        } else {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $user_type = $_POST['user_type'];
            $national_id = $_POST['national_id'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            // Insert user data into the 'users' table
            $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, user_type, national_id, password) 
                                   VALUES (:first_name, :last_name, :email, :user_type, :national_id, :password)");
            $stmt->execute([
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':email' => $email,
                ':user_type' => $user_type,
                ':national_id' => $national_id,
                ':password' => $password
            ]);

            $user_id = $pdo->lastInsertId();

            // Insert motorcyclist details if the user type is 'motorcyclist'
            if ($user_type === 'motorcyclist') {
                $motor_registration = $_POST['motor_registration'];
                $motor_type = $_POST['motor_type'];
                $motor_color = $_POST['motor_color'];
                $motor_model = $_POST['motor_model'];

                $stmt = $pdo->prepare("INSERT INTO motorcycles (user_id, motor_registration, motor_type, motor_color, motor_model)
                                       VALUES (:user_id, :motor_registration, :motor_type, :motor_color, :motor_model)");
                $stmt->execute([
                    ':user_id' => $user_id,
                    ':motor_registration' => $motor_registration,
                    ':motor_type' => $motor_type,
                    ':motor_color' => $motor_color,
                    ':motor_model' => $motor_model
                ]);
            }

            $successMessage = "Registration successful!";
        }
    }
} catch (PDOException $e) {
    $errorMessage = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .registration-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        label, input, select {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input, select {
            padding: 8px;
        }
        #motorcycle-details {
            display: none;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>

<div class="registration-container">
    <h2>Register Here</h2>

    <!-- Show messages -->
    <?php if (!empty($emailError)): ?>
        <p class="error"><?php echo $emailError; ?></p>
    <?php elseif (!empty($successMessage)): ?>
        <p class="success"><?php echo $successMessage; ?></p>
    <?php elseif (!empty($errorMessage)): ?>
        <p class="error"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <!-- Registration Form -->
    <form id="registrationForm" method="POST">
        <!-- First and Last Name -->
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required onblur="checkEmail()">
        <small id="emailFeedback" class="error"></small>

        <!-- User Type -->
        <label for="user_type">User Type:</label>
        <select id="user_type" name="user_type" onchange="toggleMotorcyclistFields()" required>
            <option value="passenger">Passenger</option>
            <option value="motorcyclist">Motorcyclist</option>
        </select>

        <!-- National ID / License Number -->
        <label for="national_id">National ID (Passenger) or License Number (Motorcyclist):</label>
        <input type="text" id="national_id" name="national_id" required>

        <!-- Motorcycle Details (for motorcyclists) -->
        <div id="motorcycle-details">
            <label for="motor_registration">Motor Registration Number:</label>
            <input type="text" id="motor_registration" name="motor_registration">

            <label for="motor_type">Motor Type:</label>
            <input type="text" id="motor_type" name="motor_type">

            <label for="motor_color">Motor Color:</label>
            <input type="text" id="motor_color" name="motor_color">

            <label for="motor_model">Motor Model/Make:</label>
            <input type="text" id="motor_model" name="motor_model">
        </div>

        <!-- Password -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register</button>
    </form>
</div>

<script>
    function toggleMotorcyclistFields() {
        const userType = document.getElementById("user_type").value;
        const motorDetails = document.getElementById("motorcycle-details");
        motorDetails.style.display = (userType === "motorcyclist") ? "block" : "none";
    }

    function checkEmail() {
        const email = document.getElementById("email").value;
        const emailFeedback = document.getElementById("emailFeedback");

        if (email !== "") {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (this.status === 200) {
                    emailFeedback.textContent = this.responseText;
                }
            };
            xhr.send("email=" + encodeURIComponent(email));
        }
    }
</script>

</body>
</html>
-----------------------------------------------$_COOKIE
<?php
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

    // Get form data
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
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $referral_code = $_POST['referral_code'] ?? null;
    $two_factor = isset($_POST['2fa']) ? 1 : 0;
    
    // Handle profile picture upload
    $profile_picture = $_FILES['profile_picture']['name'];
    $profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];
    move_uploaded_file($profile_picture_tmp, "uploads/$profile_picture");

    // Insert into users table
    $sql = "INSERT INTO users (first_name, last_name, age, sex, user_type, national_id, address, language, emergency_contact, email, password, profile_picture, referral_code, two_factor)
            VALUES ('$first_name', '$last_name', '$age', '$sex', '$user_type', '$national_id', '$address', '$language', '$emergency_contact', '$email', '$password', '$profile_picture', '$referral_code', '$two_factor')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // If user is a motorcyclist, insert motor details
    if ($user_type === 'motorcyclist') {
        $motor_registration = $_POST['motor_registration'];
        $motor_type = $_POST['motor_type'];
        $motor_color = $_POST['motor_color'];
        $motor_model = $_POST['motor_model'];

        $sql_motor = "INSERT INTO motorcycles (user_id, motor_registration, motor_type, motor_color, motor_model)
                      VALUES (LAST_INSERT_ID(), '$motor_registration', '$motor_type', '$motor_color', '$motor_model')";

        $conn->query($sql_motor);
    }

    $conn->close();
}
?>
-============================
//register processs
<?php
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

    // Get form data
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
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $referral_code = $_POST['referral_code'] ?? null;
    $two_factor = isset($_POST['2fa']) ? 1 : 0;

    // Handle profile picture upload
    $profile_picture = $_FILES['profile_picture']['name'];
    $profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];
    move_uploaded_file($profile_picture_tmp, "uploads/$profile_picture");

    // Check if email is already registered
    $email_check_sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($email_check_sql);

    if ($result->num_rows > 0) {
        // If email already exists
        $error = "Email is already registered .<a href='login.html'>login here</a>";
        //echo "This email is already registered. Please <a href='login.html'>login here</a>.";
    } else {
        // Insert into users table
        $sql = "INSERT INTO users (first_name, last_name, age, sex, user_type, national_id, address, language, emergency_contact, email, password, profile_picture, referral_code, two_factor)
                VALUES ('$first_name', '$last_name', '$age', '$sex', '$user_type', '$national_id', '$address', '$language', '$emergency_contact', '$email', '$password', '$profile_picture', '$referral_code', '$two_factor')";
                  

        if ($conn->query($sql) === TRUE) {
            // If the user is a motorcyclist, insert motor details
            if ($user_type === 'motorcyclist') {
                $motor_registration = $_POST['motor_registration'];
                $motor_type = $_POST['motor_type'];
                $motor_color = $_POST['motor_color'];
                $motor_model = $_POST['motor_model'];

                $sql_motor = "INSERT INTO motorcycles (user_id, motor_registration, motor_type, motor_color, motor_model)
                              VALUES (LAST_INSERT_ID(), '$motor_registration', '$motor_type', '$motor_color', '$motor_model')";

                $conn->query($sql_motor);
            }
            $success = 'Registration successful. You can now log in.';
            //echo "Registration successful!";
        } else {
            $error = 'Error occurred during registration.';
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration</title>
    <link rel="stylesheet" href="registerstyle.css"> 
    <!-- Link to your CSS file -->
</head>
<body>

    <!-- Registration Form -->
    <div class="registration-container">
        <h2>Registration Here!!!</h2>
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
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

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
            <input type="file" id="profile_picture" name="profile_picture" required>

            <!-- National ID / License Number -->
            <label for="national_id">National ID (Passenger) or License Number (Motorcyclist):</label>
            <input type="text" id="national_id" name="national_id" required>

            <!-- Address -->
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <!-- Motorcycle Details (Shown only if user is a motorcyclist) -->
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
            <input type="tel" id="emergency_contact" name="emergency_contact" required>

            <!-- Email and Password -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <!-- Terms and Conditions -->
            <label>
                <input type="checkbox" name="terms" required> I agree to the <a href="terms.html">Terms and Conditions</a>
            </label>

            <!-- Referral Code -->
            <label for="referral_code">Referral Code (Optional):</label>
            <input type="text" id="referral_code" name="referral_code">

            <!-- 2-Factor Authentication -->
            <label for="2fa">Enable 2-Factor Authentication:</label>
            <input type="checkbox" id="2fa" name="2fa">

            <button type="submit">Register</button>
        </form>
    </div>

    <script src="registerscript.js"></script>
</body>
</html>

<link rel="stylesheet" href="motorcycliststyle.css">


---------------$_COOKIE

body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    padding: 20px;
    margin: 0;
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Grid Layout */
.grid-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 columns */
    gap: 20px;
    justify-items: center;
    max-width: 1200px;
    margin: 0 auto; /* Center the grid */
}

/* Motorist Card */
.motorist-card {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    width: 250px;
    text-align: center;
    transition: transform 0.3s ease; /* Smooth hover effect */
}

.motorist-card:hover {
    transform: translateY(-5px); /* Slight lift effect on hover */
}

/* Motorist Image */
.motorist-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover; /* Ensure images fit within the circular frame */
    margin-bottom: 15px;
}

/* Motorist Details */
.details {
    margin-top: 10px;
}

.status {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 14px;
}

.status.available {
    color: green;
}

.status.busy {
    color: red;
}

.distance, .time {
    display: block;
    font-size: 14px;
    margin-top: 5px;
}

/* Request Ride Button */
.request-ride-btn {
    margin-top: 15px;
    background-color: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    width: 100%;
}

.request-ride-btn:hover {
    background-color: #0056b3;
}

.request-ride-btn:disabled {
    background-color: grey;
    cursor: not-allowed;
}
