# laravel-jetsms
Laravel ile jetsms üzerinden sms gönderin. 

```php
JetSms::to(905*********)
    ->message('Test')
    ->send();
```

# Kurulum
Laravel 5.6 ve öncesi sürümler için `config/app.php` dosyasında providers bölümü içine
aşağıda jet sms service provider sınıfını ekleyin.

```php
'providers' => [
   //...
   Hsntngr\JetSms\JetSmsServiceProvider::class,
   //...
]
```

Sonrasında config dosyasını publish edin. 

```php
php artisan vendor:publish --provider="Hsntngr\JetSms\JetSmsServiceProvider" --tag=config
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