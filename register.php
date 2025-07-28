<?php 
session_start();
require_once __DIR__ . '/config/db.php';



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username =  trim($_POST['username']);
    $email = filter_var($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
        $stmt->execute([$username, $email, $password]);
        header("Location: Login.php");
    } catch (PDOException $e) {
        echo "user already registered" . $e->getMessage();
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

<form method="POST">
    <a href="index.php">Back</a>
    <a href="login.php">Log In</a>
    <h2>Register</h2>
    <input type="email" name="email" required  placeholder="Email">
    <input type="text" name="username" required placeholder="Username">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit">Sign Up</button>
</form>
    
</body>
</html>