<?php


namespace TomasKuba\Blabot\UseCase;


use TomasKuba\Blabot\Entity\Dictionary;
use TomasKuba\Blabot\Entity\LanguageConfig;
use TomasKuba\Blabot\Entity\WritableDictionaryInterface;

class Parser
{
    /** @var LanguageConfig */
    private $config;

    /** @var WritableDictionaryInterface */
    private $dictionary;

    function __construct(LanguageConfig $config)
    {
        $this->config = $config;
        $this->dictionary = new Dictionary();
    }

    public function getLanguage()
    {
        return $this->config->language;
    }

    public function normalizeText($text, $rules)
    {
        $this->validateNormalizingRules($rules);
        foreach ($rules as $rule) {
            $text = preg_replace($rule[0], $rule[1], $text);
        }

        return $text;
    }

    /**
     * @param $rules
     */
    private function validateNormalizingRules($rules)
    {
        foreach ($rules as $rule) {
            if (count($rule) != 2) {
                throw new \InvalidArgumentException("Rule must consist of RegEx pattern and replace sting.");
            }
            $trackErrorsState = @ini_get('track_errors');
            @ini_set('track_errors', 'on');
            $php_errormsg = '';
            @preg_match($rule[0], $rule[1]);
            if ($php_errormsg) {
                throw new \InvalidArgumentException("Invalid RegEx pattern '" . $rule[0] . "'");
            }
            @ini_set('track_errors', $trackErrorsState);
        }
    }

    public function getDictionary()
    {
        return $this->dictionary;
    }

    public function setDictionary(WritableDictionaryInterface $dictionary)
    {
        $this->dictionary =  $dictionary;
    }

    public function stripBadWords($text, $badWords)
    {
        foreach ($badWords as $badWord) {
            $text = preg_replace('/ \w*'. $badWord.'\w*/ui', '', $text);
        }

        return $text;
    }

    public function extractWords($text, $specialChars = array())
    {
        $pattern = "\w+";
        if (!empty($specialChars)){
            $pattern = "\w+[". preg_quote(join('', $specialChars)) . "]\w+|" . $pattern;
        }
        $pattern = "/" . $pattern . "/ui";
        return preg_replace_callback($pattern, array($this, 'extractWordsCallback'), $text);
    }

    private function extractWordsCallback($matches)
    {
        $word = $matches[0];
        $this->dictionary->addWord(mb_strtolower($word));
        return "<" . mb_strlen($word) . ">";
    }

    public function splitInSentences($text, array $delimiters)
    {
        $dg = join('', $delimiters);
        $pattern = '/[^' . $dg . ']+[' . $dg . ']/u';
        preg_replace_callback($pattern, array($this, 'splitInSentencesCallback'), trim($text));
    }

    private function splitInSentencesCallback($matches)
    {
        $this->dictionary->addSentence(trim($matches[0]));
    }

    public function parse($text)
    {
        $normalizedText = $this->normalizeText($text, $this->config->normalizingRules);
        $politeText = $this->stripBadWords($normalizedText, $this->config->badWords);
        $wordLessText = $this->extractWords($politeText, $this->config->specialWordChars);
        $this->splitInSentences($wordLessText, $this->config->sentenceDelimiters);
    }
} 