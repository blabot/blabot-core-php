<?php


namespace TomasKuba\Blabot\Gateway;


use TomasKuba\Blabot\Entity\Dictionary;
use TomasKuba\Blabot\Generator\GenerableFromMock;

class GatewayMock implements GatewayInterface
{

    /**
     * @param string $name
     * @return Dictionary
     */
    public function findDictionaryByName($name)
    {
        if ($name == 'simple') {
            return new GenerableFromMock();
        }

        return new Dictionary();
    }
}