<?php


namespace TomasKuba\Blabot\Dictionary;


class WritableDictionarySpy implements WritableDictionaryInterface {

    private $log = '';

    public function getName(){
        return "WritableDictionarySpy";
    }

    /**
     * @param string $word
     */
    public function addWord($word)
    {
        $this->log .= "addWord: " . $word . "\n";
    }

    /**
     * @param string $sentence
     */
    public function addSentence($sentence)
    {
        $this->log .= "addSentence: " . $sentence . "\n";
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

    public function getLog(){
        return trim($this->log);
    }
} 