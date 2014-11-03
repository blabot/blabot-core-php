<?php


namespace TomasKuba\Blabot\Gateway;


use TomasKuba\Blabot\Dictionary\Dictionary;

interface DictionaryGatewayInterface {

    /**
     * @param string $name
     * @return \TomasKuba\Blabot\Dictionary\Dictionary
     */
    public function findDictionaryByName($name);

    /**
     * @param Dictionary $dictionary
     */
    public function save(Dictionary $dictionary);
}