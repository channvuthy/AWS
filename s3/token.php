<?php
require('app/start.php');
$object = "upload/Content.pptx";
$url = $s3->getObjectUrl($config['s3']['bucket'], $object, '+1 minute');
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