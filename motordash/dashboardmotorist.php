<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorist Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .dashboard {
            background-color: #fff;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="dashboard">
    <h1>Motorist Dashboard</h1>
    <form id="motoristForm" action="update_motorist.php" method="POST" enctype="multipart/form-data">
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
            <input type="text" id="age" name="age" required>
        </div>

        <div class="form-group">
            <label for="sex">Sex:</label>
            <input type="text" id="sex" name="sex" required>
        </div>

        <div class="form-group">
            <label for="userType">User Type:</label>
            <input type="text" id="userType" name="user_type" required>
        </div>

        <div class="form-group">
            <label for="nationalId">National ID:</label>
            <input type="text" id="nationalId" name="national_id" required>
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
            <label for="emergencyContact">Emergency Contact:</label>
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

</body>
</html>
