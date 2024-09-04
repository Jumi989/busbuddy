<?php
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

// The location and bus_license values from user input
$location = $_POST['location'];
$bus_license = $_POST['bus_license'];

// Initialize the bus_no prefix based on location
$bus_no_prefix = '';
if ($location == 'Mirpur') {
    $bus_no_prefix = '3';
} elseif ($location == 'Gazipur') {
    $bus_no_prefix = '4';
}elseif ($location == 'Bosila') {
    $bus_no_prefix = '5';
}elseif ($location == 'Gulshan') {
    $bus_no_prefix = '6';
}elseif ($location == 'Dhanmondi') {
    $bus_no_prefix = '7';
}elseif ($location == 'Mohammadpur') {
    $bus_no_prefix = '8';
}

// Fetch the last bus_no for the given location
$sql = "SELECT MAX(CAST(SUBSTRING(bus_no, 3) AS UNSIGNED)) AS max_bus_no FROM bus_details WHERE bus_no LIKE '2$bus_no_prefix%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $max_bus_no = $row['max_bus_no'];

    // If max_bus_no is null, set it to 230 to start at 231
    if (is_null($max_bus_no)) {
        $max_bus_no = 230;
    }

    // Increment the max bus_no to get the next bus_no
    $next_bus_no = $max_bus_no + 1;
} else {
    // Start from 231 if no records found
    $next_bus_no = 231;
}

// Combine '2' with the prefix and the next numeric bus_no
$new_bus_no = '2' . $bus_no_prefix . $next_bus_no;


// Now insert the new record with the custom bus_no, bus_license, and location
$sql = "INSERT INTO bus_details (bus_no, bus_license, location) 
        VALUES ('$new_bus_no', '$bus_license', '$location')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully with Bus No: $new_bus_no";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
