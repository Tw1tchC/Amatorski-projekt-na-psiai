<html>
  <head>
    <title>Rejestracja</title>
    <link rel="stylesheet" href="register.css">
  </head>
  <body>
  <div>
    <div>
      <h1>Zarejestruj się</h1>
      <button type="button">
          <a href="login.php" target="_blank">Już posiadasz konto? Zaloguj się tutaj!</a>
      </button>
      <br>
      <br>
      <br>
    </div>
    <div>
      <form method="post" action>
      <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>
        
        <label for="birthdate">Birthdate:</label>
        <input type="date" id="birthdate" name="birthdate" required><br>
        
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
          <option value="">Select your gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select><br>
        
        <label for="country">Country:</label>
        <input type="text" id="country" name="country" required><br>
        
        <input type="submit">
      </form>
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