<?php

if (!function_exists('_n')) {
    function _n($msgid1, $msgid2, $n)
    {
        return $n > 1 ? __($msgid2) : __($msgid1);
    }
}

if (!function_exists('__')) {
    function __($message, $arguments = [], $locale = null)
    {
        if (is_null($locale)) {
            $locale = \App::getLocale();
        }
        $trans = \Astrotomic\Laravel\Translation\Libs\Translator::getInstance()->trans($message, [], null, $locale);
        $trans = empty($trans) ? $message : $trans;
        $trans = count($arguments) ? vsprintf($trans, $arguments) : $trans;

        return $trans;
    }
}
