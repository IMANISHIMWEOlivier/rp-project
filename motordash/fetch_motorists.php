<?php
include 'db_connect.php';

$sql = "SELECT users.first_name, users.last_name, users.age, users.language, users.emergency_contact, motorcycles.motor_registration, motorcycles.motor_type, motorcycles.motor_color, motorcycles.motor_model
        FROM users
        JOIN motorcycles ON users.id = motorcycles.user_id
        WHERE users.user_type = 'motorcyclist'";

$result = $conn->query($sql);

$motorcyclists = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $motorcyclists[] = $row;
    }
}

$conn->close();
echo json_encode($motorcyclists);
?>
