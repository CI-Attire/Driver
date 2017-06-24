<?php
namespace Attire\Traits;

/**
 * Attire Parameter Extractor Trait
 *
 * @package    Attire
 * @subpackage Drivers
 * @category   Traits
 * @author     David Sosa Valdes
 * @link       https://github.com/davidsosavaldes/Attire
 */
trait Extractor
{
    /**
     * Intersect the values of an array based on the predecesors,
     * if a variable is not defined inside the array then his value should be null.
     *
     * @param  array $params  ...
     * @return array          The array intersected
     */
    private static function intersect(...$params)
    {
        $options = array_pop($params);

        foreach ($params as $key) {
            (! key_exists($key, $options)) && $options[$key] = null;
        }
        return array_intersect_key($options, array_flip($params));
    }
}

/* End of file File_Component.php */
/* Location: ./application/libraries/Attire/src/File_Component.php */
