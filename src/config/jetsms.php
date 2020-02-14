<?php

return [

    // isteğin gönderileceği adres
    // jet sms tarafından api üzerinde versiyon level
    // güncelleme olmadıkça bu adresi değiştirmeyiniz.
    'endpoint' => 'https://api.jetsms.com.tr/SMS-Web/HttpSmsSend',

    // api kullanıcı bilgileri
    'auth' => [
        'username' => 'hsntngr',
        'password' => 'secret',
        'originator' => 'laravel'
    ]
];