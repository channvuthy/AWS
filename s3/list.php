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

            <tr>
                <?php $ifFile = strpos($object['Key'], "."); ?>
                <?php if ($ifFile): ?>
                    <td><?php echo $object['Key']; ?></td>
                    <td><a href="<?php echo $s3->getObjectUrl($config['s3']['bucket'], $object['Key']); ?>"
                           download="<?php echo $object['Key']; ?>">Download</a></td>
                <?php else: ?>

                <?php endif; ?>

            </tr>
        <?php endforeach; ?>

        </thead>
    </table>
</div>
</body>
</html>