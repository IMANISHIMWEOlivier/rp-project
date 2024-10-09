<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Simulate user login
    $_SESSION['user_id'] = uniqid();
    $_SESSION['user_type'] = rand(0, 1) ? 'motorcyclist' : 'client';
    $_SESSION['user_name'] = 'User ' . substr($_SESSION['user_id'], -4);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorcyclist Geolocation Service</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/htmx/1.9.10/htmx.min.js"></script>
</head>
<body>
    <h1>Motorcyclist Geolocation Service</h1>
    <div id="status">Status: Waiting for location update...</div>
    <div id="nearbyUsers" 
         hx-get="/project2/get_nearby_users.php" 
         hx-trigger="load, every 30s"
         hx-swap="innerHTML">
        Loading nearby users...
    </div>

    <script>
        function updateLocation(position) {
            const { latitude, longitude } = position.coords;
            fetch('/project2/update_location.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `latitude=${latitude}&longitude=${longitude}`
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('status').innerText = data;
            });
        }

        function errorHandler(err) {
            console.warn(`ERROR(${err.code}): ${err.message}`);
            document.getElementById('status').innerText = 'Error: ' + err.message;
        }

        if ("geolocation" in navigator) {
            navigator.geolocation.watchPosition(updateLocation, errorHandler, {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            });

            // Update location every 2 minutes
            setInterval(() => {
                navigator.geolocation.getCurrentPosition(updateLocation, errorHandler);
            }, 120000);
        } else {
            document.getElementById('status').innerText = "Geolocation is not supported by this browser.";
        }

        // Ping server every 30 seconds to keep session alive
        setInterval(() => {
            fetch('/project2/ping.php');
        }, 30000);

        // Handle page unload
        window.addEventListener('beforeunload', function() {
            navigator.sendBeacon('/project2/disconnect.php');
        });
    </script>
</body>
</html>