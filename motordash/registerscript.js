document.getElementById('user_type').addEventListener('change', function() {
    var motorcycleDetails = document.getElementById('motorcycle-details');
    if (this.value === 'motorcyclist') {
        motorcycleDetails.style.display = 'block';
    } else {
        motorcycleDetails.style.display = 'none';
    }
});

// Simple password match validation
document.getElementById('registrationForm').addEventListener('submit', function(e) {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm_password').value;

    if (password !== confirmPassword) {
        e.preventDefault();
        alert("Passwords do not match!");
    }
});