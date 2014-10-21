<?php


namespace TomasKuba\Blabot\Generator;


use TomasKuba\Blabot\Entity\Dictionary;

class Generator
{
    /** @var Dictionary */
    private $dictionary;

    function __construct(GenerableFromInterface $source)
    {
        $this->dictionary = $source;
    }

    public function getSentence()
    {
        $protoSentence = $this->dictionary->getSentence();
        $sentence = preg_replace_callback("/<(\d)>/u", array($this, "replaceWordToken"), $protoSentence);
        return $this->UpperCaseFirst($sentence);
    }

    /**
     * @param int $count
     * @return array
     */
    public function getSentences($count)
    {
        $sentences = array();
        for (; $count > 0; $count--) {
            $sentence = $this->getSentence();
            if (!empty($sentence)){
                $sentences[] = $sentence;
            }
        }

        return $sentences;
    }

    private function replaceWordToken($matches)
    {
        return $this->dictionary->getWordOfLength((int)$matches[1]);
    }

    private function UpperCaseFirst($string)
    {
        $length = mb_strlen($string);
        $head = mb_substr($string, 0, 1);
        $tail = mb_substr($string, 1, $length - 1);

        return mb_strtoupper($head) . $tail;
    }
}