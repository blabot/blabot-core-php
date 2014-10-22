<?php


namespace TomasKuba\Blabot\UseCase;


use TomasKuba\Blabot\Boundary\UseCaseRequestInterface;
use TomasKuba\Blabot\Boundary\UseCaseResponseInterface;

abstract class UseCase {

    /**
     * @param UseCaseRequestInterface $request
     * @return UseCaseResponseInterface;
     */
    abstract public function execute(UseCaseRequestInterface $request);

}