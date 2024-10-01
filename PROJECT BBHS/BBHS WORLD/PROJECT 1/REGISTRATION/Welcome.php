<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="Welcome.css">
</head>

<body>
    <div class="welcome-container">

        <h1>Name: 
            <?php echo $_SESSION['name']; ?>
        </h1>
        <br><hr><br>
        <h1>Username: 
            <?php echo $_SESSION['username']; ?>
        </h1>



        <a href="myprofile.html">Yaha Se</a>
    </div>
</body>

</html>