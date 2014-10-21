<?php


namespace TomasKuba\Blabot\Entity;

use TomasKuba\Blabot\Generator\GenerableFromInterface;

class Dictionary implements GenerableFromInterface {

    /** @var array */
    private $words = array();

    /** @var array */
    private $sentences = array();

    /**
     * return bool
     */
    public function hasWords()
    {
        return !empty($this->words);
    }

    /**
     * return bool
     */
    public function hasSentences()
    {
        return !empty($this->sentences);
    }

    public function addWord($word)
    {
        if (!$this->hasWord($word)) {
            $this->words[mb_strlen($word)][] = $word;
        }
    }

    public function hasWord($word)
    {
        $length = mb_strlen($word);
        return ($this->hasWordGroupOfLength($length) && in_array($word, $this->words[$length]));
    }

    public function addSentence($sentence)
    {
        if (!in_array($sentence, $this->sentences)){
            $this->sentences[] = $sentence;
        }
    }

    public function getWordOfLength($length)
    {
        if (!$this->hasWordGroupOfLength($length)) {
            return "";
        }

        return $this->words[$length][array_rand($this->words[$length])];
    }

    public function countWordsOfLength($length)
    {
        return count($this->words[$length]);
    }

    /**
     * @param $length
     * @return bool
     */
    public function hasWordGroupOfLength($length)
    {
        return array_key_exists($length, $this->words);
    }

    public function countSentences()
    {
        return count($this->sentences);
    }

    public function getSentence()
    {
        if (empty($this->sentences)) {
            return "";
        }

        return $this->sentences[array_rand($this->sentences)];
    }

    public function addSentences($sentences)
    {
        foreach ($sentences as $sentence) {
            $this->addSentence($sentence);
        }

    }
}