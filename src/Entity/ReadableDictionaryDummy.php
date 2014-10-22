<?php


namespace TomasKuba\Blabot\Entity;


class ReadableDictionaryDummy implements ReadableDictionaryInterface
{
    /**
     * @param $length
     * @return string
     */
    public function getWordOfLength($length)
    {
        return "";
    }

    /**
     * @return string
     */
    public function getSentence()
    {
        return "";
    }

} 