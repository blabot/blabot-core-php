<?php


namespace TomasKuba\Blabot\Boundary;


class ParseTextRequest implements UseCaseRequestInterface {
    /** @var  string */
    public $text = "";
    /** @var  string */
    public $language = "";
} 