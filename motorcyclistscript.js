// document.getElementById("request-ride-btn").addEventListener("click", function() {
//     alert("Ride request sent to the motorist!");
// });
// Add event listeners for all the "Request Ride" buttons
const rideButtons = document.querySelectorAll('.request-ride-btn:not([disabled])');

rideButtons.forEach(button => {
    button.addEventListener('click', () => {
        alert('Ride request sent to the motorist!');
    });
});
