<?php


namespace TomasKuba\Blabot\UseCase;


interface  UseCase {

    /**
     * @param UseCaseRequestInterface $request
     * @return UseCaseResponseInterface;
     */
    public function execute(UseCaseRequestInterface $request);

}