<?php


namespace TomasKuba\Blabot\Parser;


use TomasKuba\Blabot\UseCase\UseCaseResponseInterface;

class ParseTextResponse implements UseCaseResponseInterface {
    /** @var  string */
    public $dictionaryName = "";
}