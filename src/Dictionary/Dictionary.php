<?php


namespace TomasKuba\Blabot\Dictionary;


class Dictionary implements ReadableDictionaryInterface, WritableDictionaryInterface {

    /** @var array */
    private $words = array();

    /** @var array */
    private $sentences = array();

    /** @var string */
    private $name;

    function __construct()
    {
        $this->name = uniqid(rand(), true);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

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

    /**
     * @param string $word
     */
    public function addWord($word)
    {
        if (!$this->hasWord($word)) {
            $this->words[mb_strlen($word)][] = $word;
        }
    }

    /**
     * @param string $word
     * @return bool
     */
    public function hasWord($word)
    {
        $length = mb_strlen($word);
        return ($this->hasWordGroupOfLength($length) && in_array($word, $this->words[$length]));
    }

    /**
     * @param string $sentence
     */
    public function addSentence($sentence)
    {
        if (!in_array($sentence, $this->sentences)){
            $this->sentences[] = $sentence;
        }
    }

    /**
     * @param int $length
     * @return string
     */
    public function getWordOfLength($length)
    {
        if (!$this->hasWordGroupOfLength($length)) {
            return "";
        }

        return $this->words[$length][array_rand($this->words[$length])];
    }

    /**
     * @param int $length
     * @return int
     */
    public function countWordsOfLength($length)
    {
        return count($this->words[$length]);
    }

    /**
     * @param int $length
     * @return bool
     */
    public function hasWordGroupOfLength($length)
    {
        return array_key_exists($length, $this->words);
    }

    /**
     * @return int
     */
    public function countSentences()
    {
        return count($this->sentences);
    }

    /**
     * @return string
     */
    public function getSentence()
    {
        if (empty($this->sentences)) {
            return "";
        }

        return $this->sentences[array_rand($this->sentences)];
    }

    /**
     * @param array $sentences
     */
    public function addSentences($sentences)
    {
        foreach ($sentences as $sentence) {
            $this->addSentence($sentence);
        }

    }
}