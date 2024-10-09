<?php
session_start();
require_once 'user_management.php';

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id']: null;

if (!$userId) {
    echo 'Status: User not logged in';
    exit;
}

$latitude = isset($_POST['latitude']) ? $_POST['latitude']: null;
$longitude = isset($_POST['longitude']) ? $_POST['longitude']: null;

if ($latitude === null || $longitude === null) {
    echo 'Status: Invalid coordinates';
    exit;
}

updateUserLocation($userId, $latitude, $longitude);

echo 'Status: Location updated successfully';