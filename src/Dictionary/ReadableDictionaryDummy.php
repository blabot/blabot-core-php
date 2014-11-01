<?php


namespace TomasKuba\Blabot\Dictionary;


class ReadableDictionaryDummy implements ReadableDictionaryInterface
{
    /**
     * @param int $length
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