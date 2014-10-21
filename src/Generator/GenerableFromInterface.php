<?php


namespace TomasKuba\Blabot\Generator;


interface GenerableFromInterface {

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