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
        <h2>Registration</h2>
         


        <form id="registrationForm" action="registerprocess.php" method="POST" enctype="multipart/form-data">
            
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
            </label><br><br><br>

            <!-- Referral Code -->
            <label for="referral_code">Referral Code (Optional):</label>
            <input type="text" id="referral_code" name="referral_code">

            <!-- 2-Factor Authentication -->
            <label for="2fa"> <input type="checkbox" id="2fa" name="2fa"> Enable 2-Factor Authentication:</label><br>
           

            <button type="submit">Register</button>
        </form>
    </div>

    <script src="registerscript.js"></script>
</body>
</html>

