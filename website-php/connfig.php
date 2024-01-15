<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $ftp_server = "ftp";
    $ftp_user_name = "ftp";
    $ftp_user_pass = "1234";

    $file = $_FILES["file"]["tmp_name"];
    $filename = $_FILES["file"]["name"];

    $conn_id = ftp_connect($ftp_server);
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

    if ($conn_id && $login_result) {
        ftp_put($conn_id, $filename, $file, FTP_BINARY);
        ftp_close($conn_id);
        header("Location: index.php?filename=" . urlencode($filename));
        exit;
    } else {
        echo "FTP connection failed.";
    }
    ftp_close($conn_id);
} else {
    echo "Invalid request.";
}
?>
