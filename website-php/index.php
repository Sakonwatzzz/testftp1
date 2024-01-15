<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FTP File Upload</title>
</head>
<body>
    <h2>Uploaded Files</h2>

    <?php
    if (isset($_SESSION['uploadedFiles']) && !empty($_SESSION['uploadedFiles'])) {
        echo "<p>Uploaded files:</p>";
        echo "<ul>";
        foreach ($_SESSION['uploadedFiles'] as $filename) {
            echo "<li id='file_$filename'>
                    <span id='display_$filename'>$filename</span> <tr>
                    <a href='download.php?file=" . urlencode($filename) . "'>Download File</a> <tr>
                    <a href='delete.php?file=" . urlencode($filename) . "'>Delete File</a> <tr>
                    <a href='#' onclick='editFileName(\"$filename\")'>Edit Name</a> <tr>
                  </li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No files uploaded yet.</p>";
    }
    ?>

    <h2>Upload File to FTP</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Select a file:</label>
        <input type="file" name="file" id="file">
        <br>
        <input type="submit" value="Upload">
    </form>

    <script>
        function editFileName(filename) {
            var newName = prompt("Enter new name for " + filename + ":");
            if (newName !== null && newName !== "") {
                // Send the new name to edit.php
                window.location.href = "edit.php?file=" + encodeURIComponent(filename) + "&newName=" + encodeURIComponent(newName);
            }
        }
    </script>
</body>
</html>
