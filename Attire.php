<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

 use Attire\Driver\Environment;
 use Attire\Driver\Filter;
 use Attire\Driver\Functions;
 use Attire\Driver\Globals;
 use Attire\Driver\Lexer;
 use Attire\Driver\Loader;
 use Attire\Driver\Theme;
 use Attire\Driver\Views;
 use Attire\Driver\AssetManager;

/**
 * CodeIgniter Attire
 *
 * Templating with this class is done by layering the standard CI view system and extending
 * it with Sprockets-PHP (pipeline asset management). The basic idea is that for every single
 * CI view there are individual CSS, Javascript and View files that correlate to it and
 * this structure is conected with the Twig Engine.
 *
 * @package    CodeIgniter
 * @subpackage Drivers
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/davidsosavaldes/Attire
 */
class Attire
{

  /**
   * @var \CI_Controller
   */
  private $CI;

  /**
   * @var \Twig_Loader
   */
  private $loader;

  /**
   * @var \Twig_Environment
   */
  private $environment;

  /**
   * @var \Attire\Driver\Theme
   */
  private $theme;

  /**
   * @var \Twig_Lexer
   */
  private $lexer;

  /**
   * @var \Attire\Driver\Views
   */
  private $views;

  /**
   * @var \Attire\Driver\AssetManager
   */
  private $assetManager;

  /**
   * Class constructor
   *
   * @param array $config library params
   */
  function __construct(array $options = [])
  {
    try
    {
      $this->CI =& get_instance();

      if (isset($options['loader']))
      {
        extract(self::intersect('paths','file_ext','root_path', $options['loader']));
        $this->loader = new Loader($paths, $file_ext, $root_path);
      }

      if (isset($options['theme']))
      {
        extract(self::intersect('name','path','template','layout', $options['theme']));
        $this->theme = new Theme($name, $path, $template, $layout);
      }

      if (isset($options['environment']))
      {
        $this->environment = new Environment($this->loader, $options['environment']);
        extract(self::intersect('debug', $options['environment']));
        $debug && $this->environment->addExtension(new \Twig_Extension_Debug());
      }

      if (isset($options['lexer']))
      {
        $this->lexer = new Lexer($this->environment, $options['lexer']);
      }

      if (isset($options['assets']))
      {
        $this->assetManager = new AssetManager($options['assets']);
      }

      $this->views = new Views();

    }
    catch (\TypeError $e)
    {
      $this->_showError($e);
    }
  }

  /**
	 * Render a template
	 *
	 * @param  array|string $views   A view or an array of views with parameters passed to the template
	 * @param  boolean      $return  Output flag
	 * @return string                The output as string if the return flag is set to TRUE
	 */
  public function render($views = NULL, array $params = [], $return = FALSE)
  {
    try
    {
      $this->CI->benchmark->mark('Attire Render Time_start');

      $this->environment->addGlobal('attire', $this->assetManager);

      foreach ((array) $views as $key => $value)
      {
        is_string($key)
          && $this->views->add($key, $value)
          || $this->views->add($value, $params);
      }

      if ($this->theme !== NULL)
      {
        $theme_path = $this->theme->getPath();
        $layout     = $this->theme->getLayout();
        $namespace  = $this->theme::MAIN_NAMESPACE;

        $this->loader->addPath($theme_path, $namespace);

        $template_file = ($layout !== FALSE ? $layout : $this->theme->getTemplate());

        $template = $this->environment->loadTemplate("@{$namespace}/{$template_file}");
        $output   = $template->render(['views' => $this->views->getStored()]);
      }

      $this->CI->benchmark->mark('Attire Render Time_end');

      return $return !== FALSE ? $output : $this->CI->output->set_output($output);
    }
    catch (\Exception $e)
    {
      $this->_showError($e);
    }
  }

  /**
   * Intersect the values of an array based on some variables predecesors,
   * if a variable is not defined inside the array then his value should be null.
   *
   * @param  array $params  ...
   * @return array          The array intersected
   */
  private static function intersect(...$params)
  {
    $options = array_pop($params);
    foreach ($params as $key)
    {
      (! key_exists($key, $options)) && $options[$key] = NULL;
    }
    return array_intersect_key($options, array_flip($params));
  }

  /**
   * Intersect the values of an array based on some variables predecesors,
   * if a variable is not defined inside the array then his value should be null.
   *
   * @param  string $method  ...
   * @param  array  $params  ...
   */
  public function __call($method, array $params)
  {
    $prefix = substr($method, 0, 3);
    if ($prefix == 'set')
    {
      $class = ucfirst(str_replace($prefix, '', $method));
      switch ($class)
      {
        case 'Loader':
        case 'Environment':
        case 'Theme':
        case 'Lexer':
          $object = array_pop($params);
          if (is_a($object, $class))
          {
            $class = strtolower($class);
            $this->{$class} = $object;
          }
          else
          {
            throw new \TypeError("Argument 1 passed to Attire::{$method} must be an instance of Attire\Driver\\".$class);
          }
          break;
      }
    }
    throw new \BadMethodCallException;
  }

  /**
  * Show the possible exception in the output
  *
  * @param \Error $e
  */
  private function _showError($e)
  {
    if (is_cli()) { throw $e; }
    list($trace) = $e->getTrace();
    $message = "Exception: ".$trace['class']." with the message:<br>&emsp;".$e->getMessage();
    return show_error($message, 500, 'Attire error');
  }
}
/* End of file Attire.php */
/* Location: ./application/libraries/attire/Attire.php */
