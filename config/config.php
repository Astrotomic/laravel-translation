<?php

return [
    // Details for the PO file header
    'po' => [
        'project' => 'TranslationProject',
        'translator' => 'Gummibeer <dev.gummibeer@gmail.com>',
        'charset' => 'UTF-8',
        'keywords_list' => [
            '_',
            '__',
            '_n',
        ],
    ],

    // A list of all the locales your application supports
    'supported_locales' => [
        'de_DE',
        'en_US',
    ],

    // The base path where the po files are located - starting from the app root folder
    'translations_path' => 'resources/lang/i18n',

    // The path where the compiled views should be stored - starting from the storage folder
    'view_store_path' => 'framework/views/php',

    // The path where the blade views are located - starting from the app root folder
    'view_blade_path' => 'resources/views',

    // The paths from where all files should be searched for translatable texts - starting from the app root folder
    'source_paths' => [
        'app/Http/Controllers',
        'app/Console/Commands',
        'resources/views',
        'storage/framework/views/php',
    ],
];