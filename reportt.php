<?php

$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "busbuddy";    

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_name = $_POST['user_name'];
$message = $_POST['message'];
$type = $_POST['type'];

$stmt = $conn->prepare("INSERT INTO report (user_name, message, type) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $user_name, $message, $type);

if ($stmt->execute()) {
    echo "Your reportn has been subbmitted!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

