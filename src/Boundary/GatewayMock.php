<?php


namespace TomasKuba\Blabot\Boundary;


use TomasKuba\Blabot\Entity\ReadableDictionaryInterface;
use TomasKuba\Blabot\Entity\ReadableDictionaryMock;
use TomasKuba\Blabot\Entity\Dictionary;

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