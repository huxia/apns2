<?php
namespace Apns2;

/**
 * Response for sending message to specific device via APNs
 * @see https://developer.apple.com/library/content/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/CommunicatingwithAPNs.html#//apple_ref/doc/uid/TP40008194-CH11-SW17
 * @package Apns2
 */
class Response{
    public $device_id;
    public $code;
    public $status;
    public $duration;
}