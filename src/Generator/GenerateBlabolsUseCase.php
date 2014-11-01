<?php


namespace TomasKuba\Blabot\Generator;


use TomasKuba\Blabot\Context;

class GenerateBlabolsUseCase
{

    /**
     * @param GenerateBlabolsRequest $request
     * @return GenerateBlabolsResponse
     */
    public function execute(GenerateBlabolsRequest $request)
    {
        $dictionary = Context::$gateway->findDictionaryByName($request->dictionaryName);
        $generator = new Generator($dictionary);
        $response = new GenerateBlabolsResponse();
        $response->blabols = $generator->getSentences(1);

        return $response;
    }
}