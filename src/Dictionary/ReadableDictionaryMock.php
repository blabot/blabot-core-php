<?php


namespace Blabot\Dictionary;


class ReadableDictionaryMock implements ReadableDictionaryInterface
{
    /**
     * @param int $length
     * @return string
     */
    public function getWordOfLength($length)
    {
        $words = array(
            1 => "á",
            2 => "bb",
            3 => "čč'č",
            4 => "ďď—ď",
            5 => "ěěěěě",
        );

        if ($length > 5) {
            $length = 5;
        }

        return $words[$length];
    }

    /**
     * @return string
     */
    public function getSentence()
    {
        return "<1> <2>, <3> <4> <5>!";
    }

} 