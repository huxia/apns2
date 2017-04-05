<?php
namespace Apns2;

class Message extends BaseDataObject
{
    public $aps;

    public $customData;

    public function __construct($data = [])
    {
        $this->loadFromJSON($data, [
            'aps' => MessageAPSBody::class
        ]);
    }

}