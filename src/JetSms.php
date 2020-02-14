<?php

namespace Hsntngr\JetSms;


use GuzzleHttp\Client;
use Hsntngr\JetSms\Exceptions\MessageNotFound;
use Hsntngr\JetSms\Exceptions\RecieverNotFound;
use Hsntngr\JetSms\Exceptions\ApiCredentialsNotValid;

class JetSms
{
    protected $to = [];

    protected $message = [];

    public static function create()
    {
        return new static();
    }

    /**
     * @param $no
     * @return JetSms
     */
    public function to($no): JetSms
    {
        if (is_string($no)) {
            array_push($this->to, $no);
        }

        if (is_object($no)) {
            array_push($this->to, (string) $no);
        }

        if (is_array($no)) {
            $this->to = array_merge($this->to, $no);
        }

        return $this;
    }

    /**
     * @param $msg
     * @return JetSms
     */
    public function message($msg): JetSms
    {
        if (is_string($msg)) {
            array_push($this->message, $msg);
        }

        if (is_object($msg)) {
            array_push($this->message, (string)$msg);
        }

        if (is_array($msg)) {
            $this->message = array_merge($this->message, $msg);
        }

        return $this;
    }

    public function send(RegularSms $sms = null)
    {
        $sms && $sms->build();

        $username = config('jetsms.auth.username');
        $password = config('jetsms.auth.password');
        $originator = config('jetsms.auth.originator');

        if (!$username or !$password) {
            throw new ApiCredentialsNotValid();
        }

        if (empty(optional($sms)->getReceivers()) && empty($this->to)) {
            throw new RecieverNotFound();
        }

        if (empty(optional($sms)->getMessages()) && empty($this->message)) {
            throw new MessageNotFound();
        }

        $receivers = array_merge(optional($sms)->getReceivers() ?? [], $this->to);
        $messageContents = array_merge(optional($sms)->getMessages() ?? [], $this->message);

        $client   = new Client();
        return $client->post(config('jetsms.endpoint'), [
            'form_params' => [
                'Username' => $username,
                'Password' => $password,
                'Msisdns' => implode('|', $receivers),
                'Messages' => implode('|', $messageContents),
                'TransmissionID' => $originator
            ]
        ]);
    }
}