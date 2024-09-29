<?php
session_start();
require_once 'user_management.php';

if (isset($_SESSION['user_id'])) {
    $users = getAllUsers();
    unset($users[$_SESSION['user_id']]);
    saveAllUsers($users);
    session_destroy();
}