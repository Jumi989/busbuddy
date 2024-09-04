<?php

$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "busbuddy";    

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_name = $_POST['username'];
$contact_no = $_POST['contact_no'];
$child_name = $_POST['child_name'];
$dob = $_POST['dob'];
$school_name = $_POST['school_name'];
$student_id = $_POST['student_id'];
$password_user = $_POST['password_user'];

$stmt = $conn->prepare("INSERT INTO guardians (user_name, contact_no, child_name, dob, school_name, student_id, password_user) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssis", $user_name, $contact_no, $child_name, $dob, $school_name, $student_id, $password_user);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

