<?php


// Database credentials
$servername = "localhost:3306";
$username = "root";
$password = "waruna@99";
$dbname = "gym_on";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully";

// Close the connection
//mysqli_close($conn);
?>
