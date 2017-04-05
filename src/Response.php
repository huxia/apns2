<?php
namespace Apns2;

/**
 * Response for sending message to specific device via APNs
 * @see https://developer.apple.com/library/content/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/CommunicatingwithAPNs.html#//apple_ref/doc/uid/TP40008194-CH11-SW17
 * @package Apns2
 */
class Response
{
    public $device_id;
    public $code;
    public $reason;
    public $duration;

    public function __construct($responseHeaderAndBody, $code, $duration)
    {
        $this->duration = $duration;
        $this->code = $code;
        $m = preg_match('/^\s+ (\d+).*?\\n(.*)$/s', $responseHeaderAndBody);
        if ($m) {
            $this->code = $m[1];
        }
        $body = $m[2];
        if ($body) {
            $json = json_decode($body);
            $this->reason = isset($json->reason) ? $json->reason : '';
        }
    }
}