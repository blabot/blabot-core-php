<?php


namespace TomasKuba\Blabot\UseCase;


class GenerateBlabolsRequest implements UseCaseRequest {

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