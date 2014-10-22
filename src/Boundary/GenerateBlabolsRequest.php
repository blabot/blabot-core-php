<?php


namespace TomasKuba\Blabot\Boundary;


class GenerateBlabolsRequest implements UseCaseRequestInterface {

    private $dictionaryName;

    /**
     * @return mixed
     */
    public function getDictionaryName()
    {
        return $this->dictionaryName;
    }

    /**
     * @param mixed $dictionaryName
     */
    public function setDictionaryName($dictionaryName)
    {
        $this->dictionaryName = $dictionaryName;
    }
} 