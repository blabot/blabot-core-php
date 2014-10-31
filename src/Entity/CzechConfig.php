<?php


namespace TomasKuba\Blabot\Entity;


class CzechConfig extends LanguageConfig
{

    function __construct()
    {
        $this->language = LanguageConfig::LANGUAGE_CZECH;
        $this->sentenceDelimiters = array(".","?","!");

    }
}