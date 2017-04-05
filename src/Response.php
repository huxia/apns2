<?php
namespace Huxia\Apns2;

/**
 * Response for sending message to specific device via APNs
 * @see https://developer.apple.com/library/content/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/CommunicatingwithAPNs.html#//apple_ref/doc/uid/TP40008194-CH11-SW17
 * @package Apns2
 */
class Response
{
    public $deviceId;
    public $apnsId;
    public $code;
    public $reason;
    public $body;
    public $duration;
    public $headers;


    public function __construct($responseHeaderAndBody, $code, $duration, $deviceId)
    {
        $this->duration = $duration;
        $this->code = $code;
        $this->deviceId = $deviceId;

        if (preg_match('/^\S+ (\d+)[^\n]*\n(.*?)\r*\n\r*\n(.*)$/s', $responseHeaderAndBody, $m)) {
            $this->code = intval($m[1]);

            $this->headers = [];
            foreach (explode("\n", trim($m[2])) as $line) {
                $line = trim($line);
                if (!$line) {
                    continue;
                }
                $kv = explode(":", $line);
                if (count($kv) <= 1) {
                    continue;
                }
                $this->headers[trim($kv[0])] = trim($kv[1]);
            }

            if (isset($this->headers['apns-id'])) {
                $this->apnsId = $this->headers['apns-id'];
            }


            $body = trim($m[3]);
            if ($body) {
                $this->body = json_decode($body);
                $this->reason = isset($this->body) ? $this->body->reason : '';
            }
        }
    }
}