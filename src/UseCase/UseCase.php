<?php


namespace TomasKuba\Blabot\UseCase;


use TomasKuba\Blabot\UseCase\UseCaseRequest;
use TomasKuba\Blabot\UseCase\UseCaseResponse;

abstract class UseCase {

    /**
     * @param UseCaseRequest $request
     * @return UseCaseResponse;
     */
    abstract public function execute(UseCaseRequest $request);

}