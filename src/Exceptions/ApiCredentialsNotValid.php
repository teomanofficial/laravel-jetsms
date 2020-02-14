<?php


namespace Hsntngr\JetSms\Exceptions;


use Throwable;

class ApiCredentialsNotValid extends \Exception
{
    public function __construct()
    {
        $message = 'Jet sms api kullanıcı bilgileri bulunamadı';

        parent::__construct($message, 0, null);
    }
}