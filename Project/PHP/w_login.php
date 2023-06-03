<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/w_login.css">
    <link rel="shortcut icon" type="x-icon" href="../IMG/HH_miniaturka.png">
    <title>HungryHub-Logowanie</title>
</head>

<body>
    <header>
        <div>
            <a href="../w_main.html"><img src="../IMG/HH_logo.png" class="img1"></a>
        </div>
        <nav id="topnav">
            <ul class="menu">
                <li><a href="../PHP/w_register.php">Rejestracja</a></li>
                <li><a href="../PHP/w_login.php">Logowanie</a></li>
                <li><a href="">Lista dostępnych restauracji oraz sklepów</a></li>
                <li><a href="">Koszyk i kasa</a></li>
            </ul>
        </nav>
    </header>
    <div class="logowanie">
        <?php if (isset($error)) { ?>
            <p>
                <?php echo $error; ?>
            </p>
        <?php } ?>
        <div class="logowanie">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"><br>
                <label>Login:</label><br>
                <input type="text" name="login" required><br><br>

                <label>Password:</label><br>
                <input type="password" name="password" required><br><br>

                <button type="submit">Login</button>
            </form>

        </div>
    </div>
</body>

</html>
<?php
// Rozpoczyna sesje
session_start();

// połączenia z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$database = "hungryhub";

// Utwórz nowe połączenie
$conn = new mysqli($servername, $username, $password, $database);

// Sprawdź połączenie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sprawdza czy uzytkownik jest juś zalogowany jesli tak to odrazu przekierowuje do strony 
if (isset($_SESSION["user_id"])) {
    // to przekieruje do strony którą bedziesz chciał narazie dam tu jakies dashboard 
    header("Location: ../w_main.html");
    exit();
}

// formularz został przesłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobierz dane formularza
    $login = $_POST["login"];
    $password = $_POST["password"];

    // SQL
    $sql = "SELECT * FROM dane_uzytkownikow WHERE login = ? AND password = ?";

    // statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $login, $password);

    // Execute the statement
    $stmt->execute();

    // wynik
    $result = $stmt->get_result();

    // Sprawdź, czy użytkownik istnieje
    if ($result->num_rows > 0) {
        // Pobierz dane użytkownika
        $user = $result->fetch_assoc();

        // Zapisuje id i te tegetsy
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["login"] = $user["login"];

        // to przekieruje do strony którą bedziesz chciał narazie dam tu jakies dashboard
        header("Location: ../w_main.php");
        exit();
    } else {
        $error = "Bład podczas logowania, hasło lub login są nieprawidłowe!";
    }

    //statement
    $stmt->close();
}

// the connection
$conn->close();
?>
