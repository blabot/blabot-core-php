<?php


namespace TomasKuba\Blabot\Parser;


class CzechConfig extends LanguageConfig
{

    function __construct()
    {
        $this->language = LanguageConfig::LANGUAGE_CZECH;
        $this->sentenceDelimiters = array(".","?","!");

    }
}