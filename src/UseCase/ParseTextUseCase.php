<?php


namespace TomasKuba\Blabot\UseCase;


use TomasKuba\Blabot\Boundary\ParseTextResponse;
use TomasKuba\Blabot\Boundary\UseCaseRequestInterface;
use TomasKuba\Blabot\Boundary\UseCaseResponseInterface;
use TomasKuba\Blabot\Entity\CzechConfig;

class ParseTextUseCase implements UseCase
{
    /**
     * @param UseCaseRequestInterface $request
     * @return UseCaseResponseInterface;
     */
    public function execute(UseCaseRequestInterface $request)
    {
        $parser = new Parser(new CzechConfig());
        $response = new ParseTextResponse();
        return $response;
    }

} 