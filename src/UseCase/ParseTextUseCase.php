<?php


namespace TomasKuba\Blabot\UseCase;


use TomasKuba\Blabot\Boundary\ParseTextResponse;
use TomasKuba\Blabot\Boundary\UseCaseRequestInterface;
use TomasKuba\Blabot\Boundary\UseCaseResponseInterface;

class ParseTextUseCase implements UseCase
{
    /**
     * @param UseCaseRequestInterface $request
     * @return UseCaseResponseInterface;
     */
    public function execute(UseCaseRequestInterface $request)
    {
        $response = new ParseTextResponse();
        return $response;
    }

} 