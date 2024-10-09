<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorcyclists</title>
    <style type="text/css">
        
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: auto;
    overflow: hidden;
}

h1 {
    text-align: center;
    margin: 20px 0;
    color: #333;
}

table {
    width: 100%;
    margin: 20px 0;
    border-collapse: collapse;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #f1f1f1;
}
/* CSS to style the link */
a {
    text-decoration: none; /* Removes the underline */
    color: #1E90FF; /* Dodger blue color */
    font-size: 16px; /* Adjust font size */
}

a:hover {
    color: #FF4500; /* Changes color to orange-red on hover */
    text-decoration: underline; /* Underline on hover */
}

a:active {
    color: #FF0000; /* Changes color to red when active */
}

    </style>

</head>
<body>
    <div class="container">
        <h1>Motorcyclists Information</h1>
        <table id="motorcyclistsTable">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Language</th>
                    <th>Contact</th>
                    <th>Motor Registration</th>
                    <th>Motor Type</th>
                    <th>Motor Color</th>
                    <th>Motor Model</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here from JavaScript -->
            </tbody>
        </table>
        
        <a href="#send.php" style="">send request</a>
    </div>




    <script src="fetch_motorists.js"></script>
</body>
</html>
