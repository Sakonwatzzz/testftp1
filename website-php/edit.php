<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["file"]) && isset($_GET["newName"])) {
    $ftp_server = "ftp";
    $ftp_user_name = "ftp";
    $ftp_user_pass = "1234";

    $filename = $_GET["file"];
    $newName = $_GET["newName"];

    // Connect to FTP server
    $conn_id = ftp_connect($ftp_server);
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

    if ($conn_id && $login_result) {
        // Get the file extension from the original filename
        $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

        // Create the new filename with the same extension
        $newFilename = $newName . '.' . $fileExtension;

        // Rename the file on FTP
        if (ftp_rename($conn_id, $filename, $newFilename)) {
            ftp_close($conn_id);

            // Update file name in session
            if (isset($_SESSION['uploadedFiles'])) {
                $key = array_search($filename, $_SESSION['uploadedFiles']);
                if ($key !== false) {
                    $_SESSION['uploadedFiles'][$key] = $newFilename;
                }
            }

            header("Location: index.php");
            exit;
        } else {
            echo "Failed to rename file.";
        }
    } else {
        echo "FTP connection failed.";
    }
    ftp_close($conn_id);
} else {
    echo "Invalid request.";
}
?>
