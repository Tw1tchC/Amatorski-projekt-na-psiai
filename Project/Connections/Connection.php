<?php
// Baza
$host = "localhost"; 
$user = "root";
$password = ""; 
$dbname = "HH_Project"; // chyba taka nazwa będzie wygodna jak nie to ją zmień ;D
// Tworzyć połącznie
$conn = new mysqli($host, $user, $password, $dbname);

// Sprawdzać połączenie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>
