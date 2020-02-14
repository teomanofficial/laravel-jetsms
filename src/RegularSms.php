<?php

namespace Hsntngr\JetSms;


class RegularSms
{
    protected $to = [];

    protected $message = [];

    protected $title;

    public static function create()
    {
        return new static();
    }

    /**
     * @param string $title
     * @return RegularSms
     */
    public function title(string $title): RegularSms
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param $no mixed
     * @return RegularSms
     */
    public function to($no): RegularSms
    {
        if (is_string($no)) {
            array_push($this->to, $no);
        }

        if (is_object($no)) {
            array_push($this->to, (string)$no);
        }

        if (is_array($no)) {
            $this->to = array_merge($this->to, $no);
        }

        return $this;
    }

    /**
     * @param $msg
     * @return RegularSms
     */
    public function message($msg): RegularSms
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

    /**
     * @return array
     */
    public function getReceivers(): array
    {
        return $this->to;
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function build()
    {
        return $this;
    }
}