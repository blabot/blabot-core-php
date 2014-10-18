<?php


namespace TomasKuba\Blabot\Tests;


use TomasKuba\Blabot\Context;

class ContextTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function givenNoServiceThrows()
    {
        $c = new Context();
        $c->getService('service');
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function givenServiceButRequestedAnotherThrows()
    {
        $c = new Context();
        $c->addService('service1', null);
        $c->getService('service2');
    }

    /**
     * @test
     */
    public function givenServiceReturnsServiceByName()
    {
        $c = new Context();
        $c->addService("service name", "service value");
        $this->assertEquals("service value", $c->getService("service name"));
    }
}
 