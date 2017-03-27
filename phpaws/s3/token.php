<?php
require('app/start.php');
$object = "uploads/Chrysanthemum.jpg";
$url = $s3->getObjectUrl($config['s3']['bucket'], $object, '5 minutes');
echo $download=$s3->downloadBucket("files/",$config['s3']['bucket']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Token</title>
</head>
<body>
<a href="<?php echo $url; ?>">Download</a>
</body>
</html>