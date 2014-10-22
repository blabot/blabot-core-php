<?php


namespace TomasKuba\Blabot;


class Context
{
    /** @var array */
    private static $services = array();

    /**
     * @param string $name
     * @return mixed
     */
    public static function getService($name)
    {
        if (!array_key_exists($name, self::$services)){
            throw new \RuntimeException("Unknown service: '$name'");
        } else {
            return self::$services[$name];
        }
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public static function addService($name, $value)
    {
        self::$services[$name] = $value;
    }
} 