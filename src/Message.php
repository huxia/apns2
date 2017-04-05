<?php
namespace Huxia\Apns2;

class Message extends BaseDataObject
{
    public $aps;

    public function __construct($data = [])
    {
        $this->loadFromJSON($data, [
            'aps' => MessageAPSBody::class
        ]);
    }

}