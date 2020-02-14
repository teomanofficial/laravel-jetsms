<?php

namespace Hsntngr\JetSms\Commands;

use Illuminate\Console\GeneratorCommand;

class JetSmsMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:jetsms {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'JetSms sınıfı oluşturur';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'JetSms';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/jetsms.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Sms';
    }
}
