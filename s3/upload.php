<?php
use Aws\S3\Exception\S3Exception;
require('app/start.php');
//S3
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    // File details
    $name = $file['name'];
    $tmp_name = $file['tmp_name'];
    $extension = explode(".", $name);
    $extension = strtolower(end($extension));
    // Temp details
    $key = md5(uniqid());
    $tmp_file_name = "{$key}.{$extension}";
    $tmp_file_path = "files/{$tmp_file_name}";
    // Move the file
    move_uploaded_file($tmp_name, $tmp_file_path);
    try {
        $s3->putObject([
            "Bucket" => $config["s3"]["bucket"],
            "Key" => "uploads/{$name}",
            "Body" => fopen($tmp_file_path, "rb"),
            "ACL" => "public-read"
        ]);
        // Remove the file
        @unlink($tmp_file_path);
    } catch (S3Exception $e) {
        die('There was an error uploading that file.');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload</title>
    <link rel="stylesheet" href="css/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="css/node_modules/jquery/dist/jquery.min.js"></script>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <div class="container">
        <br>
        <div class="clearfix"></div>
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
                <input type="file" name="file" id="" class="form-control" required>

            </div>
            <div class="form-group">
                <input type="submit" value="Upload" class="btn btn-default">
            </div>
        </div>
    </div>
</form>
</body>
</html>