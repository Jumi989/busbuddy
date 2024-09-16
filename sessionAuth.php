<?php
session_start();  

$servername = "localhost";  
$username = "root";         
$password = "";           
$dbname = "busbuddy";    

$session_timeout = 120;

// Handle session timeout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $session_timeout) {
    session_unset();     
    session_destroy();   
    header("Location: http://localhost/busbuddy/loginAuth.html"); 
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); 

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve POST data
$admin = isset($_POST['admin']) ? $_POST['admin'] : '';
$password_user = isset($_POST['password_user']) ? $_POST['password_user'] : '';

// Prepare and execute SQL statement
$stmt = $conn->prepare("SELECT * FROM admin_user WHERE admin = ? AND password_user = ?");
$stmt->bind_param("ss", $admin, $password_user);
$stmt->execute();
$result = $stmt->get_result();

// Check if login is successful
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    $_SESSION['admin'] = $row['admin'];
    $_SESSION['password_user'] = $row['password_user'];
    
    header("Location: http://localhost/busbuddy/authdashboard.php");
    exit();  
} else {
    echo "<script>alert('Invalid username or password.')</script>";
    echo "<script>location.href='http://localhost/busbuddy/loginAuth.html'</script>";
}

// Close statement and connection
$stmt->close();
$conn->close();   
