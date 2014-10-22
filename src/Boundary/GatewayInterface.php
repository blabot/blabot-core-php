<?php


namespace TomasKuba\Blabot\Boundary;


interface GatewayInterface {

    /**
     * @param string $name
     * @return \TomasKuba\Blabot\Entity\Dictionary
     */
    public function findDictionaryByName($name);
}