<?php


namespace TomasKuba\Blabot\Parser;


use TomasKuba\Blabot\Boundary\UseCaseResponseInterface;

class ParseTextResponse implements UseCaseResponseInterface {
    /** @var  string */
    public $dictionaryName = "";
}