<?php
$servername = "localhost"; // or your server name
$dbUsername = "root";
$dbPassword = "2076";
$dbName = "final";

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
