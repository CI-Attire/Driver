<?php

namespace Attire;

use Attire\Exceptions\Manager as ManagerException;

/**
 * CodeIgniter.
 *
 * An open source application development framework for PHP
 *
 * @author    EllisLab Dev Team
 * @copyright Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license   http://opensource.org/licenses/MIT	MIT License
 *
 * @see      http://codeigniter.com
 * @since     Version 1.0.0
 */

/**
 * Attire Asset Manager Class
 *
 * @category   Driver
 *
 * @author     David Sosa Valdes
 *
 * @see       https://github.com/CI-Attire/Driver
 */
class AssetManager extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    use Traits\FileKit;
    use Traits\Extractor;

    /**
     * Asset Manifest is a set of indexed assets.
     *
     * @var array
     */
    private static $manifest = [];

    /**
     * Namespace path.
     *
     * @var null|string
     */
    private static $namespace = null;

    /**
     * Autoload Assets.
     *
     * @var array
     */
    private static $autoload = [];

    /**
     * Throw Error Flag.
     *
     * @var bool
     */
    private static $throw_error = true;

    /**
     * Class constructor.
     *
     * @param array $options Class arguments ('namespace, manifest, autoload')
     */
    public static function initialize(array $options = [])
    {
        extract(self::intersect('namespace', 'manifest', 'autoload', $options));

        self::setNamespace($namespace);
        self::setManifest($manifest);
        self::setAutoload((array) $autoload);
    }

    /**
     * Set namespace.
     *
     * @param string $namespace
     */
    public static function setNamespace($namespace)
    {
        self::$namespace = self::rtrim($namespace);
    }

    /**
     * Set manifest.
     *
     * @param string|array $manifest Manifest filepath or an array
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
     * Set debug flag.
     *
     * @param bool $state Default: TRUE
     */
    public function debug(bool $state = true)
    {
        self::$throw_error = $state;
    }

    /**
     * Add an asset to the manager.
     *
     * @param string      $filePath  Asset file path
     * @param null|string $namespace Extenstion namespace (js, css)
     */
    public static function addAsset($filePath, $namespace = null)
    {
        if (is_null($namespace)) {
            $namespace = $this->getFileNamespace($filePath);
        }
        self::$autoload[$namespace][] = $filePath;
    }

    /**
     * Asset autoloader setter.
     *
     * @param array $autoload
     */
    public static function setAutoload(array $autoload)
    {
        self::$autoload = $autoload;
    }

    /**
     * Get the autoloader.
     *
     * @return array
     */
    public static function getAutoload()
    {
        return self::$autoload;
    }

    /**
     * Get the manag globals.
     *
     * @return array
     */
    public function getGlobals()
    {
        $assets = [];
        foreach (self::$autoload as $key => $asset) {
            if ($namespace = $this->getFileNamespace($asset)) {
                $assets[$namespace][] = $asset;
            } else {
                throw new ManagerException(sprintf(
                    'Error processing the style namespace of: %s',
                    $asset
                ));
            }
        }
        return ['assets' => $assets];
    }

    /**
     * Get the namespace of one file
     *
     * @param  string  $filePath  Asset file path
     * @return string             File extension
     */
    private function getFileNamespace($filePath)
    {
        switch ((new \SplFileInfo($filePath))->getExtension())
        {
            case 'js':
                return 'scripts';
            case 'css':
                return 'styles';
        }
        return false;
    }

    /**
     * Get the manager functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            /*
             * Attire
             *
             * Get the asset version based on the manifest filename
             *
             * @param string $filename
             *
             * @return string Filename path (versioned)
             */
            new \Twig_SimpleFunction('attire', function ($filename) {
                $fileInManifest = isset(self::$manifest[$filename]);
                $file = self::rtrim(sprintf('%s/%s',
                    self::$namespace, $fileInManifest
                        ? self::$manifest[$filename]
                        : $filename
                ));

                if (self::$throw_error) {
                    if (! ($fileInManifest && file_exists($file))) {
                        throw new ManagerException(sprintf(
                            'Error Processing the Asset: %s',
                            $file
                        ));
                    }
                }
                return $file;
            }),
        ];
    }
}
