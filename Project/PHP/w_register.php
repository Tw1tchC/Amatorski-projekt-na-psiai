<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/w_register.css">
    <link rel="shortcut icon" type="x-icon" href="../IMG/HH_miniaturka.png">
    <title>HungryHub-Rejestracja</title>
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
    <div>
        <div class="block1">
            <h1>Zarejestruj się</h1>
            <div id="dologowania">
                <button type="button" class="button_1">
                    <a href="login.php" target="_blank">Już posiadasz konto? Zaloguj się tutaj!</a>
                </button>
            </div>
            <br>
        </div>
        <br>
        <div>
            <div class="register"><BR>
                <form method="post" action>
                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name="username" required><br>

                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required><br>

                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" required><br>

                    <label for="confirm_password">Confirm Password:</label><br>
                    <input type="password" id="confirm_password" name="confirm_password" required><br>

                    <label for="birthdate">Birthdate:</label><br>
                    <input type="date" id="birthdate" name="birthdate" required><br>

                    <label for="gender">Gender:</label><br>
                    <select id="gender" name="gender" required>
                        <option value="">Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select><br>

                    <label for="country">Country:</label><br>
                    <input type="text" id="country" name="country" required><br>

                    <input type="submit" class="button_2">
                </form>
            </div>
            <?php
            session_start();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // get form data and sanitize inputs
                $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
                $birthdate = filter_input(INPUT_POST, 'birthdate');
                $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
                $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);

                $errors = [];

                if (empty($username)) {
                    $errors[] = 'Username is required';
                }

                if (empty($email)) {
                    $errors[] = 'Email is required';
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = 'Email is invalid';
                }

                if (empty($password)) {
                    $errors[] = 'Password is required';
                } elseif (strlen($password) < 8) {
                    $errors[] = 'Password must be at least 8 characters long';
                }

                if ($password !== $confirm_password) {
                    $errors[] = 'Passwords do not match';
                }

                if (empty($birthdate)) {
                    $errors[] = 'Birthdate is required';
                }

                if (empty($gender)) {
                    $errors[] = 'Gender is required';
                }

                if (empty($country)) {
                    $errors[] = 'Country is required';
                }

                // jeśli nie ma błędów, wprowadź użytkownika do bazy danych
            
                if (empty($errors)) {
                    $mysqli = new mysqli('localhost', 'root', '', 'php_project_by_adrian_kulik');

                    if ($mysqli->connect_errno) {
                        echo 'Failed to connect to MySQL: ' . $mysqli->connect_error;
                        exit();
                    }
                    // hash na hasło
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // zapytanie
                    $stmt = $mysqli->prepare('INSERT INTO users (username, email, password, birthdate, gender, country) VALUES (?, ?, ?, ?, ?, ?)');
                    $stmt->bind_param('ssssss', $username, $email, $hashed_password, $birthdate, $gender, $country);

                    // wykonanie zapytania
                    if ($stmt->execute()) {
                        // redirectuj użytkownika do loginu
                        header('Location: login.php');
                        exit();
                    } else {
                        echo 'Failed to insert user into database: ' . $stmt->error;
                    }

                    $stmt->close();
                    $mysqli->close();
                } else {
                    foreach ($errors as $error) {
                        echo $error . '<br>';
                    }
                }
            }
            ?>

        </div>
    </div>
</body>

</html>