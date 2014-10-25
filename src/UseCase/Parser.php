<?php


namespace TomasKuba\Blabot\UseCase;


use TomasKuba\Blabot\Entity\LanguageConfig;

class Parser
{
    /** @var LanguageConfig */
    private $config;

    function __construct(LanguageConfig $config)
    {
        $this->config = $config;
    }

    public function getLanguage()
    {
        return $this->config->language;
    }

    public function normalizeText($text, $rules)
    {
        $this->validateNormalizingRules($rules);

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


} 