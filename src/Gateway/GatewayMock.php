<?php


namespace TomasKuba\Blabot\Gateway;


use TomasKuba\Blabot\Entity\Dictionary;

class GatewayMock implements GatewayInterface {

    /**
     * @param string $name
     * @return Dictionary
     */
    public function findDictionaryByName($name){
        $dictionary = new Dictionary();

        if ($name == 'simple') {
            $dictionary = $this->mockSimpleDictionary();
        }

        return $dictionary;
    }

    private function mockSimpleDictionary()
    {
        $d = new Dictionary();
        $d->addWord("á");
        $d->addWord("bb");
        $d->addWord("čč'č");
        $d->addWord("ďď—ď");
        $d->addWord("ěěěěě");
        $d->addSentence("<1> <2>, <3> <4> <5>!");

        return $d;
    }

} 