<?php


namespace TomasKuba\Blabot;


class Context
{
    private static $services = array();

    public static function getService($name)
    {
        if (!array_key_exists($name, self::$services)){
            throw new \RuntimeException("Unknown service: '$name'");
        } else {
            return self::$services[$name];
        }
    }

    public static function addService($name, $value)
    {
        self::$services[$name] = $value;
    }
} 