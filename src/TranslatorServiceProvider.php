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

        $this->app->singleton('translator.command.view.compile', function($app) {
            return new CompileViews();
        });
        $this->commands('translator.command.view.compile');
        $this->app->singleton('translator.command.trans.po', function($app) {
            return new TranslatorCreatePo();
        });
        $this->commands('translator.command.trans.po');
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