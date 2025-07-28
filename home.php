<?php
session_start();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/song_scan.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit();
}



$stmt = $pdo->query("SELECT * FROM songs ORDER BY date_added DESC");
$songs = $stmt->fetchALL(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LofiBox</title>
    <link rel="stylesheet" href="Assets/style.css">
</head>

<body>

<div class="m-wrapper">


    <div class="heading">

        <div class="head1">
            <h1>Your LofiBox</h1>
            <a href="profile.php"><button>profile</button></a>
        </div>

    </div>

    <div class="s-wrapper">

        <div class="song-container">

            <div class="head">
                <h2>Yours Songs</h2>
            </div>
            

            <ul>
                <?php foreach ($songs as $song): ?>
                    <li class="songs">
                        <?php
                        $cover = $song['cover'] ? 'covers/' .htmlspecialchars($song['cover']) : 'covers/default.jpg';
                        $audio = 'Songs/' . htmlspecialchars($song['filename']);
                        ?>
                        <img id ="cover" src="<?= $cover?>" alt="" style="width:100px;">
                        <h2 id="title"><?= htmlspecialchars($song['title']) ?></h2>
                        <audio controls id="audio">
                            <source src="<?= $audio ?>" type="audio/mpeg" />
                            Your browser does not support the audio element.
                        </audio>
                    </li> 
                <?php endforeach; ?> 
            </ul>


        </div>

    </div>
    


</div>

</body>

</html>