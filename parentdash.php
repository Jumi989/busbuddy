<?php
session_start();  // Start the session

// Set session timeout (in seconds)
$session_timeout = 120; // Example: 20 minutes

// Check if the session has expired
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $session_timeout) {
    // Session has expired
    session_unset();     // Unset session variables
    session_destroy();   // Destroy the session
    header("Location: http://localhost/busbuddy/Login2.html"); // Redirect to login page
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    // Redirect to login if not logged in
    header("Location: http://localhost/busbuddy/Login2.html");
    exit();
}

// Retrieve the username from the session
$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard</title>
    <link rel="stylesheet" href="styleparentdash.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons/css/boxicons.min.css">
</head>
<body>
    <div class="firstdiv">
        <img src="busbuddy.png" height="150" width="150">
        <div class="user">
            <i class='bx bxs-user-circle'></i>
            <p>Hello <?php echo  htmlspecialchars($user_name); ?>!</p> <!-- Display the username -->
        </div>
        <!-- Logout button in parent dashboard (parentdash.html) -->
<form action=" http://localhost/busbuddy/logout.php" method="POST">
    <button type="submit">Logout</button>
</form>

    </div>
    
    <div class="child">
        <div class="child0">
            <img src="pic6.png">
        </div>
        <p>Add Child</p>
    </div>

    <div class="dashboard">
        <div class="content">
            <p>Driver Information</p>
        </div>
        <div class="content">
            <p>Pay-Online</p>
        </div>
        <div class="content">
            <p><a href="http://localhost/busbuddy/logdata.php">Child Information</a></p>
        </div>
        <div class="content">
            <p><a href="gotoservice.html">Avail Our GoTo Service</a></p>
        </div>
        <div class="content">
            <p><a href="reportanissue.html">Report an Issue</a></p>
        </div>
    </div>

    <!-- Logout Button -->
    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
