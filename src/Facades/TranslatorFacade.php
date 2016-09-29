<?php

namespace Gummibeer\Laravel\Translation\Facades;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class TranslatorFacade extends IlluminateFacade
{
    protected static function getFacadeAccessor()
    {
        return 'gummibeer.translator';
    }
}
