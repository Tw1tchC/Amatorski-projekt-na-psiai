<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/b_register.css">
    <link rel="shortcut icon" type="x-icon" href="../IMG/HH_miniaturka.png">
    <title>HungryHub-Rejestracja</title>
</head>

<body>
    <header>
        <div>
            <a href="../b_main.html"><img src="../IMG/HH_logo.png" class="img1"></a>
        </div>
        <nav id="topnav">
            <ul class="menu">
                <li><a href="b_register.php">Rejestracja</a></li>
                <li><a href="b_login.php">Logowanie</a></li>
                <li><a href="b_listarestauracji.php">Lista dostępnych restauracji oraz sklepów</a></li>
                <li><a href="b_menu.php">Sklep</a></li>
            </ul>
        </nav>
    </header>
    <div>
        <div class="block1">
            <h1>Zarejestruj się</h1>
            <div id="dologowania">
                <button type="button" class="button_1">
                    <a href="b_login.php" target="_blank">Już posiadasz konto? Zaloguj się tutaj!</a>
                </button>
            </div>
            <br>
        </div>
        <br>
        <div class="register">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"><br>
                <label>Login:</label><br>
                <input type="text" name="login" required><br><br>

                <label>Hasło:</label><br>
                <input type="password" name="password" required><br><br>

                <label>Adres:</label><br>
                <input type="text" name="address" required><br><br>

                <label>Email:</label><br>
                <input type="email" name="email" required><br><br>

                <label>Wiek:</label><br>
                <input type="number" name="age" required><br><br>

                <input class="button_2" type="submit" value="Register">
            </form>
        </div>
    </div>
</body>

</html>
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
</div>
</body>

</html>
