
<?php

require_once 'userdetails.php';
// Connect to the database

// if (!session_start()) {
//     session_start();
// }

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_userdetails = 'userdetailsdb';
$table_userdetails = 'userdetailstable';

$db_usersensidetails = 'usersensidetailsdb';
$table_usersensidetails = 'usersensidetailstable';

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_userdetails);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the currently logged-in user's username
// Below line is Working, Checked
$username = $_SESSION['username'];
// echo $username;

// Query to retrieve the user's profile information
$query = "SELECT * FROM userdetailstable WHERE username = '$username'";

// echo $query;

$result = mysqli_query($conn, $query);

// Check if the query was successful
if (mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
} else {
    echo "Error: Unable to retrieve profile information.";
    exit;
}

// echo $user_data;



// Output the data in JSON format
header('Content-Type: application/json');
echo json_encode($user_data);



// Close the database connection
mysqli_close($conn);

?>