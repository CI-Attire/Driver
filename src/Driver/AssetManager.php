<?php
namespace Attire\Driver;

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


/**
 * Attire AssetManager
 *
 * @package    CodeIgniter
 * @subpackage Drivers
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/davidsosavaldes/Attire
 */
class AssetManager
{
  private $config;

  /**
   * Class constructor
   *
   * @param ---
   */
  public function __construct($file_path)
  {
    if (file_exists($file_path))
    {
      $string = file_get_contents($file_path);
      $this->config = json_decode($string);
    }
  }

  public function __call($method, array $args = [])
  {
    switch ($method) {
      case 'script':
      case 'style':
        @list($name) = $args;
        is_null($name) && $name = 'main';
        return key_exists($this->config, $name)? $this->config->{$name}->styles : NULL;
    }
    throw new \BadMethodCallException("The method '$method' does not exist");
  }
}
