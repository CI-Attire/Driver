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

 use \Attire\Driver\Loader;
 use \Attire\Exceptions\Theme as ThemeException;

/**
 * Attire Theme
 *
 * @package    CodeIgniter
 * @subpackage Drivers
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/davidsosavaldes/Attire
 */
class Theme
{
  use \Attire\Traits\FileKit;

  /**
   * Theme directory used as name
   * @var string
   */
  private static $name = 'attire';

  /**
   * Themes default path
   * @var string
   */
  private static $path = 'themes/';

  /**
   * Master template rendered
   * @var string
   */
  private static $template = 'master.twig';

  /**
   * Slave layout if exists
   * @var string
   */
  private static $layout = 'layouts/default.twig';

  /**
   * Identifier of the main namespace.
   */
  const MAIN_NAMESPACE = 'theme';

  /**
   * Identifier of the main theme name.
   */
  const MAIN_THEMENAME = 'attire';

  /**
	 * Class constructor
	 *
	 * @param  string $name      Theme name.
	 * @param  string $path      Default path as a string.
   * @param  string $template  Master template.
	 * @param  string $layout    Slave layout.
	 */
  function __construct($name, $path, $template = NULL, $layout = NULL)
  {
    self::setFileExtension(Loader::getFileExtension());

    $this
      ->setName($name)
      ->setPath($path)
      ->setTemplate($template)
      ->setLayout($layout);
  }

  public function getNamespace()
  {
    return self::MAIN_NAMESPACE;
  }

  public function getMainThemePath()
  {
    return rtrim($this->getPath(), self::$name) . self::MAIN_THEMENAME; 
  }

  /**
   * Get the theme name
   *
   * @return string Theme name
   */
  public function setName($name=NULL)
  {
    (!! $name) && self::$name = $name;
    return $this;
  }

  /**
	 * Set theme default path (without name)
	 *
	 * @param string $path Theme path
	 */
  public function setPath($path)
  {
    if (! is_dir($abs_path = Loader::getRootPath()."{$path}"))
    {
      throw new ThemeException("Cannot find theme directory: {$path} inside:". Loader::getRootPath());
    }
    self::$path = self::rtrim($path).DIRECTORY_SEPARATOR;
    return $this;
  }

  /**
	 * Get theme default path
	 *
	 * @return string Theme path
	 */
  public static function getPath()
  {
    return Loader::getRootPath() . self::$path . self::$name;
  }

  /**
	 * Set the master template
	 *
	 * @param string $template Template name, ignore if not string
	 */
  public function setTemplate($template)
  {
    if ($template !== NULL)
    {
      (! self::haveExtension($template)) && $template .= self::getFileExtension();
      self::$template = $template;
    }
    return $this;
  }

  /**
	 * Get the current template
	 *
	 * @return string Return the actual path if exist else FALSE
	 */
  public function getTemplate()
  {
    return self::$template;
  }

  /**
   * Set a new layout
   *
   * @param string $layout    Layout filename path
   * @param string $directory Directory where the layout is stored (relative to theme path)
   */
  public function setLayout($layout)
  {
    if ($layout !== NULL)
    {
      if ($layout !== FALSE)
      {
        $path = $this->getPath();

        (! self::haveExtension($layout)) && $layout .= self::getFileExtension();

        if (! file_exists($layout_file = "{$path}/{$layout}"))
        {
          throw new ThemeException("Cannot find theme layout: {$layout} inside: " . $path);
        }
      }
      self::$layout = $layout;
    }
    return $this;
  }

  /**
  * Get the current layout
  *
  * @return boolean|string Return the actual path if exist else FALSE
  */
  public function getLayout()
  {
    return self::$layout;
  }
}
