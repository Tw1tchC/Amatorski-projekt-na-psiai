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
    // to przekieruje do strony którą bedziesz chciał narazie dam tu jakies dashboard zjebane
    header("Location: dashboard.php");
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

        // to przekieruje do strony którą bedziesz chciał narazie dam tu jakies dashboard zjebane
        header("Location: dashboard.php");
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

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h2>User Login</h2>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Login:</label>
        <input type="text" name="login" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
</body>
</html>
