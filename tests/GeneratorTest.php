<?php
declare(strict_types=1);
namespace Blabot\Generator;

use PHPUnit\Framework\TestCase;
use Blabot\Dictionary\ReadableDictionaryDummy;
use Blabot\Dictionary\ReadableDictionaryMock;

class GeneratorTest extends TestCase
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
        $this->assertEquals("Á bb, čč'č ďď—ď ěěěěě – abcdefghijk!", $g->getSentence());
    }

    /**
     * @test
     */
    public function givenSourceReturnsSeveralSentences()
    {
        $expect = array (
            "Á bb, čč'č ďď—ď ěěěěě – abcdefghijk!",
            "Á bb, čč'č ďď—ď ěěěěě – abcdefghijk!",
            "Á bb, čč'č ďď—ď ěěěěě – abcdefghijk!"
        );
        $g = new Generator(new ReadableDictionaryMock());

        $this->assertEquals($expect, $g->getSentences(3));
    }
}
 