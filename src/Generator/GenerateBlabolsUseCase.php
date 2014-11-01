<?php


namespace TomasKuba\Blabot\Generator;


use TomasKuba\Blabot\Context;

class GenerateBlabolsUseCase
{

    public function execute($request)
    {
        $dictionary = Context::$gateway->findDictionaryByName($request->dictionaryName);
        $generator = new Generator($dictionary);
        $response = new GenerateBlabolsResponse();
        $response->blabols = $generator->getSentences(1);

        return $response;
    }
}