<?php


namespace TomasKuba\Blabot\Tests;


use TomasKuba\Blabot\Entity\Dictionary;
use TomasKuba\Blabot\Entity\LanguageConfigDummy;
use TomasKuba\Blabot\Entity\LanguageConfig;
use TomasKuba\Blabot\Entity\WritableDictionarySpy;
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

    /**
     * @test
     */
    public function givenByRulesReturnsNormalizedText()
    {
        $text = "Příliš \nžluťoučký  kůň , pěl příšerné ódy...";
        $rules = array(
            array("/\.\.\./u","."),
            array("/[\n\t\r]/u"," "),
            array("/ , /u",", "),
            array("/\s+/u"," "),
        );
        $expect = "Příliš žluťoučký kůň, pěl příšerné ódy.";

        $this->assertEquals($expect, $this->p->normalizeText($text, $rules));
    }

    /**
     * @test
     */
    public function givenNoneReturnsWritableDictionaryInstance()
    {
        $this->assertInstanceOf('TomasKuba\Blabot\Entity\WritableDictionaryInterface', $this->p->getDictionary());
    }

    /**
     * @test
     */
    public function takesAndReturnsCustomWritableDictionaryInstance()
    {
        $d = new Dictionary();
        $d->addWord("Word");
        $d->addSentence("<4>!");

        $this->p->setDictionary($d);

        $this->assertEquals($d, $this->p->getDictionary());
    }

    /**
     * @test
     */
    public function stripBadWordsFromText()
    {
        $text = "Toto je KURVA vlastně doprdele slušný text pÍČo!";
        $badWords = array ("kurv", "píč", "prdel");
        $expect = "Toto je vlastně slušný text!";

        $this->assertEquals($expect, $this->p->stripBadWords($text, $badWords));
    }
    
    /**
     * @test
     */
    public function givenTextExtractsWordsInWritableDictionary()
    {
        $text = "Á bb, ččč ďďďď - ěéĚÉě!";

        $this->p->setDictionary(new WritableDictionarySpy());
        $this->p->extractWords($text);
        /** @var WritableDictionarySpy $dSpy */
        $dSpy = $this->p->getDictionary();
        $expects = "addWord: á\n".
            "addWord: bb\n".
            "addWord: ččč\n".
            "addWord: ďďďď\n".
            "addWord: ěéěéě";

        $this->assertEquals($expects, $dSpy->getLog());
    }

    /**
     * @test
     */
    public function givenTextExtractsWordsReturnsWordLessText()
    {
        $text = "Á bb, ččč ďďďď - ěéĚÉě!";
        $expect = "<1> <2>, <3> <4> - <5>!";

        $this->p->setDictionary(new WritableDictionarySpy());
        $wordLessText = $this->p->extractWords($text);

        $this->assertEquals($expect, $wordLessText);
    }
}
 