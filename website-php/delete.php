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
        // Delete file from FTP
        if (ftp_delete($conn_id, $filename)) {
            ftp_close($conn_id);

            // Remove file from session
            if (isset($_SESSION['uploadedFiles'])) {
                $_SESSION['uploadedFiles'] = array_diff($_SESSION['uploadedFiles'], [$filename]);
            }

            header("Location: index.php");
            exit;
        } else {
            echo "Failed to delete file.";
        }
    } else {
        echo "FTP connection failed.";
    }
    ftp_close($conn_id);
} else {
    echo "Invalid request.";
}
?>
