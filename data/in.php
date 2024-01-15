<?php
session_start();

if (isset($_GET["filename"])) {
    $uploadedFilename = htmlspecialchars($_GET["filename"]);
    $_SESSION['uploadedFiles'][] = $uploadedFilename;
}

if (isset($_SESSION['uploadedFiles']) && !empty($_SESSION['uploadedFiles'])) {
    echo "<p>Uploaded files:</p>";
    echo "<ul>";
    foreach ($_SESSION['uploadedFiles'] as $filename) {
        echo "<li>$filename</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No files uploaded yet.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FTP File Upload</title>
</head>
<body>
    <h2>Upload File to FTP</h2>
    <form action="connftp.php" method="post" enctype="multipart/form-data">
        <label for="file">Select a file:</label>
        <input type="file" name="file" id="file">
        <br>
        <input type="submit" value="Upload">
    </form>


</body>
</html>

