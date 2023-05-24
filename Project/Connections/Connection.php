<?php
// Baza
$host = "localhost"; 
$user = "root";
$password = ""; 
$dbname = "hungryhub"; // chyba taka nazwa będzie wygodna jak nie to ją zmień ;D
// Tworzyć połącznie
$conn = new mysqli($host, $user, $password, $dbname);

// Sprawdzanie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

echo "Połączonie zakończyło sie powodzeniem";
?>
