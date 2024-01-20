<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
    <title>FTP File Upload</title>
</head>

<body>
    <header>
        <h2 class="h-ftp">FTP Files</h2>

    </header>

    <nav>
        <?php
        if (isset($_SESSION['uploadedFiles']) && !empty($_SESSION['uploadedFiles'])) {
            echo "<p>Uploaded files:</p>";
            echo "<ul>";
            foreach ($_SESSION['uploadedFiles'] as $filename) {
                echo "<li id='file_$filename'>
                    <span id='display_$filename'>$filename</span> <tr>
                    <a href='download.php?file="  . urlencode($filename) . "'>Download File</a> <tr>
                    <a href='delete.php?file=" . urlencode($filename) . "'>Delete File</a> <tr>
                    <a href='#' onclick='editFileName(\"$filename\")'>Edit Name</a> <tr>
                  </li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No files uploaded yet.</p>";
        }
        ?>
    </nav>  
<article>
    <h2 class="h-uftof">Upload File to FTP</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label class="la-select" for="file">Select a file:</label>
        <input type="file" name="file" id="file">
        <br>
        <input class="int-up" type="image" src="https://cdn-icons-png.flaticon.com/512/3616/3616929.png" width=50px height 50px="submit" value="Upload">
    </form>
</article>


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