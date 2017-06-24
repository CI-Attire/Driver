<?php
namespace Attire;

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

/**
 * Attire Extension
 *
 * @package    CodeIgniter
 * @subpackage Drivers
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/davidsosavaldes/Attire
 */
class ExtensionManager extends \Twig_Extension
{
    private static $functions = [];

    private static $filters = [];

    private static $globals = [];

    public static $extensions = ['filters','globals','functions'];

    public function __construct(array $params = [])
    {
        foreach ($params as $key => $objects) {
            switch ($key) {
                case 'functions':
                  self::addFunctions($objects);
                  break;
                case 'filters':
                  self::addFilters($objects);
                  break;
                case 'globals':
                  self::addGlobals($objects);
                  break;
            }
        }
    }

    public function getFilters()
    {
        return self::$filters;
    }

    public function getGlobals()
    {
        return self::$globals;
    }

    public function getFunctions()
    {
        return self::$functions;
    }

    public function getName()
    {
        return 'attire_extension_manager';
    }

    public static function addFilter($name, $callback)
    {
        self::$filters[] = new \Twig_SimpleFilter($name, $callback);
    }

    public static function addGlobal($name, $callback)
    {
        self::$globals[$name] = $callback;
    }

    public static function addFunction($name, $callback)
    {
        self::$functions[] = new \Twig_SimpleFunction($name, $callback);
    }

    public static function addFilters(array $filters)
    {
        foreach ($filters as $name => $callback) {
            if (is_string($callback) && is_numeric($name)) {
                $name = $callback;
            }
            self::addFilter($name, $callback);
        }
    }

    public static function addGlobals(array $globals)
    {
        foreach ($globals as $name => $callback) {
            self::addGlobal($name, $callback);
        }
    }

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
