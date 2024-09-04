<?php

$servername = "localhost";  
$username = "root";         
$password = "";           
$dbname = "busbuddy";    

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
    
    echo "Login successful!<br>";
    echo "Welcome, " . $row['user_name'] . "!<br>";
    echo "Contact No: " . $row['contact_no'] . "<br>";
    echo "Child Name: " . $row['child_name'] . "<br>";
    echo "Date of Birth: " . $row['dob'] . "<br>";
    echo "School Name: " . $row['school_name'] . "<br>";
    echo "Student ID: " . $row['student_id'] . "<br>";
} else {
    echo "Invalid username or password.";
}

$stmt->close();
$conn->close();

