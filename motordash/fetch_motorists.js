document.addEventListener("DOMContentLoaded", function() {
    fetch("fetch_motorists.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then(data => {
            console.log(data);  // Check if data is being fetched correctly
            let tableBody = document.querySelector("#motorcyclistsTable tbody");
            tableBody.innerHTML = ""; // Clear any existing rows

            if (data.length === 0) {
                console.log("No data available");
            }

            data.forEach(motorcyclist => {
                let row = document.createElement("tr");

                row.innerHTML = `
                    <td>${motorcyclist.first_name}</td>
                    <td>${motorcyclist.last_name}</td>
                    <td>${motorcyclist.age}</td>
                    <td>${motorcyclist.language}</td>
                    <td>${motorcyclist.emergency_contact}</td>
                    <td>${motorcyclist.motor_registration}</td>
                    <td>${motorcyclist.motor_type}</td>
                    <td>${motorcyclist.motor_color}</td>
                    <td>${motorcyclist.motor_model}</td>
                `;

                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error("Error fetching data:", error);
            alert("Failed to fetch motorcyclists' data. Check the console for more details.");
        });
});
