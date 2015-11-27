<?php
namespace Gummibeer\Laravel\Translation;

use Gummibeer\Laravel\Translation\Libs\Translator;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Translation\Translator as SymfonyTranslator;

class TranslatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SymfonyTranslator::class, function ($app) {
            return Translator::getInstance();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/graylog2.php' => config_path('trans.php'),
        ]);
    }

    public function provides()
    {
        return [
            'translator',
        ];
    }
}