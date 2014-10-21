<?php


namespace TomasKuba\Blabot\UseCase;


class GenerateBlabolsResponse implements UseCaseResponse{

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