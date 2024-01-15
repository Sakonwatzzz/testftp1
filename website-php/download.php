<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["file"])) {
    $ftp_server = "ftp";
    $ftp_user_name = "ftp";
    $ftp_user_pass = "1234";

    $filename = $_GET["file"];

    // Connect to FTP server
    $conn_id = ftp_connect($ftp_server);
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

    if ($conn_id && $login_result) {
        // Create temp file to store downloaded content
        $tempFile = tempnam(sys_get_temp_dir(), 'ftp_download_');
        $handle = fopen($tempFile, 'w');

        // Download file from FTP and write to temp file
        if (ftp_fget($conn_id, $handle, $filename, FTP_BINARY, 0)) {
            fclose($handle);
            ftp_close($conn_id);

            // Set headers for download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            readfile($tempFile);

            // Delete temp file
            unlink($tempFile);
            exit;
        } else {
            fclose($handle);
        }
    } else {
        echo "FTP connection failed.";
    }
    ftp_close($conn_id);
}

// Redirect to index.php if no file specified
header("Location: index.php");
exit;
?>
