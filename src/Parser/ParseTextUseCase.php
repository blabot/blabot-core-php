<?php


namespace Blabot\Parser;



use Blabot\Context;

class ParseTextUseCase
{
    /**
     * @param ParseTextRequest $request
     * @return ParseTextResponse
     */
    public function execute(ParseTextRequest $request)
    {
        $gateway = Context::$dictionaryGateway;
        $dictionary = $gateway->findDictionaryByName($request->dictionaryName);

        $parser = new Parser(new CzechConfig());
        $parser->setDictionary($dictionary);
        $parser->parse($request->text);
        $dictionary = $parser->getDictionary();

        $gateway->save($dictionary);

        $response = new ParseTextResponse();
        $response->dictionaryName = $dictionary->getName();

        return $response;
    }

} 