<?php


namespace TomasKuba\Blabot\Dictionary;


interface ReadableDictionaryInterface {

    /**
     * @param int $length
     * @return string
     */
    public function getWordOfLength($length);

    /**
     * @return string
     */
    public function getSentence();

} 