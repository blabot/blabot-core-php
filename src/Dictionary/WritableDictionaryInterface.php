<?php


namespace Blabot\Dictionary;


interface WritableDictionaryInterface {

    /**
     * @return string
     */
    public function getName();

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