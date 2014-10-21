<?php


namespace TomasKuba\Blabot\Gateway;


interface GatewayInterface {

    /**
     * @param string $name
     * @return \TomasKuba\Blabot\Entity\Dictionary
     */
    public function findDictionaryByName($name);
}