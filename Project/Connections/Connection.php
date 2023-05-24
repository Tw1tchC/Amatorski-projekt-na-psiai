<?php
// Baza
$host = "localhost"; 
$user = "root";
$password = ""; 
$dbname = "hungryhub";
// Tworzyć połącznie
$conn = new mysqli($host, $user, $password, $dbname);

// Sprawdzanie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

echo "Połączonie zakończyło sie powodzeniem";
?>
