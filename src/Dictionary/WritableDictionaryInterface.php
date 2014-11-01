<?php


namespace TomasKuba\Blabot\Dictionary;


interface WritableDictionaryInterface {

    /**
     * @param string $word
     */
    public function addWord($word);

    /**
     * @param string $sentence
     */
    public function addSentence($sentence);

    /**
     * @param array $sentences
     */
    public function addSentences($sentences);
} 