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
     * @param mixed $blabols
     */
    public function setBlabols($blabols)
    {
        $this->blabols = $blabols;
    }

} 