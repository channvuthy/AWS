<?php
require('app/start.php');
$objects = $s3->getIterator('ListObjects', [
    'Bucket' => $config['s3']['bucket']
]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listings</title>
    <link rel="stylesheet" href="css/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="css/node_modules/jquery/dist/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <br>
    <div class="clearfix"></div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>File</th>
            <th>Download</th>
        </tr>
        <?php foreach ($objects as $object): ?>
            <?php
            $curlCh = curl_init();
            curl_setopt($curlCh, CURLOPT_URL,$object);
            curl_setopt($curlCh, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curlCh, CURLOPT_SSLVERSION,3);
            $curlData = curl_exec ($curlCh);
            $code = curl_getinfo($curlCh, CURLINFO_HTTP_CODE);
            curl_close ($curlCh);
            $downloadPath = $folder."/".str_replace(" ","",$object);
            $file = fopen($downloadPath, "w+");
            fputs($file, $curlData);
            fclose($file);
            ?>
        <?php endforeach; ?>

        </thead>
    </table>
</div>
</body>
</html>