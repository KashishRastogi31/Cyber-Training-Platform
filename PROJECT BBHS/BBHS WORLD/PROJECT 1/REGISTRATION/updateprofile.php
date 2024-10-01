<?php
session_start();

if (!isset($_SESSION['usname'])) {
    header("Location: login_form.html");
    exit();
}

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

$sql = "SELECT * FROM $table_userdetails WHERE Username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['Name'];
    $email = $row['Email'];
    $gender = $row['Gender'];
    $dob = $row['DOB'];
    $state = $row['State'];
    $profession = $row['Profession'];
} else {
    echo "No user found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    <h2>Update Profile</h2>
    <form action="updateprofile.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        <br>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="male" <?php if ($gender == 'male')
                echo 'selected'; ?>>Male</option>
            <option value="female" <?php if ($gender == 'female')
                echo 'selected'; ?>>Female</option>
            <option value="other" <?php if ($gender == 'other')
                echo 'selected'; ?>>Other</option>
            <option value="prefer-not-to-say" <?php if ($gender == 'prefer-not-to-say')
                echo 'selected'; ?>>Prefer not to
                disclose</option>
        </select>
        <br>
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
        <br>
        <label for="state">State:</label>
        <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($state); ?>" required>
        <br>
        <label for="profession">Profession:</label>
        <select id="profession" name="profession">
            <option value="penetration-tester" <?php if ($profession == 'penetration-tester')
                echo 'selected'; ?>>
                Penetration Tester</option>
            <option value="soc-analyst" <?php if ($profession == 'soc-analyst')
                echo 'selected'; ?>>SOC Analyst</option>
            <option value="linux-administrator" <?php if ($profession == 'linux-administrator')
                echo 'selected'; ?>>Linux
                Administrator</option>
            <option value="security-engineer" <?php if ($profession == 'security-engineer')
                echo 'selected'; ?>>Security
                Engineer</option>
        </select>
        <br>
        <button type="submit">Update</button>
    </form>
</body>

</html>