<html lang = "pl">
   <head>
      <title>Login</title>
      <link rel="stylesheet" href="login.css">
   </head>
	
   <body>
      
      <h2>Wpisz Nazwe oraz Hasło</h2> 
         
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

<h1>Login Form</h1>
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
    <form action="login.php" method="post">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required><br>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br>

      <button type="submit">Login</button>
    </form>
   
      
   </body>
</html>