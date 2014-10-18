<?php


namespace TomasKuba\Blabot;


class Context
{
    private $services = array();

    public function getService($name)
    {
        if (!array_key_exists($name,$this->services)){
            throw new \RuntimeException("Unknown service: '$name'");
        } else {
            return $this->services[$name];
        }
    }

    public function addService($name, $value)
    {
        $this->services[$name] = $value;
    }
} 