<?php
namespace Attire\Managers;

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
use Attire\Exceptions\Manager as AssetException;

/**
 * Attire AssetManager
 *
 * @package    CodeIgniter
 * @subpackage Drivers
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/davidsosavaldes/Attire
 */
class Asset extends \Twig_Extension
{
  private $config;

  private $directory = 'assets';

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

    if (is_array($args))
    {
      $this->config = $args;
    }
    elseif (file_exists($file = $args) || file_exists(($file = $theme->getPath().'/'.$file)))
    {
      $this->config = json_decode(file_get_contents($file), TRUE);
    }
  }

  public function setDirectory($directory){
    $this->directory = rtrim($directory, '/');
  }

  public function getFunctions() {
    return [
      new \Twig_SimpleFunction('attire', function($filename) {
        if (! key_exists($filename, $this->config))
        {
          throw new AssetException("Error Processing the Asset: {$filename}");
        }
        return rtrim(base_url("{$this->directory}/{$this->config[$filename]}"),'/');
      })
    ];
  }
}
