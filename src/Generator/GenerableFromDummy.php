<?php


namespace TomasKuba\Blabot\Generator;


class GenerableFromDummy implements GenerableFromInterface
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