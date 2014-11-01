<?php


namespace TomasKuba\Blabot\Parser;


use TomasKuba\Blabot\Boundary\UseCaseRequestInterface;

class ParseTextRequest implements UseCaseRequestInterface {
    /** @var  string */
    public $text = "";
    /** @var  string */
    public $language = "";
} 