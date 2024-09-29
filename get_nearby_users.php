<?php
session_start();
require_once 'user_management.php';

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    echo 'User not logged in';
    exit;
}

$nearbyUsers = getNearbyUsers($userId);

if (empty($nearbyUsers)) {
    echo '<h2>Nearby Users</h2>';
    echo '<p>No users found within 2km.</p>';
} else {
    echo '<h2>Nearby Users (within 2km)</h2>';
    echo '<ul>';
    foreach ($nearbyUsers as $user) {
        echo "<li>{$user['name']} ({$user['type']}) - {$user['distance']} km</li>";
    }
    echo '</ul>';
}
