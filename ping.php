<?php
session_start();
require_once 'user_management.php';

if (isset($_SESSION['user_id'])) {
    $users = getAllUsers();
    if (isset($users[$_SESSION['user_id']])) {
        $users[$_SESSION['user_id']]['last_update'] = time();
        saveAllUsers($users);
    }
}
