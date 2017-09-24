<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Attire\Loader;
use Attire\Environment;
use Attire\Lexer;
use Attire\Theme;
use Attire\Views;
use Attire\AssetManager;
use Attire\ExtensionManager;

use Attire\Exceptions\Library as LibraryException;

/**
 * CodeIgniter.
 *
 * An open source application development framework for PHP
 *
 * @author    EllisLab Dev Team
 * @copyright Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license   http://opensource.org/licenses/MIT	MIT License
 *
 * @see       http://codeigniter.com
 * @since     Version 1.0.0
 */

/**
 * Attire Library.
 *
 * Templating with this class is done by layering the standard CI view system.
 * The basic idea is that for every single CI view there are individual
 * CSS, Javascript and View files that correlate to it and this structure is
 * conected with the Twig Engine.
 *
 * @author David Sosa Valdes
 *
 * @see    https://github.com/CI-Attire/Driver
 */
class Attire
{
    /**
     * @var \CI_Controller
     */
    private $CI;

    /**
     * @var \Attire\Loader
     */
    protected $loader;

    /**
     * @var \Attire\Environment
     */
    protected $environment;

    /**
     * @var \Attire\Lexer
     */
    protected $lexer;

    /**
     * @var \Attire\Theme
     */
    protected $theme;

    /**
     * @var \Attire\Views
     */
    protected $views;

    /**
     * Environment debug mode.
     *
     * @var bool
     */
    private $debug;

    /**
     * Config variables.
     *
     * @var array
     */
    const CONFIG = [
        'debug',
        'environment',
        'loader',
        'theme',
        'assets',
        'lexer',
        'functions',
        'globals',
        'filters',
    ];

    /**
     * Class constructor.
     *
     * @param array $options Library params
     */
    public function __construct(array $options = [])
    {
        $this->CI = &get_instance();
        try {
            if (self::CONFIG !== array_keys($options)) {
                throw new LibraryException('Config is not proper configured');
            }
            $this->debug = $options['debug'] ?? false;
            $this->loader = new Loader($options['loader']);
            $this->environment = new Environment($this->loader, $options['environment']);
            $this->lexer = new Lexer($this->environment, $options['lexer']);
            $this->theme = new Theme($options['theme']);
            $this->views = new Views();
            // Initialize the AssetManager
            AssetManager::initialize($options['assets']);
            // Initialize the ExtensionManager
            ExtensionManager::initialize([
                'functions' => $options['functions'],
                'filters' => $options['filters'],
                'globals' => $options['globals'],
            ]);
        } catch (Exception $e) {
            $this->show_error($e);
        }
    }

    /**
     * Render a template.
     *
     * @param mixed[] $views  a view or an array of views with parameters passed to the template
     * @param array   $params a set of parameters passed to the views
     *
     * @return string the output as string
     */
    public function render($views = null, array $params = [])
    {
        try {
            $this->CI->benchmark->mark('Attire Render Time_start');
            // Set the debug extension if debug is enabled
            $this->debug && $this->environment->addExtension(new \Twig_Extension_Debug());
            // Set the asset manager
            $this->environment->addExtension(new AssetManager);
            // Set the extension manager
            $this->environment->addExtension(new ExtensionManager);
            // Store the views
            foreach ((array) $views as $key => $value) {
                if (is_string($key)) {
                    $this->views->add($key, $value);
                } else {
                    $this->views->add($value, $params);
                }
            }
            $themeName = $this->theme->getName();
            $themePath = $this->theme->getPath();
            $namespace = $this->theme->getNamespace();
            $template  = $this->theme->getTemplate();
            // @attire template path
            $this->loader->addPath($this->theme->getMainThemePath(), $themeName);
            // @theme themplate path
            $this->loader->addPath($themePath, $namespace);
            // load the template
            $environment = $this->environment->loadTemplate((
                !($this->theme->isDisabled() && is_string($views))
                    ? sprintf('@%s/%s', $namespace, $template)
                    : $this->views->parse($views)
            ));
            // render the output
            $output = $environment->render(array_merge([
                'theme' => [
                    'name' => $themeName,
                    'path' => $themePath,
                    'namespace' => $namespace,
                    'template' => $template,
                    'views' => $this->views->getStored(),
                ],
            ], $params));

            $this->CI->benchmark->mark('Attire Render Time_end');

            return $this->CI->output->set_output($output)->get_output();
        } catch (\Exception $e) {
            $this->show_error($e);
        }
    }

    /**
     * Whoops an error.
     *
     * @param \Error $e
     */
    private function show_error(\Exception $e)
    {
        if (is_cli()) {
            throw $e;
        } else {
            $whoops = new \Whoops\Run();
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
            $whoops->handleException($e);
            $whoops->register();
            exit;
        }
    }
}
