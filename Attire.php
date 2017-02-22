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
 use Attire\Driver\Lexer;
 use Attire\Driver\Loader;
 use Attire\Driver\Theme;
 use Attire\Driver\Views;
 use Attire\Managers\Asset as AssetManager;
 use Attire\Managers\Extension as ExtensionManager;

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
   * @var \Attire\Managers\Asset
   */
  private $assetManager;

  /**
   * @var \Attire\Managers\Extension
   */
  private $extensionManager;

  /**
   * Class constructor
   *
   * @param array $config library params
   */
  function __construct(array $options = [])
  {
    $this->CI =& get_instance();

    if (isset($options['loader']))
    {
      extract(self::intersect('paths','file_ext','root_path', $options['loader']));
      $this->loader = new Loader($paths, $file_ext, $root_path);

      if (isset($options['environment']))
      {
        $this->environment = new Environment($this->loader, $options['environment']);

        extract(self::intersect('debug', $options['environment']));
        ($debug !== FALSE) && $this->environment->addExtension(new \Twig_Extension_Debug());

        if (isset($options['lexer']))
        {
          $this->lexer = new Lexer($this->environment, $options['lexer']);
        }
      }
    }

    if (isset($options['theme']))
    {
      extract(self::intersect('name','path','template','layout', $options['theme']));
      $this->theme = new Theme($name, $path, $template, $layout);

      if (isset($options['assets']))
      {
        $this->assetManager = new AssetManager($this->CI, $this->theme, $options['assets']);
      }
    }

    $this->views = new Views;

    $this->extensionManager = new ExtensionManager();

    array_walk($this->extensionManager->extensions, function($type, $key) use ($options) {
      if (isset($options[$type]))
      {
        switch ($type)
        {
          case 'functions': $this->extensionManager->addFunctions($options[$type]); break;
          case 'filters'  : $this->extensionManager->addFilters($options[$type]); break;
          case 'globals'  : $this->extensionManager->addGlobals($options[$type]); break;
        }
      }
    });
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
      // Set the asset manager
      $this->environment->addExtension($this->assetManager);
      // Set the extension manager
      $this->environment->addExtension($this->extensionManager);
      // Add all the stored views
      foreach ((array) $views as $key => $value)
      {
        is_string($key)
          && $this->views->add($key, $value)
          || $this->views->add($value, $params);
      }

      if ($this->theme !== NULL)
      {
        $theme_path = $this->theme->getPath();
        $namespace  = $this->theme->getNamespace();
        $layout     = $this->theme->getLayout();
        $master     = $this->theme->getTemplate();
        $template   = $layout !== FALSE ? $layout : $master;

        $this->loader->addPath($theme_path, $namespace);

        $environment = $this->environment->loadTemplate("@{$namespace}/{$template}");

        $output = $environment->render([
          'views'  => $this->views->getStored(),
          'master' => "@{$namespace}/{$master}"
        ]);
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
   * Setter Magic Method
   *
   * @param  string $method  Method name convention set<property>
   * @param  array  $params  Method arguments
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
        case 'AssetManager':
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
        default:
          throw new \BadMethodCallException;
      }
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
  * Show the possible exception in the output
  *
  * @param \Error $e
  */
  private function _showError($e)
  {
    if (is_cli()) { throw $e; }
    list($trace) = $e->getTrace();
    $message = "Exception on: "
      .$e->getTemplateFile()
      ." with the message:<br>"
      ."&emsp;".$e->getMessage();
    return show_error($message, 500, 'Attire error');
  }
}
/* End of file Attire.php */
/* Location: ./application/libraries/attire/Attire.php */
