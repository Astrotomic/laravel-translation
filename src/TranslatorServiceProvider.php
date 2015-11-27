<?php
namespace Gummibeer\Laravel\Translation;

use Gummibeer\Laravel\Translation\Commands\CompileViews;
use Gummibeer\Laravel\Translation\Commands\TranslatorCreatePo;
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

        $this->commands([
            TranslatorCreatePo::class,
            CompileViews::class,
        ]);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('trans.php'),
        ]);
    }

    public function provides()
    {
        return [
            'translator',
            'translator.command.view.compile',
            'translator.command.trans.po',
        ];
    }
}