<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use PHPUnit_Framework_Assert as PHPUnit;
use TomasKuba\Blabot\Boundary\GenerateBlabolsRequest;
use TomasKuba\Blabot\Boundary\GenerateBlabolsResponse;
use TomasKuba\Blabot\Boundary\ParseTextRequest;
use TomasKuba\Blabot\Context as BlabotContext;
use TomasKuba\Blabot\Dictionary\Dictionary;
use TomasKuba\Blabot\Gateway\GatewayMock;
use TomasKuba\Blabot\UseCase\GenerateBlabolsUseCase;
use TomasKuba\Blabot\UseCase\ParseTextUseCase;

class FeatureContext implements Context, SnippetAcceptingContext
{
    private $parserConfigLanguage;

    /** @var  string */
    private $dictionaryName;

    /** @var  GenerateBlabolsResponse */
    private $generatorOutput;

    private $parserConfig;
    private $parserInput;
    private $parserOutput;

    public function __construct()
    {
        mb_internal_encoding("UTF-8");
        BlabotContext::$gateway =  new GatewayMock();
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
     * @Given Simple Dictionary
     */
    public function simpleDictionary()
    {
        $this->dictionaryName = 'simple';
    }

    /**
     * @When Requested to Generate Blabols
     */
    public function generateBlabols()
    {
        $request = new GenerateBlabolsRequest();
        $request->setDictionaryName($this->dictionaryName);
        $useCase = new GenerateBlabolsUseCase();
        $this->generatorOutput = $useCase->execute($request);
    }

    /**
     * @Then Gets empty Blabols
     */
    public function getsEmptyBlabols()
    {
        $blabols = $this->generatorOutput->getBlabols();
        PHPUnit::assertTrue(empty($blabols));
    }

    /**
     * @Then Gets simple Blabols
     */
    public function getsSimpleBlabols()
    {
        $expect = array("Á bb, čč'č ďď—ď ěěěěě!");
        $blabols = $this->generatorOutput->getBlabols();

        PHPUnit::assertTrue(!empty($blabols));
        PHPUnit::assertEquals($expect, $blabols);
    }

    /**
     * @Given text of unknown language
     */
    public function textOfUnknownLanguage()
    {
        $this->parserConfigLanguage = "Unknown language";
        $this->parserInput = "Some text in unknown language";
    }

    /**
     * @Given simple Czech text and language name
     */
    public function simpleCzechTextAndLanguageName()
    {
        $this->parserConfigLanguage = 'cZeCH';
        $this->parserInput = "Á bb, čč'č ďď—ď ěěěěě!";
    }

    /**
     * @When parse text
     */
    public function parseText()
    {
        $request = new ParseTextRequest();
        $request->language = $this->parserConfigLanguage;
        $request->text = $this->parserInput;
        $uc = new ParseTextUseCase();
        $this->parserOutput = $uc->execute($request);
    }

    /**
     * @Then creates empty dictionary
     */
    public function createsEmptyDictionary()
    {
        $dictionary = BlabotContext::$gateway->findDictionaryByName($this->parserOutput->dictionaryName);
        PHPUnit::assertEquals(new Dictionary(), $dictionary);
    }

    /**
     * @Then create dictionary
     */
    public function createDictionary()
    {
        throw new PendingException();
    }

}
