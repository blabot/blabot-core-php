<?php


namespace TomasKuba\Blabot\Boundary;


class GenerateBlabolsResponse implements UseCaseResponseInterface{

    private $blabols;

    /**
     * @return mixed
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