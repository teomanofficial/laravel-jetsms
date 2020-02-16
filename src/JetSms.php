<?php

namespace Hsntngr\JetSms;


use GuzzleHttp\Client;
use Hsntngr\JetSms\Exceptions\MessageNotFound;
use Hsntngr\JetSms\Exceptions\RecieverNotFound;
use Hsntngr\JetSms\Exceptions\ApiCredentialsNotValid;

class JetSms
{
    /**
     * Alıcılar
     * @var array
     */
    protected $to = [];

    /**
     * Mesajlar
     * @var array
     */
    protected $message = [];

    /**
     * JetSms örneği oluştur
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * Gönderilecek Kişi - Kişiler
     * @param $no
     * @return JetSms
     */
    public function to($no): JetSms
    {
        if (is_string($no)) {
            array_push($this->to, $no);
        }

        if (is_object($no)) {
            if ($no instanceof \ArrayAccess) {
                $this->to = array_merge($this->to,  (array) $no);
            } else {
                array_push($this->to, (string) $no);
            }
        }

        if (is_array($no)) {
            $this->to = array_merge($this->to, $no);
        }

        return $this;
    }

    /**
     * Gönderilecek Mesaj
     * @param $msg
     * @return JetSms
     */
    public function message($msg): JetSms
    {
        if (is_string($msg)) {
            array_push($this->message, $msg);
        }

        if (is_object($msg)) {
            array_push($this->message, (string) $msg);
        }

        if (is_array($msg)) {
            $this->message = array_merge($this->message, $msg);
        }

        return $this;
    }

    /**
     * Mesajı Gönder
     * Gönderme işlemi için RegularSms
     * zorunlu değildir. Doğrudan kişi ve
     * mesaj bilgileri girilerek mesaj
     * gönderilebilir. Her mesaj için
     * Ayrı sms oluşturmak gerekmez.
     *
     * @param RegularSms|null $sms
     * @return \Psr\Http\Message\ResponseInterface
     * @throws ApiCredentialsNotValid
     * @throws MessageNotFound
     * @throws RecieverNotFound
     */
    public function send(RegularSms $sms = null)
    {
        $sms && $sms->build();

        $username = config('jetsms.auth.username');
        $password = config('jetsms.auth.password');
        $originator = config('jetsms.auth.originator');

        // api kullanıcı bilgilerinin girildiğini doğrula
        if (!$username or !$password) {
            throw new ApiCredentialsNotValid();
        }

        $receivers = array_merge(optional($sms)->getReceivers() ?? [], $this->to);

        // en az bir alıcı girildiğini doğrula
        if (empty($receivers)) {
            throw new RecieverNotFound();
        }

        $messageContents = array_merge(optional($sms)->getMessages() ?? [], $this->message);

        // en az bir mesaj girildiğini doğrula
        if (empty($messageContents)) {
            throw new MessageNotFound();
        }

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