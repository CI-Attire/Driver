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

  private $default_port = 80;

  /**
   * Class constructor
   *
   * @param {CI_Controller} $CI        \CI_Controller reference (CI->get_instance)
   * @param {Theme}         $theme     \Attire\Driver\Theme instance
   * @param {string|array}  $args      A set of defined asset paths or the file that contains this paths.
   */
  public function __construct(\CI_Controller &$CI, Theme $theme, $args)
  {
    $CI->load->helper('url');

    $_base_url = rtrim(base_url(), '/');

    if (($_port = intval($_SERVER['SERVER_PORT'])) && $_port != $this->default_port) 
    {
      $_base_url .= ":{$_SERVER['SERVER_PORT']}";
    }

    if (is_array($args))
    {
      $this->config = $args;
    }
    elseif (file_exists($file = $args) || file_exists(($file = $theme->getPath().'/'.$file)))
    {
      $this->config = json_decode(file_get_contents($file), TRUE);
    }

    parent::__construct('attire', function($filename) use ($_base_url) {
      if (! key_exists($filename, $this->config))
      {
        throw new AssetManagerException("Error Processing the Asset: {$filename}");
      }
      return $_base_url . '/assets/' . $this->config[$filename];
    });
  }

  public function getConfig()
  {
    return $this->config;
  }
}
