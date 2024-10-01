<?php
session_start();

if (!isset($_SESSION['usname'])) {
    header("Location: login_form.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_userdetails = 'userdetailsdb';
    $table_userdetails = 'userdetailstable';

    $conn = new mysqli($db_host, $db_username, $db_password, $db_userdetails);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_SESSION['usname'];
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $state = $conn->real_escape_string($_POST['state']);
    $profession = $conn->real_escape_string($_POST['profession']);

    $sql = "UPDATE $table_userdetails SET Name='$name', Email='$email', Gender='$gender', DOB='$dob', State='$state', Profession='$profession' WHERE Username='$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully.";
        header("Location: myprofile.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    $conn->close();
}
?>