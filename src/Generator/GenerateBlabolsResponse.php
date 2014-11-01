<?php


namespace TomasKuba\Blabot\Generator;


use TomasKuba\Blabot\UseCase\UseCaseResponseInterface;

class GenerateBlabolsResponse implements UseCaseResponseInterface{

    private $blabols = array();

    /**
     * @return array
     */
    public function getBlabols()
    {
        return $this->blabols;
    }

    /**
     * @param array $blabols
     */
    public function setBlabols(array $blabols)
    {
        $this->blabols = $blabols;
    }

} 