<?php


namespace TomasKuba\Blabot\Gateway;


use TomasKuba\Blabot\Entity\Dictionary;

class GatewayMock implements GatewayInterface {

    public function findDictionaryByName($name){
        $dictionary = new Dictionary();

        if (empty($name)) {
            return $dictionary;
        }

        return $dictionary;

    }

} 