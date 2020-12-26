<?php
$servername = "localhost";//localhost for local PC or use IP address
$username = "root"; //database name
$password = "";//database password
$database = "masomononlineshopping";//database name

// Create connection #scawx
$conn = new mysqli($servername, $username, $password,$database);

// Check connection #scawx
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>