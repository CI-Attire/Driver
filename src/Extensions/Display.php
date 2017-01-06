<?php
namespace Attire\Extensions;

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
class Display extends \Twig_Extension
{
  private $functions = [];

  private $filters = [];

  private $globals = [];

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

  public function addFilter($name, $callback)
  {
    $this->filters[] = new \Twig_SimpleFilter($name, $callback);
    return $this;
  }

  public function getFilters()
  {
    return $this->filters;
  }

  public function addGlobals(array $globals)
  {
    foreach ($globals as $name => $callback)
    {
      $this->addGlobal($name, $callback);
    }
    return $this;
  }

  public function addGlobal($name, $callback)
  {
    $this->globals[$name] = $callback;
    return $this;
  }

  public function getGlobals()
  {
    return $this->globals;
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

  public function addFunction($name, $callback)
  {
    $this->functions[] = new \Twig_SimpleFunction($name, $callback);
    return $this;
  }

  public function getFunctions()
  {
    return $this->functions;
  }

  public function getName()
  {
    return 'attire_extension';
  }
}
