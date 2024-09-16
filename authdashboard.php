<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    // Redirect to login page if not logged in
    header('Location: loginAuth.html');
    exit();
}
$session_timeout = 120;

// Handle session timeout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $session_timeout) {
    session_unset();     
    session_destroy();   
    header("Location: http://localhost/busbuddy/loginAuth.html"); 
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); 

// Get the user name from the session
$admin = $_SESSION['admin'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="authdashboard.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons/css/boxicons.min.css">
</head>
<body>
    <div class="firstdiv">
        <img src="busbuddy.png" alt="BusBuddy Logo" height="150" width="150">
        <div class="user">
            <i class='bx bxs-user-circle'></i>
            <p>Hello <?php echo htmlspecialchars($admin); ?>!</p>
        </div>
        <header>
            <h1>BusBuddy Admin Panel</h1>
        </header>
    </div>
    
    <div class="dashboard">
        <a href="busdetails.html" class="content">
            <p>Bus List</p>
        </a>
        <a href="childDetails.html" class="content">
            <p>Child List</p>
        </a>
        <a href="driverdetails.html" class="content">
            <p>Driver List</p>
        </a>
        <a href="reportadmin.html" class="content">
            <p>Reports</p>
        </a>
        <a href="#" class="content">
            <p>History</p>
        </a>
    </div>
    
    <!-- Logout Button -->
    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
