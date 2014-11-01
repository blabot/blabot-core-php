<?php


namespace TomasKuba\Blabot\Generator;


use TomasKuba\Blabot\UseCase\UseCaseRequestInterface;

class GenerateBlabolsRequest implements UseCaseRequestInterface {

    private $dictionaryName;

    /**
     * @return string
     */
    public function getDictionaryName()
    {
        return $this->dictionaryName;
    }

    /**
     * @param string $dictionaryName
     */
    public function setDictionaryName($dictionaryName)
    {
        $this->dictionaryName = $dictionaryName;
    }
} 