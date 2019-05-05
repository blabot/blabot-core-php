<?php


namespace Blabot\Parser;


class LanguageConfig
{
    const LANGUAGE_CZECH = "czech";

    /** @var string */
    public $language;
    /** @var  array */
    public $badWords = [];
    /** @var  array */
    public $normalizingRules = [];
    /** @var  array */
    public $sentenceDelimiters = [];
    /** @var array */
    public $specialWordChars = [];
}