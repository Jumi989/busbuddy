<?php
session_start();  

$session_timeout = 120;  

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $session_timeout) {
    session_unset();    
    session_destroy();  
    header("Location: http://localhost/busbuddy/Login2.html");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

if (!isset($_SESSION['user_name'])) {
    header("Location: http://localhost/busbuddy/Login2.html");
    exit();
}

$servername = "localhost";  
$db_username = "root";         
$db_password = "";           
$dbname = "busbuddy";    

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_name = $_SESSION['user_name'];

$stmt = $conn->prepare("SELECT contact_no, child_name, dob, school_name, student_id FROM guardians WHERE user_name = ?");
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busbuddy</title>
    <link rel="stylesheet" href="stylereg2.css">
</head>
<body>
    <div class="wrapper">
        <h1>Student Details</h1>
        <div class="details">
            <?php
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<p>Contact No: " . htmlspecialchars($row['contact_no']) . "</p>";
                echo "<p>Child Name: " . htmlspecialchars($row['child_name']) . "</p>";
                echo "<p>Date of Birth: " . htmlspecialchars($row['dob']) . "</p>";
                echo "<p>School Name: " . htmlspecialchars($row['school_name']) . "</p>";
                echo "<p>Student ID: " . htmlspecialchars($row['student_id']) . "</p>";
            } else {
                echo "<p>No user details found for user_name: " . htmlspecialchars($user_name) . "</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
