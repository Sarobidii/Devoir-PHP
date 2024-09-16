<?php
$servername = "localhost";
$username = "sarobidy";
$password = "azertyuiop"; 
$dbname = "inscription";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>


