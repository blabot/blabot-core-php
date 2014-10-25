<?php


namespace TomasKuba\Blabot\Entity;


abstract class LanguageConfig
{
    const LANGUAGE_CZECH = "czech";

    /** @var  string */
    public $language;
    /** @var  array */
    public $badWords = array();
    /** @var  array */
    public $normalizingRules = array();
    /** @var  array */
    public $sentenceDelimiters = array();

}