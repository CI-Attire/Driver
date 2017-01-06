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

use Attire\Driver\Theme;
use Attire\Exceptions\AssetManagerException;

/**
 * Attire AssetManager
 *
 * @package    CodeIgniter
 * @subpackage Drivers
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/davidsosavaldes/Attire
 */
class AssetManager extends \Twig_SimpleFunction
{
  private $config;

  /**
   * Class constructor
   *
   * @param {Theme}        $theme     \Attire\Driver\Theme instance
   * @param {string|array} $args      A set of defined asset paths or the file that contains this paths.
   */
  public function __construct(Theme $theme, $args)
  {
    if (is_array($args))
    {
      $this->config = $args;
    }
    elseif (file_exists($file = $args) || file_exists(($file = $theme->getPath().'/'.$file)))
    {
      $this->config = json_decode(file_get_contents($file), TRUE);
    }
    $callback = function($filename) {
      if (! key_exists($filename, $this->config))
      {
        throw new AssetManagerException("Error Processing the Asset: {$filename}");
      }
      return $this->config[$filename];
    };
    parent::__construct('attire', $callback);
  }
}
