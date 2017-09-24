<?php

namespace Attire;

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
 * Attire Extension Manager Class
 *
 * @category  Driver
 *
 * @author    David Sosa Valdes
 *
 * @see       https://github.com/CI-Attire/Driver
 */
class ExtensionManager extends \Twig_Extension
{
    /**
     * Global functions.
     *
     * @var array
     */
    protected static $functions = [];

    /**
     * Global filters.
     *
     * @var array
     */
    protected static $filters = [];

    /**
     * Global variables.
     *
     * @var array
     */
    protected static $globals = [];

    /**
     * Extensions available.
     *
     * @var array
     */
    public static $extensions = ['filters', 'globals', 'functions'];

    /**
     * Class constructor.
     *
     * @param array $params Class arguments
     */
    public static function initialize(array $params = [])
    {
        foreach ($params as $key => $objects) {
            switch ($key) {
                case 'functions':
                    self::$functions = [];
                    self::addFunctions($objects);
                    break;
              case 'filters':
                    self::$filters = [];
                    self::addFilters($objects);
                    break;
              case 'globals':
                    self::$globals = [];
                    self::addGlobals($objects);
                    break;
            }
        }
    }

    /**
     * Get filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return self::$filters;
    }

    /**
     * Get Global variables.
     *
     * @return array
     */
    public function getGlobals()
    {
        return self::$globals;
    }

    /**
     * Get functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return self::$functions;
    }

    /**
     * Get extension manager name.
     *
     * @return string
     */
    public function getName()
    {
        return 'attire_extension_manager';
    }

    /**
     * Add a filter.
     *
     * @param string   $name     Filter name
     * @param callback $callback Callback function
     */
    public static function addFilter($name, $callback)
    {
        self::$filters[] = new \Twig_SimpleFilter($name, $callback);
    }

    /**
     * Add a global variable.
     *
     * @param string $name     Variable name
     * @param mixed  $callback Variable value
     */
    public static function addGlobal($name, $callback)
    {
        self::$globals[$name] = $callback;
    }

    /**
     * Add a function.
     *
     * @param string $name     function name
     * @param mixed  $callback Callback function
     */
    public static function addFunction($name, $callback)
    {
        self::$functions[] = new \Twig_SimpleFunction($name, $callback);
    }

    /**
     * Add multiple filters.
     *
     * @param array $filters Set of filters
     */
    public static function addFilters(array $filters)
    {
        foreach ($filters as $name => $callback) {
            if (is_string($callback) && is_numeric($name)) {
                $name = $callback;
            }
            self::addFilter($name, $callback);
        }
    }

    /**
     * Add multiple global variables.
     *
     * @param array $globals Set of global variables
     */
    public static function addGlobals(array $globals)
    {
        foreach ($globals as $name => $callback) {
            self::addGlobal($name, $callback);
        }
    }

    /**
     * Add multiple functions.
     *
     * @param array $functions Set of functions
     */
    public static function addFunctions(array $functions)
    {
        foreach ($functions as $name => $callback) {
            if (is_string($callback) && is_numeric($name)) {
                $name = $callback;
            }
            self::addFunction($name, $callback);
        }
    }
}
