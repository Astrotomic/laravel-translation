<?php
namespace Astrotomic\Laravel\Translation;

use Astrotomic\Laravel\Translation\Commands\CompileViews;
use Astrotomic\Laravel\Translation\Commands\TranslatorCreatePo;
use Astrotomic\Laravel\Translation\Libs\Translator;
use Illuminate\Support\ServiceProvider;

class TranslatorServiceProvider extends ServiceProvider
{
    protected $configPath =  __DIR__ . '/../config/config.php';

    public function register()
    {
        $this->mergeConfigFrom($this->configPath, 'trans');

        $this->app->singleton('astrotomic.translator', function ($app) {
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
            $this->configPath => config_path('trans.php'),
        ]);
    }

    public function provides()
    {
        return [
            'astrotomic.translator',
        ];
    }
}