<?php


namespace TomasKuba\Blabot\Gateway;


interface GatewayInterface {

    /**
     * @param string $name
     * @return \TomasKuba\Blabot\Dictionary\Dictionary
     */
    public function findDictionaryByName($name);
}