<?php
namespace Attire;

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * @package   CodeIgniter
 * @author    EllisLab Dev Team
 * @copyright Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license   http://opensource.org/licenses/MIT	MIT License
 * @link      http://codeigniter.com
 * @since     Version 1.0.0
 */

use \Attire\Exceptions\Manager as ManagerException;

/**
 * Attire AssetManager
 *
 * @package    CodeIgniter
 * @subpackage Drivers
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/davidsosavaldes/Attire
 */
class AssetManager extends \Twig_Extension
{
    use Traits\FileKit;
    use Traits\Extractor;

    /**
     * Asset Manifest is a set of indexed assets
     */
    private static $manifest = [];

    /**
     * Namespace path
     */
    private static $namespace = null;

    /**
     * Autoload Assets
     */
    private static $autoload = [];

    /**
     * Throw Error Flag
     */
    private static $throw_error = TRUE;

    /**
     * Class constructor
     *
     * @param {string} $namespace  Asset path prefix
     * @param {mixed}  $manifest   Set of defined asset paths or the file that contains this paths
     * @param {array}  $autoload   Set of included assets directly in the layout
     */
    public function __construct(array $options = [])
    {
        extract(self::intersect('namespace', 'manifest', 'autoload', $options));

        self::setNamespace($namespace);
        self::setManifest($manifest);
        self::setAutoload($autoload);
    }

    public static function setNamespace($namespace)
    {
        self::$namespace = self::rtrim($namespace);
    }

    public static function setManifest($manifest)
    {
        if (is_array($manifest)) {
            self::$manifest = $manifest;
        } elseif (file_exists($file = $manifest)) {
            self::$manifest = json_decode(file_get_contents($file), true);
        }
    }

    public function debug($state = true)
    {
        self::$throw_error = $state;
    }

    public static function addAsset($filePath, $namespace)
    {
        self::$autoload[$namespace][] = $filePath;
    }

    public function setAutoload(array $autoload)
    {
        self::$autoload = $autoload;
    }

    public function getAutoload()
    {
        return self::$autoload;
    }

    public function getFunctions()
    {
        return [
          new \Twig_SimpleFunction('attire', function ($filename) {
              $fileExists = isset(self::$manifest[$filename]);

              if (self::$throw_error && (! $fileExists)) {
                  throw new ManagerException(sprintf(
                    'Error Processing the Asset: %s',
                    $filename
                  ));
              }
              return self::rtrim(sprintf(
                '%s/%s',
                self::$namespace,
                ($fileExists? self::$manifest[$filename] : $filename)
              ));
            }
          )
        ];
    }
}
