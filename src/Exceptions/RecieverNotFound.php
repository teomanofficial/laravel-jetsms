<?php


namespace Hsntngr\JetSms\Exceptions;


class RecieverNotFound extends \Exception
{
    public function __construct()
    {
        $message = 'Gönderilecek sms için alıcı bilgisi girilmedi';

        parent::__construct($message, 0, null);
    }
}