<?php


namespace TomasKuba\Blabot\Boundary;


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