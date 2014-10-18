<?php


namespace TomasKuba\Blabot\UseCase;


use TomasKuba\Blabot\UseCase\GenerateBlabolsResponse;
use TomasKuba\Blabot\UseCase\UseCaseRequest;

class GenerateBlabolsUseCase extends UseCase {

    public function execute(UseCaseRequest $request)
    {
        $response = new GenerateBlabolsResponse();
        return $response;
    }


} 