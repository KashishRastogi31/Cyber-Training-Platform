<?php
session_start();

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'usersensidetailsdb';
$table_name = 'usersensidetailstable';

$db_userdetails = 'userdetailsdb';
$table_userdetails = 'userdetailstable';


$conn = new mysqli($db_host, $db_username, $db_password);


if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $sql = "SHOW DATABASES LIKE '$db_name'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Rather than visiting new page aissa kuch kro ki waha hi error show ho jaay ki user doesn't exists
        header("Location: DoRegister.html");
    }



    $conn->select_db($db_name);

    // if (!$conn->select_db($db_name)) {
    //     die("Database Unable To Select. " . $conn->error);
    // }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT Password FROM $table_name WHERE $table_name.Username = '$username'";

    $result = $conn->query($query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['Password'];
        // $name = $row['Username'];

        if (password_verify($password, $hashed_password)) {
            // $_SESSION['username'] = $username;
            // $_SESSION['name'] = $name;
            // Fetch the user's name from the user details database
            $conn->select_db($db_userdetails);
            $query = "SELECT Name FROM $table_userdetails WHERE Username = '$username'";
            $result = $conn->query($query);

            if ($result->num_rows !== 0) {
                $row = $result->fetch_assoc();
                $name = $row['Name'];

                // Set session variable
                $_SESSION['name'] = $name;
                header("Location: front_page.html");
                exit();
            } else {
                echo "User details not found.";
            }
        } else {
            die("Wrong Password Entered.");
        }
    } else {
        header("Location: DoRegister.html");

    }

    $conn->close();
}
?>