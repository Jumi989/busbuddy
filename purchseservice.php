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

$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="purchaseservice.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons/css/boxicons.min.css">
</head>
<body>
    
    
        <div class="header">
           
            <h1>Buy Service Packagedeals
                <div class="header-buttons">
               
                    <button id="go-back"><a href="http://localhost/busbuddy/parentdash.php">Go Back</a></button>
                    </div> 
            </h1>
           
        </div>
        <div class="packagedeals">
            
            <div  id="package1" class="package">
                <p><a href="monthly.html">Monthly Package</a></p>
                <p>Starting at ৳800/month</p>
            </div>
            <div id="package2" class="package">
                <p><a href="yearly.html">yearly Package</a></p>
                <p>Secure your child's safety for</p> 
                <p>the full academic year!</p>
            </div>
            <div  id="package3" class="package">
            <p><a href="daily.html">Go-To Service</a></p>
                <p>Request a temporay ride</p>
            </div>
           
        </div>
        
</body>
</html>