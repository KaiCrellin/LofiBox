<?php 
session_start();

require_once __DIR__ . '/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = $_POST['email'];
    $password = $_POST['password'];


    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if (!$user) {
        echo "account not found with that email";
    } elseif (password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        session_regenerate_id(true);
        header("Location: home.php");
        exit();
    } else {
        echo "Incorrect Password";
    }
    
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Back</a>
    <a href="register.php">Register</a>
    <h2>Login</h2>
    <form method="POST">
    <input type="email" name="email" required placeholder="Email">
    <input type="text" name="username" required placeholder="Username">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit">Log In</button>
</form>
    
</body>
</html>