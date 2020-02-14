<?php


namespace Hsntngr\JetSms\Exceptions;


class MessageNotFound extends \Exception
{
    public function __construct()
    {
        $message = 'Sms içeriği boş bırakılamaz.';

        parent::__construct($message, 0, null);
    }
}