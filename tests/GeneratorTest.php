<?php

namespace TomasKuba\Blabot\Tests;

use TomasKuba\Blabot\Entity\Dictionary;
use TomasKuba\Blabot\Entity\ReadableDictionaryDummy;
use TomasKuba\Blabot\Entity\ReadableDictionaryMock;
use TomasKuba\Blabot\UseCase\Generator;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        mb_internal_encoding("UTF-8");
    }

    /**
     * @test
     */
    public function givenEmptyDictionaryReturnsEmptySentence()
    {
        $g = new Generator(new ReadableDictionaryDummy());
        $this->assertEquals("", $g->getSentence());
    }

    /**
     * @test
     */
    public function givenSourceReturnsHumanReadableSentence()
    {
        $g = new Generator(new ReadableDictionaryMock());
        $this->assertEquals("Á bb, čč'č ďď—ď ěěěěě!", $g->getSentence());
    }

    /**
     * @test
     */
    public function givenSourceReturnsSeveralSentences()
    {
        $expect = array (
            "Á bb, čč'č ďď—ď ěěěěě!",
            "Á bb, čč'č ďď—ď ěěěěě!",
            "Á bb, čč'č ďď—ď ěěěěě!"
        );
        $g = new Generator(new ReadableDictionaryMock());

        $this->assertEquals($expect, $g->getSentences(3));
    }
}
 