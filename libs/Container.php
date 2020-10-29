<?php

namespace libs;

class Container
{
    protected static $container;

    public static function set($service, $payload)
    {
        static::$container[$service] = $payload;
    }

    public static function get($service)
    {
        return new static::$container[$service]();
    }
}
