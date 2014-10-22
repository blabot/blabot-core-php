<?php


namespace TomasKuba\Blabot\Entity;


interface ReadableDictionaryInterface {

    /**
     * @param $length
     * @return string
     */
    public function getWordOfLength($length);

    /**
     * @return string
     */
    public function getSentence();

} 