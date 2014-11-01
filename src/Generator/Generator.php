<?php


namespace TomasKuba\Blabot\Generator;


use TomasKuba\Blabot\Dictionary\ReadableDictionaryInterface;

class Generator
{
    /** @var \TomasKuba\Blabot\Dictionary\Dictionary */
    private $dictionary;

    /**
     * @param ReadableDictionaryInterface $source
     */
    function __construct(ReadableDictionaryInterface $source)
    {
        $this->dictionary = $source;
    }

    /**
     * @return string
     */
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

    /**
     * @param array $matches
     * @return string
     */
    private function replaceWordToken($matches)
    {
        return $this->dictionary->getWordOfLength((int)$matches[1]);
    }

    /**
     * @param string $string
     * @return string
     */
    private function UpperCaseFirst($string)
    {
        $length = mb_strlen($string);
        $head = mb_substr($string, 0, 1);
        $tail = mb_substr($string, 1, $length - 1);

        return mb_strtoupper($head) . $tail;
    }
}