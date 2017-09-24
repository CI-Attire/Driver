<?php

namespace Attire\Traits;

/**
 * Attire Extractor Trait
 *
 * Parameter Extractor.
 *
 * @category   Traits
 * @author     David Sosa Valdes
 * @see       https://github.com/CI-Attire/Driver
 */
trait Extractor
{
    /**
     * Intersect the values of an array based on the predecesors,
     * if a variable is not defined inside the array then his value should be null.
     *
     * @param array $params ...
     * @return array The array intersected
     */
    private static function intersect(...$params)
    {
        $options = array_pop($params);

        foreach ($params as $key) {
            if (!key_exists($key, $options)) {
                $options[$key] = null;
            }
        }

        return array_intersect_key($options, array_flip($params));
    }
}
