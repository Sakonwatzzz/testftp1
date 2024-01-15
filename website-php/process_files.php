<?php
session_start();

// Assuming your uploaded files are stored in a directory named "uploads"
$uploadDir = "uploads/";

if (!empty($_SESSION['uploadedFiles'])) {
    foreach ($_SESSION['uploadedFiles'] as $filename) {
        $sourcePath = $uploadDir . $filename;
        $destinationPath = "/path/to/your/safe/location/" . $filename;

        // Move the file to a safe location
        if (rename($sourcePath, $destinationPath)) {
            echo "File moved successfully: $filename";
        } else {
            echo "Failed to move file: $filename";
        }
    }

    // Clear the uploadedFiles array
    $_SESSION['uploadedFiles'] = array();
} else {
    echo "No files to process.";
}
?>
