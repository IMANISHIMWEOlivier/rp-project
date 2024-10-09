<?php
function getAllUsers() {
    if (!file_exists('users.json')) {
        return [];
    }
    $json = file_get_contents('users.json');
    return json_decode($json, true) ?: [];
}

function saveAllUsers($users) {
    file_put_contents('users.json', json_encode($users));
}

function updateUserLocation($userId, $latitude, $longitude) {
    $users = getAllUsers();
    if (!isset($users[$userId])) {
        $users[$userId] = [
            'id' => $userId,
            'name' => $_SESSION['user_name'],
            'type' => $_SESSION['user_type'],
        ];
    }
    $users[$userId]['lat'] = $latitude;
    $users[$userId]['lon'] = $longitude;
    $users[$userId]['last_update'] = time();
    saveAllUsers($users);
}

function removeInactiveUsers() {
    $users = getAllUsers();
    $currentTime = time();
    foreach ($users as $userId => $user) {
        if ($currentTime - $user['last_update'] > 300) { // 5 minutes inactivity
            unset($users[$userId]);
        }
    }
    saveAllUsers($users);
}

function getNearbyUsers($userId) {
    removeInactiveUsers();
    $users = getAllUsers();
    $currentUser = isset($users[$userId]) ?  $users[$userId]: null;
    if (!$currentUser) {
        return [];
    }

    $nearbyUsers = [];
    foreach ($users as $user) {
        if ($user['id'] != $userId) {
            $distance = calculateDistance(
                $currentUser['lat'], 
                $currentUser['lon'],
                $user['lat'],
                $user['lon']
            );
            if ($distance < 2) {
                $user['distance'] = round($distance, 2);
                $nearbyUsers[] = $user;
            }
        }
    }
    return $nearbyUsers;
}

function calculateDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371; // in kilometers
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $distance = $earthRadius * $c;
    return $distance;
}
