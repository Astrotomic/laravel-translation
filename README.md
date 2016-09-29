# Laravel Translation

[![GitHub Author](https://img.shields.io/badge/author-@astrotomic-orange.svg?style=flat-square)](https://github.com/Astrotomic)
[![GitHub release](https://img.shields.io/github/release/astrotomic/laravel-translation.svg?style=flat-square)](https://github.com/Astrotomic/laravel-translation/releases)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://raw.githubusercontent.com/Astrotomic/laravel-translation/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/Astrotomic/laravel-translation.svg?style=flat-square)](https://github.com/Astrotomic/laravel-translation/issues)

[![Travis branch](https://img.shields.io/travis/Astrotomic/laravel-translation/master.svg?style=flat-square)](https://travis-ci.org/Astrotomic/laravel-translation/branches)
[![StyleCI](https://styleci.io/repos/46973484/shield)](https://styleci.io/repos/46973484)
[![Code Climate](https://img.shields.io/codeclimate/github/Astrotomic/laravel-translation.svg?style=flat-square)](https://codeclimate.com/github/Astrotomic/laravel-translation)
[![Code Climate](https://img.shields.io/codeclimate/coverage/github/Astrotomic/laravel-translation.svg?style=flat-square)](https://codeclimate.com/github/Astrotomic/laravel-translation/coverage)
[![Code Climate](https://img.shields.io/codeclimate/issues/github/Astrotomic/laravel-translation.svg?style=flat-square)](https://codeclimate.com/github/Astrotomic/laravel-translation/issues)

This is a laravel wrapper for the Symfony PoTranslator. It comes with two global helper functions `__()` and `_n()`.

## Installation

**composer.json** `"astrotomic/laravel-translation": "dev-master"`

**config/app.php**

```
return [
    ...
    'providers' => [
        Astrotomic\Laravel\Translation\TranslatorServiceProvider::class,
    ],
    ...
    'aliases' => [
        'Trans' => Astrotomic\Laravel\Translation\Facades\TranslatorFacade::class,
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