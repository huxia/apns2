<?php
require_once __DIR__ . '/../vendor/autoload.php';

$connection = new \Huxia\Apns2\Connection(['sandbox' => false, 'cert-path' => '/data/www/v4/worker/cert/http2.pem']);

$responses = $connection->send([
    '81fbf7e296f6c94755832a48476182e4e9586a380116e18a46531b62349504f0',
    'e2d0b464813b6b2371d745dff2b1e5fb6b83b07f7dcd98cc9f1346a7752dcc45',
    '81fbf7e296f6c94755832a48476182e4e9586a380116e18a46531b62349504f1' // invalid
], [
    'aps' => [
        'alert' => 'test 2',
        'sound' => 'default',
    ]
], [
    'apns-topic' => 'com.ohsame.same2.0',
]);
$connection->close();
var_dump($responses);