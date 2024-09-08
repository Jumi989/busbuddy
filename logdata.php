<?php
session_start();  // Start the session

// Set session timeout (in seconds)
$session_timeout = 120;  // 20 seconds timeout

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

// Database connection
$servername = "localhost";  
$db_username = "root";         
$db_password = "";           
$dbname = "busbuddy";    

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user_name from session
$user_name = $_SESSION['user_name'];

// Prepare and execute the query
$stmt = $conn->prepare("SELECT contact_no, child_name, dob, school_name, student_id FROM guardians WHERE user_name = ?");
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();

// Create HTML structure
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
            // Check if the user details are found
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Print each field to verify data
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
// Close the statement and connection
$stmt->close();
$conn->close();
