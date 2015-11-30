# Laravel Translation

This is a laravel wrapper for the Symfony PoTranslator. It comes with two global helper functions `__()` and `_n()`.

## Installation

**composer.json** `"gummibeer/laravel-translation": "dev-master"`

**config/app.php**

```
return [
    ...
    'providers' => [
        Gummibeer\Laravel\Translation\TranslatorServiceProvider::class,
    ],
    ...
    'aliases' => [
        'Trans' => Gummibeer\Laravel\Translation\Facades\TranslatorFacade::class,
    ],
    ...
];
```

**console**

```
composer update
artisan vendor:publish
```

## Usage

To generate the po files you first have to compile all your views, PoEdit can't handle blade, to do this use the artisan command `artisan view:compile`. After this you can generate the po files and the proper header with `artisan trans:po`. To collect and translate all the strings use PoEdit.