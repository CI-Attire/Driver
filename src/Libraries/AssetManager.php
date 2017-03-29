<?php
namespace Attire\Libraries;

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

use Attire\Driver\Theme;
use Attire\Exceptions\Manager as ManagerException;

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
  use \Attire\Traits\FileKit;

  /**
   * Asset Manifest is a set of indexed assets
   */
  private $manifest = [];

  /**
   * Namespace path
   */
  private $namespace = NULL;

  /**
   * Autoload Assets
   */
  private $autoload = [];

  private $throw_error = FALSE;

  /**
   * Class constructor
   *
   * @param {string} $namespace  Asset path prefix
   * @param {mixed}  $manifest   Set of defined asset paths or the file that contains this paths
   * @param {array}  $autoload   Set of included assets directly in the layout
   */
  public function __construct($namespace, $manifest, array $autoload = [])
  {
    $this
      ->setNamespace($namespace)
      ->setManifest($manifest)
      ->setAutoload($autoload);
  }

  public function setNamespace($namespace)
  {
    $this->namespace = self::rtrim($namespace);
    return $this;
  }

  public function setManifest($manifest)
  {
    if (is_array($manifest))
    {
      $this->manifest = $manifest;
    }
    elseif (file_exists($file = $manifest))
    {
      $this->manifest = json_decode(file_get_contents($file), TRUE);
    }
    return $this;
  }

  public function debug($state = TRUE)
  {
    $this->throw_error = $state;
    return $this;
  }

  public function addAsset($filePath, $namespace)
  {
    return isset($this->autoload[$namespace])
      ? $this->autoload[$namespace][] = $filePath
      : FALSE;
  }

  public function setAutoload(array $autoload)
  {
    $this->autoload = $autoload;
    return $this;
  }

  public function getAutoload()
  {
    return $this->autoload;
  }

  public function getFunctions() {
    return [
      new \Twig_SimpleFunction('attire', function($filename)
        {
          $fileExists = isset($this->manifest[$filename]);

          if ($this->throw_error && (! $fileExists))
          {
            throw new ManagerException("Error Processing the Asset: {$filename}");
          }
          return self::rtrim("{$this->namespace}/" . ($fileExists? $this->manifest[$filename] : $filename));
        }
      )
    ];
  }
}
