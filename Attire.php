<?php defined('BASEPATH') or exit('No direct script access allowed');

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
 use Attire\Lexer;
 use Attire\Loader;
 use Attire\Theme;
 use Attire\Views;
 use Attire\Environment;
 use Attire\AssetManager;
 use Attire\ExtensionManager;

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
     * Environment debug mode
     * @var boolean
     */
    private static $debug = false;

    /**
     * Class constructor
     *
     * @param array $config library params
     */
    public function __construct(array $options = [])
    {
        $this->CI = & get_instance();

        try {
            $this->loader = new Loader($options['loader']);
            $this->environment = new Environment($this->loader, $options['environment']);

            if (self::$debug = $options['debug']) {
                $this->environment->addExtension(new \Twig_Extension_Debug);
            }

            $this->lexer = new Lexer($this->environment, $options['lexer']);
            $this->theme = new Theme($options['theme']);
            $this->assetManager = new AssetManager($options['assets']);
            $this->views = new Views();

            $this->extensionManager = new ExtensionManager([
              'functions' => $options['functions'],
              'filters' => $options['filters'],
              'globals' => $options['globals']
            ]);
        } catch (Exception $e) {
            $this->show_error($e);
        }
    }

  /**
     * Render a template
     *
     * @param  array|string $views   A view or an array of views with parameters passed to the template
     * @param  boolean      $return  Output flag
     * @return string                The output as string if the return flag is set to TRUE
     */
  public function render($views = null, array $params = [], $return = false)
  {
      try {
          $this->CI->benchmark->mark('Attire Render Time_start');
          // Set the asset manager
          $this->environment->addExtension($this->assetManager);
          // Autoload Assets
          $this->extensionManager->addGlobal('assets', $this->assetManager->getAutoload());
          // Set the extension manager
          $this->environment->addExtension($this->extensionManager);
          // Add all the stored views
          foreach ((array) $views as $key => $value) {
              is_string($key)
                && $this->views->add($key, $value)
                || $this->views->add($value, $params);
          }

          if ($this->theme !== null) {
              $theme_path = $this->theme->getPath();
              $namespace  = $this->theme->getNamespace();
              $layout     = $this->theme->getLayout();
              $master     = $this->theme->getTemplate();
              $template   = $layout !== false ? $layout : $master;

              $this->loader->addPath($this->theme->getMainThemePath(), 'attire'); // @general template path
              $this->loader->addPath($theme_path, $namespace); // @custom themplate path

              $environment = $this->environment->loadTemplate("@{$namespace}/{$template}");

              $output = $environment->render([
                'views' => $this->views->getStored(),
                'master' => "@{$namespace}/{$master}"
              ]);
          }

          $this->CI->benchmark->mark('Attire Render Time_end');

          return $return !== false ? $output : $this->CI->output->set_output($output);

      } catch (\Exception $e) {
          $this->show_error($e);
      }
  }

  /**
  * Show the possible exception in the output
  *
  * @param \Error $e
  */
  private function show_error(\Exception $e)
  {
      if (is_cli()) {
          throw $e;
      } else {
          list($trace) = $e->getTrace();

          return show_error(sprintf("Exception on: %s <br>%s",
              $e->getTemplateFile(),
              $e->getMessage()
            ), 500, 'Attire::Error'
          );
      }
  }
}
/* End of file Attire.php */
/* Location: ./application/libraries/attire/Attire.php */
