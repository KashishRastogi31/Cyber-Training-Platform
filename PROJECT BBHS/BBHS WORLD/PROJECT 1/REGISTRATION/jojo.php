<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['usname'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

// Database connection parameters
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_userdetails = 'userdetailsdb';

// Create a connection to the database
$conn = new mysqli($db_host, $db_username, $db_password, $db_userdetails);

// Check the connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

// Fetch the username from the session
$username = $_SESSION['usname'];

// Prepare and execute the query
$sql = "SELECT * FROM userdetailstable WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user data is found
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    $user_data = [
        'Name' => 'N/A',
        'Email' => 'N/A',
        'Gender' => 'N/A',
        'DOB' => 'N/A',
        'State' => 'N/A',
        'Profession' => 'N/A',
        'Username' => 'N/A'
    ];
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Set the Content-Type header to application/json
header('Content-Type: application/json');

// Output JSON
echo json_encode($user_data);
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Profile</title>
</head>

<body>
    <h1>My Profile</h1>
    <p><strong>Name:</strong> <span id="name"></span></p>
    <p><strong>Email:</strong> <span id="email"></span></p>
    <p><strong>Gender:</strong> <span id="gender"></span></p>
    <p><strong>Date of Birth:</strong> <span id="dob"></span></p>
    <p><strong>State:</strong> <span id="state"></span></p>
    <p><strong>Profession:</strong> <span id="profession"></span></p>
    <p><strong>Username:</strong> <span id="username"></span></p>

    <script>
        // Fetch data from the same file (index.php) and update the profile
        fetch("<?php echo $_SERVER['PHP_SELF']; ?>")
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    // Update the HTML elements with the user data
                    document.getElementById("name").innerText = data.Name || "N/A";
                    document.getElementById("email").innerText = data.Email || "N/A";
                    document.getElementById("gender").innerText = data.Gender || "N/A";
                    document.getElementById("dob").innerText = data.DOB || "N/A";
                    document.getElementById("state").innerText = data.State || "N/A";
                    document.getElementById("profession").innerText = data.Profession || "N/A";
                    document.getElementById("username").innerText = data.Username || "N/A";
                }
            })
            .catch(error => {
                console.error('Error fetching user details:', error);
            });
    </script>
</body>

</html>