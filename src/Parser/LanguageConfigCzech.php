<?php


namespace Blabot\Parser;


class LanguageConfigCzech extends LanguageConfig
{

    function __construct()
    {
        $this->language = LanguageConfig::LANGUAGE_CZECH;
        $this->normalizingRules = array(
            array("/[\n\r]/u"," "),     // remove new lines
            array('/[°′″„“‚‘"]/u', ''), // strip strange/complicated chars
            array("/\.\.\./u","."),     // change tree dots i one dot
            array("[\t]", " "),         // replace tab by space
            array("/ , /u",", "),       // correct spaces before comas
            array("/\s+/u"," "),        // replace one or more white char by space
            array("/^\s+|\s$/u",""),    // remove leading/trailing spaces
        );
        $this->badWords = array("kur","píč", "čurá", "mrd", "srá");
        $this->sentenceDelimiters = array(".","?","!", "…");
        $this->specialWordChars = array("'", "—", ".");
    }
}