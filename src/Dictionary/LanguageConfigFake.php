<?php


namespace Blabot\Dictionary;


class LanguageConfigFake extends LanguageConfig {

    function __construct()
    {
        $this->language = "Fake";
        $this->normalizingRules = array(
            array("/\.\.\./u","."),
            array("/[\n\t\r]/u"," "),
            array("/ , /u",", "),
            array("/\s+/u"," "),
            array("/^\s+|\s$/u",""),
        );
        $this->badWords = array("kur","píč", "čurá");
        $this->sentenceDelimiters = array(".","?","!");
        $this->specialWordChars = array("'", "—", ".");
    }
}