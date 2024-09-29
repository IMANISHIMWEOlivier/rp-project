<?php
// Sample data (this could come from a database)
$motors = [
    ['motor_registration' => 'RWA123', 'motor_type' => 'Scooter', 'motor_color' => 'Red', 'motor_model' => 'Honda Activa', 'full_names' => 'John Doe', 'license' => 'A1'],
    ['motor_registration' => 'RWA456', 'motor_type' => 'Motorbike', 'motor_color' => 'Black', 'motor_model' => 'Yamaha R1', 'full_names' => 'Jane Smith', 'license' => 'A2']
];

// Sort motors by model in descending order
usort($motors, function($a, $b) {
    return strcmp($b['motor_model'], $a['motor_model']);
});

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Description</title>
    <link rel="stylesheet" href="motordescriptionstyle.css">
</head>
<body>
    <div class="container">
        <h1>Motor Description</h1>
        <table>
            <thead>
                <tr>
                    <th>Motor Registration</th>
                    <th>Motor Type</th>
                    <th>Motor Color</th>
                    <th>Motor Model</th>
                    <th>Full Names</th>
                    <th>License</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($motors as $motor): ?>
                <tr>
                    <td><?php echo $motor['motor_registration']; ?></td>
                    <td><?php echo $motor['motor_type']; ?></td>
                    <td><?php echo $motor['motor_color']; ?></td>
                    <td><?php echo $motor['motor_model']; ?></td>
                    <td><?php echo $motor['full_names']; ?></td>
                    <td><?php echo $motor['license']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="motordescriptionscript.js"></script>
</body>
</html>
