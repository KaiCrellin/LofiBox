<?php
session_start();
require_once __DIR__ . '/config/db.php';
$user_id = $_SESSION['user_id'] ?? null;

if (!isset($_SESSION['user_id']  )) {
    header("Location: /login.php");
    exit();
}


if (!$user_id) {
    die("User Not Logged In");
}



$stmt = $pdo->prepare("SELECT  id, filename, title, artist, duration, cover, date_added  FROM songs WHERE user_id = :user_id ORDER BY date_added DESC");
$stmt->execute(['user_id' => $user_id]);
$songs = $stmt->fetchALL(PDO::FETCH_ASSOC);

if (count($songs) === 0 ) {
    echo "No Songs to display";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LofiBox</title>
    <link rel="stylesheet" href="Assets\style.css">
</head>


<body>
<a href="profile.php">Profile</a>
<a href="add_song.php">Add A Song!</a>
<div class="player-container">
    <?php
    foreach ($songs as $song):
    ?>
    <div class="play-card">
        <img class="song-cover" id="song-cover" src="<?= htmlspecialchars($song['cover']) ?>" alt="">
        <div class="play-info">
            <h1><?= htmlspecialchars($song['title']) ?></h1>
            <p><?= htmlspecialchars($song['artist']) ?></p>
            <audio class="player-audio" id="my-audio" controls>
                <source src="<?= htmlspecialchars($song['filename'])?>" type="audio/mpeg">
            </audio>
            <p><Uploaded: <?= htmlspecialchars($song['date_added'])?></p>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
<script src="\lofi_box\Assets\home.js" defer></script>

</html>