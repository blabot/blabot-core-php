<?php
declare(strict_types=1);

namespace TomasKuba\Blabot\Parser;

use PHPUnit\Framework\TestCase;
use TomasKuba\Blabot\Dictionary\Dictionary;
use TomasKuba\Blabot\Dictionary\WritableDictionarySpy;

class ParserTest extends TestCase
{
    /** @var \TomasKuba\Blabot\Parser\LanguageConfig */
    private $fakeConfig;
    /** @var Parser */
    private $p;

    protected function setUp()
    {
        mb_internal_encoding("UTF-8");
        $this->fakeConfig = new LanguageConfigFake();
        $this->p = new Parser($this->fakeConfig);
    }

    /**
     * @test
     */
    public function givenDummyConfigHasDummyLanguage()
    {
        $this->assertEquals("Fake", $this->p->getLanguage());
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
            array("/\s+/u", " "),
            array("/[A-Z/ui", "x"), //invalid RegEx
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
            array("/\.\.\./u", "."),
            array("/[\n\t\r]/u", " "),
            array("/ , /u", ", "),
            array("/\s+/u", " "),
        );
        $expect = "Příliš žluťoučký kůň, pěl příšerné ódy.";

        $this->assertEquals($expect, $this->p->normalizeText($text, $rules));
    }

    /**
     * @test
     */
    public function givenNoneReturnsWritableDictionaryInstance()
    {
        $this->assertInstanceOf('TomasKuba\Blabot\Dictionary\WritableDictionaryInterface', $this->p->getDictionary());
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
        $badWords = array("kurv", "píč", "prdel");
        $expect = "Toto je vlastně slušný text!";

        $this->assertEquals($expect, $this->p->stripBadWords($text, $badWords));
    }

    /**
     * @test
     */
    public function givenTextExtractsWordsInWritableDictionary()
    {
        $text = "Á bb, ččč ďďďď - ěéĚÉě!";
        $expects = "addWord: á\n" .
            "addWord: bb\n" .
            "addWord: ččč\n" .
            "addWord: ďďďď\n" .
            "addWord: ěéěéě";

        $this->p->setDictionary(new WritableDictionarySpy());
        $this->p->extractWords($text);
        /** @var WritableDictionarySpy $dSpy */
        $dSpy = $this->p->getDictionary();

        $this->assertEquals($expects, $dSpy->getLog());
    }

    /**
     * @test
     */
    public function givenTextExtractsWordsInWritableDictionaryIncludingSpecialCharacters()
    {
        $text = "Á bb, č'č ďď—ď - ěéĚ.Éě!";
        $expects = "addWord: á\n" .
            "addWord: bb\n" .
            "addWord: č'č\n" .
            "addWord: ďď—ď\n" .
            "addWord: ěéě.éě";

        $this->p->setDictionary(new WritableDictionarySpy());
        $this->p->extractWords($text, array("'", "—", "."));
        /** @var \TomasKuba\Blabot\Dictionary\WritableDictionarySpy $dSpy */
        $dSpy = $this->p->getDictionary();

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

    /**
     * @test
     */
    public function givenTextSplitsInSentencesByDelimiters()
    {
        $text = "Věta prvá?  Za ní, druhá! Třetí - pěkně vedle ní. ";
        $delimiters = array('!', '.', '?');
        $expect = array(
            "Věta prvá?",
            "Za ní, druhá!",
            "Třetí - pěkně vedle ní."
        );

        $this->p->setDictionary(new WritableDictionarySpy());
        $this->p->splitInSentences($text, $delimiters);
        /** @var \TomasKuba\Blabot\Dictionary\WritableDictionarySpy $dSpy */
        $dSpy = $this->p->getDictionary();
        $expects = "addSentence: Věta prvá?\n" .
            "addSentence: Za ní, druhá!\n" .
            "addSentence: Třetí - pěkně vedle ní.";
        $this->assertEquals($expects, $dSpy->getLog());
    }

    /**
     * @test
     */
    public function givenTextParsesItInDictionary()
    {
        $text = " Á\tbb čurák ,\n č'č?    Ďď—ď -   KURVA ěéĚÉě! FfFf'f 1234.67. ";
        $expect = "" .
            "addWord: á\n" .
            "addWord: bb\n" .
            "addWord: č'č\n" .
            "addWord: ďď—ď\n" .
            "addWord: ěéěéě\n" .
            "addWord: ffff'f\n" .
            "addWord: 1234.67\n" .
            "addSentence: <1> <2>, <3>?\n" .
            "addSentence: <4> - <5>!\n" .
            "addSentence: <6> <7>.";

        $this->p->setDictionary(new WritableDictionarySpy());
        $this->p->parse($text);
        /** @var WritableDictionarySpy $dSpy */
        $dSpy = $this->p->getDictionary();

        $this->assertEquals($expect, $dSpy->getLog());
    }
}
 