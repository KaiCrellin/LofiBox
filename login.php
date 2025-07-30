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

<style>
    body {
        font-family: sans-serif;
        background-color: black;
        color: #eee;
        padding: 2rem;
        display: grid;
        justify-content: center;
    }

   a {
        border: 2px solid white;
        border-radius: 2rem;
        padding: 1rem;
        background: blue;
        color: white;
        text-transform: capitalize;
        font-size: x-large;
        margin: 15px 15px 15px 15px;
        position: relative;
        text-decoration: none;
   }

   .bttns {
    height: 100px;
    width: 800px;
   }


   button {
        border: 2px solid white;
        border-radius: 2rem;
        padding: 1rem;
        background: blue;
        color: white;
        text-transform: capitalize;
        font-size: x-large;
        margin: 15px 15px 15px 15px;
        text-decoration: none;
        display: flex;
        justify-self: center;
   }

   h1 {
    display: flex;
    justify-content: center;
    border: 2px solid white;
    padding: 1rem;
    background-color: gray;
   }

   form {
    border: 2px solid white;
    background: darkgray;
   }

   input {
    padding: 0.6rem;
    display: grid;
    justify-self: center;
    margin: 15px 15px 15px 15px;


   }
</style>


<body>
    <div class="bttns">
        <a href="index.php">Back</a>
        <a href="register.php">Register</a>
    </div>
  

    <h1>Login</h1>

<form method="POST">
    <input type="email" name="email" required placeholder="Email">
    <input type="text" name="username" required placeholder="Username">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit">Log In</button>
</form>
    
</body>
</html>