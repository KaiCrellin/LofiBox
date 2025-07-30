<?php 
session_start();
require_once __DIR__ . '/config/db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);



// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("user not logged in.");
}

$user_id = $_SESSION['user_id'];


try {
    $stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if (!$user) {
        echo "user ID does not mached Stored ID";
        exit();
    }
    



} catch (PDOException $e) {
    echo "database Error:" . $e->getMessage();
    exit();
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
    <a href="home.php">Back</a>
    <h1>Welcome to your proflie <?= htmlspecialchars($user['username']) ?></h1>
    <p>Your Email: <?= htmlspecialchars($user['email'])?></p>
    <a href="logout.php">Logout</a>




<!--
Add a Section to display User songs.
Users must have a relationship with songs through id.
Allowing us to join the tables and match users to songs to display
song they have uploaded. (FURTHER) --- Allows for favouriting 
features

-->
</body>
</html>