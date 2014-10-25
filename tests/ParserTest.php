<?php


namespace TomasKuba\Blabot\Tests;


use TomasKuba\Blabot\Entity\LanguageConfigDummy;
use TomasKuba\Blabot\Entity\LanguageConfig;
use TomasKuba\Blabot\UseCase\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    /** @var LanguageConfig */
    private $dummyConfig;
    /** @var Parser */
    private $p;

    protected function setUp()
    {
        mb_internal_encoding("UTF-8");
        $this->dummyConfig = new LanguageConfigDummy();
        $this->p = new Parser($this->dummyConfig);
    }

    /**
     * @test
     */
    public function IsInstantiable()
    {
        $p = new Parser($this->dummyConfig);
    }

    /**
     * @test
     */
    public function givenDummyConfigHasDummyLanguage()
    {
        $this->assertEquals("Dummy", $this->p->getLanguage());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function normalizeTextByRulesThrowsOnIncompleteRule()
    {
        $text = "Á  \"bžum\" \t\t \n terum , darum gum...";
        $rules = array(
            array("/[A-Z/ui"), //invalid RegEx
        );

        $this->p->normalizeText($text, $rules);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function normalizeTextByRulesThrowsOnInvalidRegExRule()
    {
        $text = "Á  \"bžum\" \t\t \n terum , darum gum...";
        $rules = array(
            array("/\s+/u"," "),
            array("/[A-Z/ui","x"), //invalid RegEx
        );

        $this->p->normalizeText($text, $rules);
    }

    /**
     * @test
     */
    public function givenNoRulesReturnTextWithoutNormalizing()
    {
        $text = "text\t\n";
        $rules = array();
        $this->assertEquals($text, $this->p->normalizeText($text, $rules));
    }
}
 