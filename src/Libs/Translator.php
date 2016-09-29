<?php
namespace Astrotomic\Laravel\Translation\Libs;

use Symfony\Component\Translation\Loader\PoFileLoader;
use Symfony\Component\Translation\Translator as SymfonyTranslator;

class Translator
{
    private static $instance;

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = self::createInstance();
        }
        return self::$instance;
    }

    protected static function createInstance()
    {
        if (config('app.debug') && !config('trans.cache_on_debug')) {
            \Cache::forget('po_cache');
        }

        return \Cache::rememberForever('po_cache', function () {
            $basePath = config('trans.translations_path');
            $locales = config('trans.supported_locales');

            $translator = new SymfonyTranslator(config('app.locale'));
            $translator->addLoader('po', new PoFileLoader());
            $translator->setFallbackLocales([config('app.locale')]);
            foreach ($locales as $locale) {
                $path = base_path($basePath . DIRECTORY_SEPARATOR . $locale . DIRECTORY_SEPARATOR . 'LC_MESSAGES');
                $file = $path . DIRECTORY_SEPARATOR . 'messages.po';
                if (file_exists($file)) {
                    $translator->addResource('po', $file, $locale);
                    $translator->getCatalogue($locale);
                }
            }
            return $translator;
        });
    }
}