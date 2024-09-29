<?php
session_start();
require_once 'user_management.php';

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    echo 'Status: User not logged in';
    exit;
}

$latitude = $_POST['latitude'] ?? null;
$longitude = $_POST['longitude'] ?? null;

if ($latitude === null || $longitude === null) {
    echo 'Status: Invalid coordinates';
    exit;
}

updateUserLocation($userId, $latitude, $longitude);

echo 'Status: Location updated successfully';