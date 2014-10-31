<?php


namespace TomasKuba\Blabot\Tests;

use TomasKuba\Blabot\Context;

class ContextTest extends \PHPUnit_Framework_TestCase {

    /** @var  Context */
    private $c;

    protected function setUp(){
        $this->c = new Context();
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function givenNoServiceThrows()
    {
        $this->c->getService('service');
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function givenServiceButRequestedAnotherThrows()
    {
        $this->c->addService('service1', null);
        $this->c->getService('service2');
    }

    /**
     * @test
     */
    public function givenServiceReturnsServiceByName()
    {
        $this->c->addService("service name", "service value");
        $this->assertEquals("service value", $this->c->getService("service name"));
    }
}
 