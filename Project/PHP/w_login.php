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

    <?php
    session_start();

    // Sprawdza czy formularz został spostowany 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // zbiera dane z formularza nie przejmuj sie sanityzacją bo to jest tylko polega na usuwaniu potencjalnie złośliwych kawałków tam plików bez utraty ich treści
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $errors = [];

        if (empty($email)) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email is invalid';
        }

        if (empty($password)) {
            $errors[] = 'Password is required';
        }

        // jeśli nie ma błędu to sprawdza połączenia
        if (empty($errors)) {

            $mysqli = new mysqli('localhost', 'root', '', 'php_project_by_adrian_kulik');

            if ($mysqli->connect_error) {
                echo 'Failed to connect to MySQL: ' . $mysqli->connect_error;
                exit();
            }

            // przygotowuje zapytanie
            $stmt = $mysqli->prepare('SELECT id, username, password FROM users WHERE email = ?');
            $stmt->bind_param('s', $email);

            // zapytanie
            if ($stmt->execute()) {
                // rezultat
                $result = $stmt->get_result();

                // jesli użytkownik istnieje hasło jest poprawne 
                if ($result->num_rows === 1) {
                    $row = $result->fetch_assoc();
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];

                        header('Location: main.html');
                        exit();
                    } else {
                        $errors[] = 'Incorrect password';
                    }
                } else {
                    $errors[] = 'User not found';
                }
            } else {
                echo 'Failed to retrieve user information from database: ' . $stmt->error;
            }

            $stmt->close();
            $mysqli->close();
        }
    }
    ?>
    <?php
    // sprawdza czy nie ma błędów
    if (!empty($errors)) {
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
    }
    ?>
    <div class="logowanie">
        <h1>Logowanie</h1>
        <h2>Wpisz Nazwę oraz Hasło</h2>
        <form action="w_login.php" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit" class="button1">Login</button>
        </form>
    </div>

</body>

</html>