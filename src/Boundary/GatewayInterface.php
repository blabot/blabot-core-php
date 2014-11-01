<?php


namespace TomasKuba\Blabot\Boundary;


interface GatewayInterface {

    /**
     * @param string $name
     * @return \TomasKuba\Blabot\Dictionary\Dictionary
     */
    public function findDictionaryByName($name);
}