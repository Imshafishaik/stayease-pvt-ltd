<?php
require __DIR__ . '/../vendor/autoload.php';

use Aws\S3\S3Client;

$config = require __DIR__ . '/aws.php';

$s3 = new S3Client([
    'version'     => 'latest',
    'region'      => $config['region'],
    'credentials' => [
        'key'    => $config['key'],
        'secret' => $config['secret'],
    ],
]);

$bucket = $config['bucket'];
?>