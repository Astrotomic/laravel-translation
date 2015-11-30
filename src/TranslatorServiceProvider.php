<?php
namespace Gummibeer\Laravel\Translation;

use Gummibeer\Laravel\Translation\Commands\CompileViews;
use Gummibeer\Laravel\Translation\Commands\TranslatorCreatePo;
use Gummibeer\Laravel\Translation\Libs\Translator;
use Illuminate\Support\ServiceProvider;

class TranslatorServiceProvider extends ServiceProvider
{
    protected $configPath =  __DIR__ . '/../config/config.php';

    public function register()
    {
        $this->mergeConfigFrom($this->configPath, 'trans');

        $this->app->singleton('gummibeer.translator', function ($app) {
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
            'gummibeer.translator',
        ];
    }
}