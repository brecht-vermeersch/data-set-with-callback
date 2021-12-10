<?php

namespace Lurza\ArrayHelpers;

class ArrayHelpers
{
    /**
     * Set an array item to a given callable return value using "dot" notation.
     * The callable takes the original value as argument.
     *
     * If no key is given to the method, nothing happens.
     * If the key doesn't exist, nothing happens.
     *
     * @param array $array
     * @param string|null $key
     * @param callable(mixed $value):mixed $callback
     * @return array
     */
    public static function setWithCallback(array &$array, ?string $key, callable $callback): array
    {
        if (is_null($key)) {
            return $array;
        }

        $keys = explode('.', $key);

        foreach ($keys as $i => $key) {
            if (count($keys) === 1) {
                break;
            }

            unset($keys[$i]);

            if (!isset($array[$key]) || !is_array($array[$key])) {
                break;
            }

            $array = &$array[$key];
        }

        $key = array_shift($keys);

        if(key_exists($key, $array)) {
            $array[$key] = $callback($array[$key]);
        }

        return $array;
    }

    public static function setDataWithCallback(): array
    {
        return [];
    }
}