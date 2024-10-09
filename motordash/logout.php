<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        .logout-btn {
            background-color: #f44336; /* Red */
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .logout-btn:hover {
            background-color: #d32f2f; /* Darker red */
        }
    </style>
    <script>
        // JavaScript to confirm logout action
        function confirmLogout(event) {
            event.preventDefault(); // Prevent form from submitting immediately
            let confirmAction = confirm("Are you sure you want to log out?");
            if (confirmAction) {
                document.getElementById("logout-form").submit(); // Submit the form if confirmed
            }
        }
    </script>
</head>
<body>
    <h2>Welcome, User!</h2>

    <!-- Logout form -->
    <form id="logout-form" action="logout.php" method="POST">
        <button type="submit" class="logout-btn" onclick="confirmLogout(event)">Logout</button>
    </form>
</body>
</html>
<?php
// logout.php
session_start(); // Start the session
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Redirect to the login page (or homepage)
header("Location: ../index.php");
exit();
?>
