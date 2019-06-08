<?php


namespace Blabot\Generator;


use Blabot\Context;

class GenerateBlabolsUseCase
{

    /**
     * @param GenerateBlabolsRequest $request
     * @return GenerateBlabolsResponse
     */
    public function execute(GenerateBlabolsRequest $request)
    {
        $dictionary = Context::$dictionaryGateway->findDictionaryByName($request->dictionaryName);
        $generator = new Generator($dictionary);
        $response = new GenerateBlabolsResponse();
        $response->blabols = $generator->getSentences($request->sentencesCount);

        return $response;
    }
}