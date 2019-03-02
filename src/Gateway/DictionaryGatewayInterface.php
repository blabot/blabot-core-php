<?php


namespace Blabot\Gateway;


use Blabot\Dictionary\Dictionary;

interface DictionaryGatewayInterface {

    /**
     * @param string $name
     * @return \Blabot\Dictionary\Dictionary
     */
    public function findDictionaryByName($name);

    /**
     * @param Dictionary $dictionary
     */
    public function save(Dictionary $dictionary);
}