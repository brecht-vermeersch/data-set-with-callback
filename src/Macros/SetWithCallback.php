<?php

class SetWithCallback
{
    /**
     * Like Arr::set but runs a callback on the matching values
     *
     * @param array $array
     * @param string|null $key
     * @param callable(mixed $value):mixed $callback
     * @return array
     */
    public function __invoke(array &$array, ?string $key, callable $callback): array
    {
        if (is_null($key)) {
            return $array = $callback(null);
        }

        $keys = explode('.', $key);

        foreach ($keys as $i => $key) {
            if (count($keys) === 1) {
                break;
            }

            unset($keys[$i]);

            // If the key doesn't exist at this depth, we will just create an empty array
            // to hold the next value, allowing us to create the arrays to hold final
            // values at the correct depth. Then we'll keep digging into the array.
            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $key = array_shift($keys);
        $array[$key] = $callback($array[$key]);

        return $array;
    }
}