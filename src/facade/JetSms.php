<?php

namespace Hsntngr\JetSms\Facade;


class JetSms extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jetsms';
    }
}