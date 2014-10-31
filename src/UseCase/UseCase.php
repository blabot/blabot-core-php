<?php


namespace TomasKuba\Blabot\UseCase;


use TomasKuba\Blabot\Boundary\UseCaseRequestInterface;
use TomasKuba\Blabot\Boundary\UseCaseResponseInterface;

interface  UseCase {

    /**
     * @param UseCaseRequestInterface $request
     * @return UseCaseResponseInterface;
     */
    public function execute(UseCaseRequestInterface $request);

}