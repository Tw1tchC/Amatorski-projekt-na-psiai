<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "hungryhub";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $login = $_POST["login"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    // Prepare the SQL statement
    $sql = "INSERT INTO dane_uzytkownikow (login, password, adres, email, wiek) VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $login, $password, $address, $email, $age);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Login:</label>
        <input type="text" name="login" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        
        <label>Address:</label>
        <input type="text" name="address" required><br><br>
        
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        
        <label>Age:</label>
        <input type="number" name="age" required><br><br>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>
