<?php
// config.php
// Database connection settings for inventorydb

$host   = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "inventorydb";

$conn = new mysqli($host, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}