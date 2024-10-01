<?php
session_start();

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_userdetails = 'userdetailsdb';
$table_userdetails = 'userdetailstable';

$db_usersensidetails = 'usersensidetailsdb';
$table_usersensidetails = 'usersensidetailstable';

$conn = new mysqli($db_host, $db_username, $db_password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Sensitive Details
  $sql = "CREATE DATABASE IF NOT EXISTS $db_usersensidetails";
  $conn->query($sql);

  $conn->select_db($db_usersensidetails);

  $sql = "CREATE TABLE IF NOT EXISTS $table_usersensidetails( Username VARCHAR(255) NOT NULL UNIQUE, Password VARCHAR(255) NOT NULL)";
  $conn->query($sql);

  $username = $_POST['username'];
  $password = $_POST['password'];
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO $table_usersensidetails(Username, Password) VALUES ('$username', '$hashed_password')";
  $conn->query($sql);


  // Non-Sensitive Details
  $sql = "CREATE DATABASE IF NOT EXISTS $db_userdetails";
  $conn->query($sql);

  $conn->select_db($db_userdetails);

  $sql = "CREATE TABLE IF NOT EXISTS $table_userdetails(Name VARCHAR(25) NOT NULL, Email VARCHAR(45) NOT NULL , Gender VARCHAR(10) NOT NULL, DOB DATE NOT NULL, State VARCHAR(20) NOT NULL, Profession VARCHAR(20) NOT NULL, Username VARCHAR(50) NOT NULL)";
  $conn->query($sql);

  $name = $_POST['name'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];
  $state = $_POST['state'];
  $profession = $_POST['profession'];

  $sql = "INSERT INTO $table_userdetails(Name, Email, Gender, DOB, State, Profession, Username) VALUES ('$name', '$email', '$gender', '$dob', '$state', '$profession', '$username')";
  $conn->query($sql);


  $result = $conn->query($sql);

  if (!$result) {
    die("Unable To Register: " . $conn->error);
  } 
  else {
    $_SESSION['username'] = $username;
    header("Location: login_form.html");
    exit();
  }
  // $conn->close();

}
?>