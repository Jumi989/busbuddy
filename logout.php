<?php
session_start();
session_unset();     // Unset session variables
session_destroy();   // Destroy the session

// Redirect to login page
header("Location: http://localhost/busbuddy/Login2.html");
exit();
