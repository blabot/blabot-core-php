<?php

namespace TomasKuba\Blabot\Tests;

use TomasKuba\Blabot\Entity\Dictionary;
use TomasKuba\Blabot\Entity\GenerableFromDummy;
use TomasKuba\Blabot\Entity\GenerableFromMock;
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
        $g = new Generator(new GenerableFromDummy());
        $this->assertEquals("", $g->getSentence());
    }

    /**
     * @test
     */
    public function givenSourceReturnsHumanReadableSentence()
    {
        $g = new Generator(new GenerableFromMock());
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
        $g = new Generator(new GenerableFromMock());

        $this->assertEquals($expect, $g->getSentences(3));
    }
}
 