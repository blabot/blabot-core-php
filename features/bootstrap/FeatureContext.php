<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use TomasKuba\Blabot\UseCase\GenerateBlabolsUseCase;
use TomasKuba\Blabot\UseCase\GenerateBlabolsRequest;
use TomasKuba\Blabot\UseCase\GenerateBlabolsResponse;
use PHPUnit_Framework_Assert as PHPUnit;

class FeatureContext implements Context, SnippetAcceptingContext
{
    /** @var  string */
    private $dictionaryName;

    /** @var  GenerateBlabolsResponse */
    private $output;

    public function __construct()
    {
    }

    /**
     * @Given No Dictionary
     */
    public function noDictionary()
    {
        $this->dictionaryName = null;
    }

    /**
     * @Given Empty Dictionary
     */
    public function emptyDictionary()
    {
        $this->dictionaryName = "";
    }

    /**
     * @When Requested to Generate Blabols
     */
    public function generateBlabols()
    {
        $request = new GenerateBlabolsRequest();
        $request->setDictionaryName($this->dictionaryName);
        $useCase = new GenerateBlabolsUseCase();
        $this->output = $useCase->execute($request);
    }

    /**
     * @Then Gets empty Blabols
     */
    public function getsEmptyBlabols()
    {
        $blabols = $this->output->getBlabols();
        PHPUnit::assertTrue(empty($blabols));
    }
}
