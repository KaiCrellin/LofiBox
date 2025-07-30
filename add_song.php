<?php session_start();


$user_id = $_SESSION['user_id'];


if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
} else {
    session_regenerate_id($user_id);
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

<a href="home.php">Back To Lofi Player</a>
<a href="profile.php">Profile</a>



 <form action="upload.php" method="POST" enctype="multipart/form-data">
    <label for="s-name"> Songs Name:
        <input type="text" name="song-name" required>
    </label>

    <label for="ar-name"> Artist:
        <input type="text" name="artist" required>
    </label>

    <label for="cover">Song Cover (JPG ONLY):
        <input type="file" name="file1" required>
    </label>

    <label for="song">Song File (MP3 ONLY):
        <input type="file" name="file2" required>
    </label>

    <label for="sub">
        <input type="submit" name="submit" value="upload-files">
    </label>
 </form>






    
</body>
</html>