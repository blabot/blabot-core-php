<?php


namespace TomasKuba\Blabot\Parser;



class ParseTextUseCase
{
    /**
     * @param ParseTextRequest $request
     * @return ParseTextResponse
     */
    public function execute(ParseTextRequest $request)
    {
        $parser = new Parser(new CzechConfig());
        $response = new ParseTextResponse();
        return $response;
    }

} 