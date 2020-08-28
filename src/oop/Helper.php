<?php


namespace src\oop;


use http\Exception\InvalidArgumentException;

class Helper
{
    /**
     * @param $key
     * @return void
     */
    public static function isIndexStringOrInt($key)
    {
        if (!is_string($key) || !is_int($key)) {
            throw new InvalidArgumentException("Only string or integer");
        }
    }

    public static function isString($value)
    {
        if(!is_string($value)) {
            throw new InvalidArgumentException("Value can be only string");
        }
    }
}