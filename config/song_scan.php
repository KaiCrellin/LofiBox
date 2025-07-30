<!--

$musicDir = __DIR__ . '/../Songs';
$coverDir = __DIR__ . '/../covers';
$allowedExtensions = ['mp3', 'wav', 'ogg'];


$files = scandir($musicDir);


foreach($files as $file) {
    if (in_array(pathinfo($file, PATHINFO_EXTENSION), $allowedExtensions) === false) {
        continue;
    }

    $filename = $file;
    $basename = pathinfo($filename, PATHINFO_FILENAME);
    $title = ucwords(str_replace(["-", "_"], ' ', $basename));
    $artists = 'UNKNOWN'; // can improve later with ID3
    $duration = null;
    $cover = null;

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM songs WHERE filename = ?");
    $stmt->execute([$filename]);
    if ($stmt->fetchColumn() > 0 ) {
        continue;
    }


    $possibleImage = $basename. '.jpg';
    if (file_exists($coverDir . '/' . $possibleImage)) {
        $cover = $possibleImage;
    }

    $insert = $pdo->prepare("INSERT INTO songs (filename, title, artist, duration, cover) VALUES (?,?,?,?,?) ");
    $insert->execute([$filename,$title, $artists, $duration, $cover]);
}



-->


?>