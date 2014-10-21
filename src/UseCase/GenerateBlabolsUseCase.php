<?php


namespace TomasKuba\Blabot\UseCase;


use TomasKuba\Blabot\Generator;
use TomasKuba\Blabot\UseCase\GenerateBlabolsResponse;
use TomasKuba\Blabot\UseCase\UseCaseRequest;
use TomasKuba\Blabot\Context;

class GenerateBlabolsUseCase extends UseCase {

    public function execute(UseCaseRequest $request)
    {
        $dictionary = Context::getService('gateway')->findDictionaryByName($request->getDictionaryName());
        $generator = new Generator($dictionary);
        $response = new GenerateBlabolsResponse();
        return $response;
    }
}