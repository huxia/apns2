<?php
namespace Apns2;

/**
 * Response for sending message to specific device via APNs
 * @see https://developer.apple.com/library/content/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/CommunicatingwithAPNs.html#//apple_ref/doc/uid/TP40008194-CH11-SW17
 * @package Apns2
 */
class Response
{
    public $deviceId;
    public $code;
    public $bodyReason;
    public $body;
    public $duration;
    public $headers;


    public function __construct($responseHeaderAndBody, $code, $duration, $deviceId)
    {
        $this->duration = $duration;
        $this->code = $code;
        $this->deviceId = $deviceId;

        $m = preg_match('/^\s+ (\d+)(.*?)\\n\\r*\\n(.*)$/s', $responseHeaderAndBody);
        if ($m) {
            $this->code = $m[1];
        }
        $headers = $m[2];
        $this->headers = $headers;
        $body = $m[3];
        if ($body) {
            $this->body = json_decode($body);
            $this->bodyReason = isset($this->body) ? $this->body->reason : '';
        }
    }
}