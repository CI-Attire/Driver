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

/**
 * Attire Extension
 *
 * @package    CodeIgniter
 * @subpackage Drivers
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/davidsosavaldes/Attire
 */
class Extension extends \Twig_Extension
{
  private $_functions = [];

  private $_filters = [];

  private $_globals = [];

  public $extensions = ['filters','globals','functions'];

  public function getFilters()
  {
    return $this->_filters;
  }

  public function getGlobals()
  {
    return $this->_globals;
  }

  public function getFunctions()
  {
    return $this->_functions;
  }

  public function getName()
  {
    return 'attire_extension_manager';
  }

  public function addFilter($name, $callback)
  {
    $this->_filters[] = new \Twig_SimpleFilter($name, $callback);
    return $this;
  }

  public function addGlobal($name, $callback)
  {
    $this->_globals[$name] = $callback;
    return $this;
  }

  public function addFunction($name, $callback)
  {
    $this->_functions[] = new \Twig_SimpleFunction($name, $callback);
    return $this;
  }

  public function addFilters(array $filters)
  {
    foreach ($filters as $name => $callback)
    {
      if (is_string($callback) && is_numeric($name))
      {
        $name = $callback;
      }
      $this->addFilter($name, $callback);
    }
    return $this;
  }

  public function addGlobals(array $globals)
  {
    foreach ($globals as $name => $callback)
    {
      $this->addGlobal($name, $callback);
    }
    return $this;
  }

  public function addFunctions(array $functions)
  {
    foreach ($functions as $name => $callback)
    {
      if (is_string($callback) && is_numeric($name))
      {
        $name = $callback;
      }
      $this->addFunction($name, $callback);
    }
    return $this;
  }
}
