document.addEventListener('DOMContentLoaded', () => {
    // Example motor data (replace with dynamic data)
    const motors = [
        {
            motor_registration: 'RWA123',
            motor_type: 'Scooter',
            motor_color: 'Red',
            motor_model: 'Honda Activa',
            full_names: 'John Doe',
            license: 'A1'
        },
        {
            motor_registration: 'RWA456',
            motor_type: 'Motorbike',
            motor_color: 'Black',
            motor_model: 'Yamaha R1',
            full_names: 'Jane Smith',
            license: 'A2'
        }
    ];

    const tbody = document.getElementById('motor_details');

    // Sort motors by model in descending order
    motors.sort((a, b) => b.motor_model.localeCompare(a.motor_model));

    // Populate table rows dynamically
    motors.forEach(motor => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${motor.motor_registration}</td>
            <td>${motor.motor_type}</td>
            <td>${motor.motor_color}</td>
            <td>${motor.motor_model}</td>
            <td>${motor.full_names}</td>
            <td>${motor.license}</td>
        `;
        tbody.appendChild(row);
    });
});




