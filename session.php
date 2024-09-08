<?php
session_start();  

$servername = "localhost";  
$username = "root";         
$password = "";           
$dbname = "busbuddy";    

$session_timeout = 120;


if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $session_timeout) {
    session_unset();     
    session_destroy();   
    header("Location: http://localhost/busbuddy/Login2.html"); 
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$password_user = isset($_POST['password_user']) ? $_POST['password_user'] : '';

$stmt = $conn->prepare("SELECT * FROM guardians WHERE user_name = ? AND password_user = ?");
$stmt->bind_param("ss", $user_name, $password_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['password_user'] = $row['password_user'];
    
    header("Location: http://localhost/busbuddy/parentdash.php");
    exit();  
} else {
    echo "<script>alert('Invalid username or password.')</script>";
    echo "<script>location.href='http://localhost/busbuddy/Login2.html'</script>";
}

$stmt->close();
$conn->close();
