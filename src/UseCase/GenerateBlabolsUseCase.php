<?php


namespace TomasKuba\Blabot\UseCase;


use TomasKuba\Blabot\Boundary\GenerateBlabolsResponse;
use TomasKuba\Blabot\Boundary\UseCaseRequestInterface;
use TomasKuba\Blabot\Context;

class GenerateBlabolsUseCase extends UseCase
{

    public function execute(UseCaseRequestInterface $request)
    {
        $dictionary = Context::getService('gateway')->findDictionaryByName($request->getDictionaryName());
        $generator = new Generator($dictionary);
        $response = new GenerateBlabolsResponse();
        $response->setBlabols($generator->getSentences(1));

        return $response;
    }
}