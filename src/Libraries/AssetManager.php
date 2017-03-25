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
   * Namespace path (relative to FCPATH)
   */
  private $namespace = 'assets';

  /**
   * Class constructor
   *
   * @param {CI_Controller} $CI        CI_Controller reference (CI->get_instance)
   * @param {string|array}  $manifest  A set of defined asset paths or the file that contains this paths.
   */
  public function __construct(\CI_Controller &$CI, $manifest, array $extra_assets=[])
  {
    $CI->load->helper('url');

    if (is_array($manifest))
    {
      $this->manifest = $manifest;
    }
    elseif (file_exists($file = $manifest) || file_exists(($file = Theme::getPath()."/{$manifest}")))
    {
      $this->manifest = json_decode(file_get_contents($file), TRUE);
    }
  }

  public function setManifest($namespace)
  {
    $this->namespace = self::rtrim($namespace);
  }

  public function getFunctions() {
    return [
      new \Twig_SimpleFunction('attire', function($filename)
        {
          if (! isset($this->manifest[$filename]))
          {
            throw new ManagerException("Error Processing the Asset: {$filename}");
          }
          return self::rtrim(base_url("{$this->namespace}/".$this->manifest[$filename]));
        }
      )
    ];
  }
}
