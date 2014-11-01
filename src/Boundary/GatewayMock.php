<?php


namespace TomasKuba\Blabot\Boundary;


use TomasKuba\Blabot\Dictionary\Dictionary;
use TomasKuba\Blabot\Dictionary\ReadableDictionaryInterface;
use TomasKuba\Blabot\Dictionary\ReadableDictionaryMock;

class GatewayMock implements GatewayInterface
{

    /**
     * @param string $name
     * @return ReadableDictionaryInterface
     */
    public function findDictionaryByName($name)
    {
        if ($name == 'simple') {
            return new ReadableDictionaryMock();
        }

        return new Dictionary();
    }
}