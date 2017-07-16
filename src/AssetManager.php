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
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/CI-Attire/Driver
 */
class AssetManager extends \Twig_Extension
{
    use Traits\FileKit;
    use Traits\Extractor;

    /**
     * Asset Manifest is a set of indexed assets
     * @var array
     */
    private static $manifest = [];

    /**
     * Namespace path
     * @var null|string
     */
    private static $namespace = null;

    /**
     * Autoload Assets
     * @var array
     */
    private static $autoload = [];

    /**
     * Throw Error Flag
     * @var boolean
     */
    private static $throw_error = TRUE;

    /**
     * Class constructor
     *
     * @param array $options Class arguments ('namespace, manifest, autoload')
     * @return void
     */
    public function __construct(array $options = [])
    {
        extract(self::intersect('namespace', 'manifest', 'autoload', $options));

        self::setNamespace($namespace);
        self::setManifest($manifest);
        self::setAutoload((array) $autoload);
    }

    /**
     * Set namespace
     *
     * @param string $namespace
     * @return void
     */
    public static function setNamespace($namespace)
    {
        self::$namespace = self::rtrim($namespace);
    }

    /**
     * Set manifest
     *
     * @param string|array $manifest Manifest filepath or an array
     * @return void
     */
    public static function setManifest($manifest)
    {
        if (is_array($manifest)) {
            self::$manifest = $manifest;
        } elseif (file_exists($file = $manifest)) {
            self::$manifest = json_decode(file_get_contents($file), true);
        }
    }

    /**
     * Set debug flag
     *
     * @param boolean $state Default: TRUE
     * @return void
     */
    public function debug($state = true)
    {
        self::$throw_error = $state;
    }

    /**
     * Add an asset to the manager
     *
     * @param string      $filePath  Asset file path
     * @param null|string $namespace Extenstion namespace (js, css)
     * @return void
     */
    public static function addAsset($filePath, $namespace=NULL)
    {
        if (is_null($namespace))
        {
          $info = new \SplFileInfo($filePath);

          switch ($info->getExtension())
          {
            case 'js':
              $namespace = 'scripts';
              break;
            case 'css':
              $namespace = 'styles';
              break;
          }
        }
        self::$autoload[$namespace][] = $filePath;
    }

    /**
     * Asset autoloader setter
     *
     * @param array $autoload
     * @return void
     */
    public function setAutoload(array $autoload)
    {
        self::$autoload = $autoload;
    }

    /**
     * Get the autoloader
     *
     * @return array
     */
    public function getAutoload()
    {
        return self::$autoload;
    }

    /**
     * Get the manager functions
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
          /**
           * Get the asset version based on the manifest filename
           *
           * @param string $filename
           * @return string Filename path (versioned)
           */
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
