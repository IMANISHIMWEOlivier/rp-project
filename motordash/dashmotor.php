<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit your profile</title>
    <link rel="stylesheet" href="dashboardmotor.css">
</head>
<body>

<div class="dashboard">
    <h1>Edit Your Profile</h1>
    <form id="motoristForm" action="update_dash.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="userId" name="user_id" value="7"> <!-- Hidden field for user ID -->

        <div class="form-group">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="first_name" required>
        </div>

        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="last_name" required>
        </div>

        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
        </div>

        
            </select>
       

        <div class="form-group">
            <label for="userType">User Type:</label>
            <input type="text" id="userType" name="user_type" value="Motorist" readonly>
        </div>

       
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
        </div>

        <div class="form-group">
            <label for="language">Language:</label>
            <input type="text" id="language" name="language" required>
        </div>

        <div class="form-group">
            <label for="emergencyContact"> Contact:</label>
            <input type="text" id="emergencyContact" name="emergency_contact" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="profilePicture">Profile Picture:</label>
            <input type="file" id="profilePicture" name="profile_picture" accept="image/*">
        </div>

        <button type="submit">Update Profile</button>
    </form>
</div>

<script src="dashboard.js"></script>
</body>
</html>
