<?php


namespace TomasKuba\Blabot\Parser;


use TomasKuba\Blabot\UseCase\UseCase;
use TomasKuba\Blabot\UseCase\UseCaseRequestInterface;
use TomasKuba\Blabot\UseCase\UseCaseResponseInterface;

class ParseTextUseCase implements UseCase
{
    /**
     * @param UseCaseRequestInterface $request
     * @return \TomasKuba\Blabot\UseCase\UseCaseResponseInterface;
     */
    public function execute(UseCaseRequestInterface $request)
    {
        $parser = new Parser(new CzechConfig());
        $response = new ParseTextResponse();
        return $response;
    }

} 