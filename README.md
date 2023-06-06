# laravel-jetsms
Laravel ile jetsms üzerinden sms gönderin. 

```php
JetSms::to(905*********)
    ->message('Test')
    ->send();
```

# Kurulum
`composer/json` dosyasındaki `require` içine aşağıdakini ekleyin.

```php
"hsntngr/laravel-jetsms": "dev-master",
```

Sonrasında yine `composer/json` içindeki `repositories` bölümüne aşağıdakini ekleyin. 

```php
{
    "type": "vcs",
    "url": "https://github.com/mtackgz/laravel-jetsms"
}
```

Api bilgilerinizi `config/jetsms.php` içerisinde düzenleyin.

```php
'auth' => [
    'username' => 'hsntngr',
    'password' => 'secret',
    'originator' => 'laravel'
]
```
# Kullanım

Bu kütüphaneyi kullanarak iki farklı şekilde sms gönderebilirsiniz. JetSms laravelin mail yapısı ile benzer bir şekilde çalışır.

`make:jetsms` artisan komutunu kullanarak JetSms oluşturabilirsiniz. Oluşturulan smsler `app/Sms` dizini altında yer almaktadır.

```php
php artisan make:jetsms Welcome
```

Oluşturulan mesajın `build` metodunu kullanarak sms bilgilerini girebilirsiniz.

```php
 public function build()
    {
        return $this
            ->to(905*********)
            ->message('68796 numaralı rezervasyon iptal edildi');
    }
```

Daha sonra oluşturduğunuz bu mesajları JetSms facadesini kullanarak gönderebilirsiniz.

```php
use App\Sms\Welcome;
use Hsntngr\JetSms\Facade\JetSms;


JetSms::send(new Welcome)
```

Alıcı parametresi build metodu içerisinde düzenlenmek zorunda değildir.
JetSms facadesi üzerinden düzenlenebilir. Sms içerisinde girilen numara varsa bu numara da alıcılar arasına dahil edilir.

```php
JetSms::to(905*********)
    ->send(new Welcome)

```

Sms göndermek için sms sınıfı oluşturmak zorunlu değildir. Doğrudan JetSms facadesi üzerinden sms gönderilebilir.

```php
JetSms::to(905*********)
    ->message('Test')
    ->send();
```
