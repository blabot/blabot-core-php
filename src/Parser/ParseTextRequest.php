<?php


namespace TomasKuba\Blabot\Parser;


use TomasKuba\Blabot\UseCase\UseCaseRequestInterface;

class ParseTextRequest implements UseCaseRequestInterface {
    /** @var  string */
    public $text = "";
    /** @var  string */
    public $language = "";
} 