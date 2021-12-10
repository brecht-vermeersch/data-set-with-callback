<?php

if (!function_exists('data_set_with_callback')) {
    /**
     * Set an item on an array using dot notation and a callback that takes in the original value.
     *
     * @param array $array
     * @param string|array $key
     * @param callable $callback
     * @return void
     */
    function data_set_with_callback(array &$array, $key, callable $callback)
    {
        $segments = is_array($key) ? $key : explode('.', $key);

        /**
         * There are multiple segments
         */
        while (count($segments) > 1) {
            $segment = array_shift($segments);

            /**
             * The current segment is a *
             */
            if ($segment === "*") {
                foreach ($array as &$inner) {
                    if(is_array($inner)) {
                        data_set_with_callback($inner, $segments, $callback);
                    }
                }
                return;
            }

            /**
             * The segment does not exist
             */
            if (!array_key_exists($segment, $array)) {
                return;
            }

            $array = &$array[$segment];
        }

        /**
         * There is only one segment left
         */
        $lastSegment = array_shift($segments);

        /**
         * The last segment is a star
         */
        if ($lastSegment === "*") {
            foreach ($array as $key => $value) {
                $array[$key] = $callback($value);
            }
            return;
        }

        /**
         * The last segment is not a star
         */
        if (!array_key_exists($lastSegment, $array)) {
            return;
        }

        $array[$lastSegment] = $callback($array[$lastSegment]);
    }
}