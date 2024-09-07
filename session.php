<?php
session_start();  // Start the session

$servername = "localhost";  
$username = "root";         
$password = "";           
$dbname = "busbuddy";    

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input
$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$password_user = isset($_POST['password_user']) ? $_POST['password_user'] : '';

// Prepare and execute the query
$stmt = $conn->prepare("SELECT * FROM guardians WHERE user_name = ? AND password_user = ?");
$stmt->bind_param("ss", $user_name, $password_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch user data
    $row = $result->fetch_assoc();
    
    // Store user data in session
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['password_user'] = $row['password_user'];
    
    // Redirect to parentdash.html
    header("Location: http://localhost/myprojects/parentdash.html");
    exit();  // Make sure to exit after redirect
} else {
    // If credentials are wrong
    echo "<script>alert('Invalid username or password.')</script>";
    echo "<script>location.href='Login2.html'</script>";
}

// Close statement and connection
$stmt->close();
$conn->close();
