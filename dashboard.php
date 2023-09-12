<?php
session_start();

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['userUid'])) {
    header("Location: index.php");
    exit();
}
// Check if the user clicked the "Logout" button
if (isset($_POST['logout-submit'])) {
    // Perform logout actions (destroy session, etc.)
    session_destroy();

    // Delete the user cookie (set it to expire in the past)
    setcookie('userUid', '', time() - 3600, '/');

    header("Location: index.php");
    exit();
}

// Set a user cookie with the user's UID
if (!isset($_COOKIE['userUid'])) {
    setcookie('userUid', $_SESSION['userUid'], time() + 3600, '/');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Basic CSS styling for the dashboard */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
        background-color: #333;
        overflow: hidden;
        display: flex; /* Use flexbox to align items horizontally */
        align-items: center; /* Vertically center items in the navbar */
    }

    .navbar a {
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }

    /* Style for the logout button */
    .logout-btn {
        background-color: #ff6347; /* Red color */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        margin-left: auto; /* Push the logout button to the right */
    }

    .logout-btn:hover {
        background-color: #ff4737; /* Darker red color on hover */
    }
     .welcome {
            text-align: center;
            margin-top: 20px;
        }
      </style>
</head>
<body>
<div class="navbar">
    <a href="#"><img src="img/img1.png" alt="Pluralsight Logo" height="30"></a>
    <a href="dashboard.php">Home</a>
    <?php
    // Check if the user is logged in and adjust the navbar links accordingly
    if (isset($_SESSION['userUid'])) {
        echo '<form action="" method="post">
                <button type="submit" name="logout-submit" class="logout-btn">Logout</button>
            </form>';
    }
    ?>
</div>





    <div class="welcome">
        <h1>Welcome, <?php echo $_SESSION['userUid']; ?>!</h1>
        <!-- Other dashboard content here -->
    </div>
</body>
</html>
