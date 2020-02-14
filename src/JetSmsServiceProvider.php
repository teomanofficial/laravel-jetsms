<?php

namespace Hsntngr\JetSms;


use Illuminate\Support\ServiceProvider;
use Hsntngr\JetSms\Commands\JetSmsMakeCommand;

class JetSmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                JetSmsMakeCommand::class
            ]);
        }

        $this->publishes([
            __DIR__.'/config/jetsms.php' => config_path('jetsms.php')
        ], 'config');
    }

    /**
     * Register Jet Sms Services
     */
    public function register()
    {
        $this->app->bind('jetsms', JetSms::class);
    }
}