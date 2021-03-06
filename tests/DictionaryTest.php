<?php
declare(strict_types=1);

namespace Blabot\Dictionary;

use PHPUnit\Framework\TestCase;

class DictionaryTest extends TestCase
{

    /** @var  \Blabot\Dictionary\Dictionary */
    private $d;

    protected function setUp()
    {
        mb_internal_encoding("UTF-8");
        $this->d = new Dictionary();
    }

    /**
     * @test
     */
    public function whenEmptyHasNoWords()
    {
        $this->assertFalse($this->d->hasWords());
    }

    /**
     * @test
     */
    public function whenEmptyHasNoSentences()
    {
        $this->assertFalse($this->d->hasSentences());
    }

    /**
     * @test
     */
    public function givenWordHasWords()
    {
        $this->d->addWord("word");
        $this->assertTrue($this->d->hasWords());
    }

    /**
     * @test
     */
    public function givenSentenceHasSentences()
    {
        $this->d->addSentence("<1>, <2> - <3>!");
        $this->assertTrue($this->d->hasSentences());
    }

    /**
     * @test
     */
    public function givenSingleWordReturnsWordByItsLength()
    {
        $this->d->addWord("žluťoučký");
        $this->assertEquals("žluťoučký", $this->d->getWordOfLength(9));
    }

    /**
     * @test
     */
    public function givenNoWordsReturnsEmptyString()
    {
        $this->assertEquals("", $this->d->getWordOfLength(1));
    }

    /**
     * @test
     */
    public function givenSingleWordWhenRequestedForWordOfDifferentLengthReturnsEmptyString()
    {
        $this->d->addWord("žluťoučký");
        $this->assertEquals("", $this->d->getWordOfLength(3));
    }

    /**
     * @test
     */
    public function givenSameWordManyTimesStoresItOnlyOnce()
    {
        $this->d->addWord("žluťoučký");
        $this->d->addWord("žluťoučký");
        $this->d->addWord("žluťoučký");

        $this->assertEquals(1, $this->d->countWordsOfLength(9));
    }

    /**
     * @test
     */
    public function givenWordsOfSameLengthReturnsRandomWordByLength()
    {
        $this->d->addWord("a");
        $this->d->addWord("b");
        $this->d->addWord("c");
        $this->d->addWord("d");
        $this->d->addWord("e");

        $actual = "";
        for ($i = 5; $i > 0; $i--) {
            $actual .= $this->d->getWordOfLength(1);
        }

        $this->assertNotEquals("abcde", $actual);
    }

    /**
     * @test
     */
    public function givenNoSentencesReturnsEmptySentence()
    {
        $this->d->addWord("word");
        $this->assertEquals("", $this->d->getSentence());
    }

    /**
     * @test
     */
    public function givenSameSentenceManyTimesStoresItOnlyOnce()
    {
        $this->d->addSentence("<1>, <2> - <3>!");
        $this->d->addSentence("<1>, <2> - <3>!");
        $this->d->addSentence("<1>, <2> - <3>!");

        $this->assertEquals(1, $this->d->countSentences());
    }
    
    /**
     * @test
     */
    public function givenOneSentenceReturnsThisSentence()
    {
        $this->d->addSentence("<1>, <2> - <3>!");
        
        $this->assertEquals("<1>, <2> - <3>!", $this->d->getSentence());
    }

    /**
     * @test
     */
    public function givenSeveralSentencesReturnsRandomSentence()
    {
        $this->d->addSentence("a");
        $this->d->addSentence("b");
        $this->d->addSentence("c");
        $this->d->addSentence("d");
        $this->d->addSentence("e");

        $actual = "";
        for ($i = 5; $i > 0; $i--) {
            $actual .= $this->d->getSentence();
        }

        $this->assertNotEquals("abcde", $actual);
    }

    /**
     * @test
     */
    public function givenArrayOfSentencesStoresThemAsUnique()
    {
        $this->d->addSentences(array("aaa", "aaa", "bbb", "ccc", "ccc"));
        $this->assertEquals(3, $this->d->countSentences());
    }

    public function testGivenMetaStoresMeta()
    {
        $this->d->addMeta("metaName","Meta Value");
        $this->assertEquals("Meta Value", $this->d->getMeta("metaName"));
    }

    public function givenStateAtConstructHasGivenState()
    {
        $w = ["9"=>["žluťoučký"]];
        $s = ["<9> <9>, <9>!"];
        $d = new Dictionary($w, $s);
        $this->assertEquals("žluťoučký", $d->getWordOfLength(9));
        $this->assertEquals("<9> <9>, <9>!", $d->getSentence());
    }
}
 