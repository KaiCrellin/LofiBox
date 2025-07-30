<?php
session_start();
require_once __DIR__ . '/config/db.php'; 


var_dump($_FILES);



$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    die("User not logged in");
} else {
    session_regenerate_id($user_id);

}

if (isset($_POST['submit'])) {
    $song_title = trim($_POST['song-name']);
    $artist = trim($_POST['artist']);

    if (empty($song_title)) {
        die("Song name is required");
    }

    if(isset($_FILES['file1']) && $_FILES['file1']['error'] === UPLOAD_ERR_OK) {
        echo "files present";
    } else {
        echo "cover image upload failed";

    }

    // Set upload directories
    $uploads_dir =  __DIR__ . '/Songs/';
    $cover_dir = __DIR__ . '/covers/' ;





    // Create directories if they don’t exist
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }
    if (!is_dir($cover_dir)) {
        mkdir($cover_dir, 0777, true);
    }

    // Allowed types
    $allowed_audio_types = ['audio/mpeg'];
    $allowed_audio_exts = ['mp3'];

    $allowed_image_types = ['image/jpeg'];
    $allowed_image_exts = ['jpg', 'jpeg'];

    $duration = 0;

    if (isset($_FILES['file1']) && $_FILES['file1']['error'] === UPLOAD_ERR_OK) {
        echo "file present";
    } else {
        die("File fialed to upload");
    }

    // --- COVER UPLOAD ---
    if ($_FILES['file1']['error'] === UPLOAD_ERR_OK) {
        $cover_tmp = $_FILES['file1']['tmp_name'];
        $cover_ext = strtolower(pathinfo($_FILES['file1']['name'], PATHINFO_EXTENSION));
        $cover_mime = mime_content_type($cover_tmp);
        

        if (!in_array($cover_ext, $allowed_image_exts) || !in_array($cover_mime, $allowed_image_types)) {
            die(" Invalid cover image. Only JPG is allowed.");
        }

        $safe_title = preg_replace("/[^a-zA-Z0-9_-]/", "-", strtolower($song_title));
        $cover_filename = $safe_title . "_cover." . $cover_ext;
        move_uploaded_file($_FILES['file1']['tmp_name'], $cover_dir . $cover_filename);
        $cover_path = '/lofi_box/covers/' . $cover_filename;
        
      
    } else {
        die(" Cover image upload failed.");
    }

    // --- AUDIO UPLOAD ---
    if ($_FILES['file2']['error'] === UPLOAD_ERR_OK) {
        $song_tmp = $_FILES['file2']['tmp_name'];
        $song_ext = strtolower(pathinfo($_FILES['file2']['name'], PATHINFO_EXTENSION));
        $song_mime = mime_content_type($song_tmp);

        if (!in_array($song_ext, $allowed_audio_exts) || !in_array($song_mime, $allowed_audio_types)) {
            die(" Invalid audio file. Only MP3 is allowed.");
        }

        $song_filename = basename($_FILES['file2']['name']);
        move_uploaded_file($_FILES['file2']['tmp_name'], $uploads_dir . $song_filename);
        $song_path =   '/lofi_box/Songs/' . $song_filename;
    } else {
        die(" Audio file upload failed.");
    }

   

    // --- INSERT INTO DATABASE ---
    $stmt = $pdo->prepare("INSERT INTO songs (user_id, filename, title, artist, duration, cover) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $song_path, $song_title, $artist, $duration, $cover_path]);

    echo " Upload successful.";
    header('Location: home.php');
}
?>