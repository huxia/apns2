<?php
require_once __DIR__ . '/../vendor/autoload.php';

$connection = new \Huxia\Apns2\Connection();
$connection->sandbox = false;
$connection->certPath = '/data/www/v4/worker/cert/http2.pem';

$random_id = rand(10000, 2000);

$uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
echo "send notification with uuid: $uuid\n";
$responses = $connection->send([
    '81fbf7e296f6c94755832a48476182e4e9586a380116e18a46531b62349504f2', // invalid id
], [
    'aps' => [
        'alert' => 'test 2',
        'sound' => 'default',
    ]
], [
    'apns-topic' => 'com.ohsame.same2.0',
    'apns-id' => $uuid,
]);
$connection->close();
echo "check response: {$responses[0]->apnsId} == ${uuid}\n";
assert($responses[0]->apnsId == $uuid);

$reason = \Huxia\Apns2\Response::REASON_BAD_DEVICE_TOKEN;
echo "check response: {$responses[0]->reason} == ${reason}\n";
assert($responses[0]->reason == $reason);