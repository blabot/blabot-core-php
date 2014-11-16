<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use PHPUnit_Framework_Assert as PHPUnit;
use TomasKuba\Blabot\Context as BlabotContext;
use TomasKuba\Blabot\Dictionary\Dictionary;
use TomasKuba\Blabot\Gateway\DictionaryGatewayMock;
use TomasKuba\Blabot\Generator\GenerateBlabolsRequest;
use TomasKuba\Blabot\Generator\GenerateBlabolsResponse;
use TomasKuba\Blabot\Generator\GenerateBlabolsUseCase;
use TomasKuba\Blabot\Parser\ParseTextRequest;
use TomasKuba\Blabot\Parser\ParseTextUseCase;

class FeatureContext implements Context, SnippetAcceptingContext
{
    private $parserConfigLanguage;

    /** @var  string */
    private $dictionaryName;

    /** @var  \TomasKuba\Blabot\Generator\GenerateBlabolsResponse */
    private $generatorOutput;

    private $parserConfig;
    private $parserInput;
    private $parserOutput;

    public function __construct()
    {
        mb_internal_encoding("UTF-8");
        BlabotContext::$dictionaryGateway =  new DictionaryGatewayMock();
    }

    /**
     * @Given no Dictionary
     */
    public function noDictionary()
    {
        $this->dictionaryName = null;
    }

    /**
     * @Given empty dictionary
     */
    public function emptyDictionary()
    {
        $this->dictionaryName = "";
    }

    /**
     * @Given mock dictionary
     */
    public function mockDictionary()
    {
        $this->dictionaryName = 'ReadableDictionaryMock';
    }

    /**
     * @When requested to generate blabols
     */
    public function generateBlabols()
    {
        $request = new GenerateBlabolsRequest();
        $request->dictionaryName = $this->dictionaryName;
        $useCase = new GenerateBlabolsUseCase();
        $this->generatorOutput = $useCase->execute($request);
    }

    /**
     * @Then gets empty blabols
     */
    public function getsEmptyBlabols()
    {
        $blabols = $this->generatorOutput->blabols;
        PHPUnit::assertTrue(empty($blabols));
    }

    /**
     * @Then gets simple blabols
     */
    public function getsSimpleBlabols()
    {
        $expect = array("Á bb, čč'č ďď—ď ěěěěě!");
        $blabols = $this->generatorOutput->blabols;

        PHPUnit::assertTrue(!empty($blabols));
        PHPUnit::assertEquals($expect, $blabols);
    }

    /**
     * @Given no text of unknown language
     */
    public function noTextOfUnknownLanguage()
    {
        $this->parserConfigLanguage = "Unknown language";
        $this->parserInput = "";
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
        $dictionary = BlabotContext::$dictionaryGateway->findDictionaryByName($this->parserOutput->dictionaryName);
        PHPUnit::assertFalse($dictionary->hasSentences());
        PHPUnit::assertFalse($dictionary->hasWords());
    }

    /**
     * @Then creates non-empty dictionary
     */
    public function createsNonEmptyDictionary()
    {
        $dictionary = BlabotContext::$dictionaryGateway->findDictionaryByName($this->parserOutput->dictionaryName);
        PHPUnit::assertTrue($dictionary->hasSentences());
        PHPUnit::assertTrue($dictionary->hasWords());
    }

}
