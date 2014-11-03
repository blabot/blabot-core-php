<?php


namespace TomasKuba\Blabot\Gateway;


use TomasKuba\Blabot\Dictionary\Dictionary;
use TomasKuba\Blabot\Dictionary\ReadableDictionaryInterface;
use TomasKuba\Blabot\Dictionary\ReadableDictionaryMock;

class DictionaryGatewayMock implements DictionaryGatewayInterface
{
    /** @var array */
    private $dictionaries = array();

    /**
     * @param string $name
     * @return ReadableDictionaryInterface
     */
    public function findDictionaryByName($name)
    {
        if ($name == 'ReadableDictionaryMock') {
            return new ReadableDictionaryMock();
        }

        if (array_key_exists($name, $this->dictionaries)){
            return $this->dictionaries[$name];
        }

        return new Dictionary();
    }

    /**
     * @param Dictionary $dictionary
     */
    public function save(Dictionary $dictionary)
    {
        $this->dictionaries[$dictionary->getName()] = $dictionary;
    }


}