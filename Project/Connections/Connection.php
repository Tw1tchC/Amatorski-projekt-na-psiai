<?php
// Baza
$host = "localhost"; 
$user = "root";
$password = ""; 
$dbname = "HH_Project"; // chyba taka nazwa będzie wygodna jak nie to ją zmień ;D
// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>